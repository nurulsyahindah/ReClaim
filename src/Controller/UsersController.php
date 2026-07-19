<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Users->find();
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, contain: ['Claims', 'Notifications', 'Reports']);

        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function login()
    {
        if ($this->request->is('post')) {

        $email = $this->request->getData('email');
        $password = $this->request->getData('password');

        $user = $this->Users->find()
            ->where(['email' => $email])
            ->first();

        if ($user && password_verify($password, $user->password)) {

            $this->request->getSession()->write('Auth', [
                'id' => $user->id,
                'name' => $user->name,
                'role' => $user->role
            ]);

            if ($user->role === 'admin') {
                return $this->redirect([
                    'controller' => 'Users',
                    'action' => 'adminDashboard'
                ]);
            }

            return $this->redirect([
                'controller' => 'Users',
                'action' => 'dashboard'
            ]);
        }

        $this->Flash->error('Invalid email or password.');
        }
    }
    
    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'adminIndex']);
    }

public function register()
{
    $user = $this->Users->newEmptyEntity();

    if ($this->request->is('post')) {

        $data = $this->request->getData();

    $email = $data['email'];

    if (str_ends_with($email, '@reclaim.com')) {
        $data['role'] = 'admin';
    } else {
        $data['role'] = 'user';
    }
        
        $user = $this->Users->patchEntity($user, $data);

        if ($this->Users->save($user)) {

            $adminNotifications = $this->fetchTable('AdminNotifications');

            $adminNotification = $adminNotifications->newEmptyEntity();

            $adminNotification->title = 'New User Registered';

            $adminNotification->message =
                $user->name .
                ' has created a new ReClaim account.';

            $adminNotification->category = 'user';

            $adminNotification->is_read = 'No';

            $adminNotifications->save($adminNotification);

            $this->Flash->success('Registration successful.');

            return $this->redirect([
                'action' => 'login'
            ]);
        }

        $this->Flash->error('Registration failed.');
    }

    $this->set(compact('user'));
}

    
    public function logout()
    {
        $this->request->getSession()->destroy();

        return $this->redirect([
        'action' => 'login'
        ]);
    }
    
public function dashboard()
{
    $this->viewBuilder()->setLayout('dashboard');

    $session = $this->request->getSession();

    if (!$session->check('Auth')) {
        return $this->redirect([
            'action' => 'login'
        ]);
    }

    $user = $session->read('Auth');

    $reportsTable = $this->fetchTable('Reports');
    $claimsTable = $this->fetchTable('Claims');
    $notificationsTable = $this->fetchTable('Notifications');

    // ==========================
    // SUMMARY CARDS
    // ==========================

    // ALL USERS - FOUND REPORTS
    $totalFound = $reportsTable->find()
        ->where([
            'type' => 'Found',
            'status' => 'Approved'
        ])
        ->count();

    // ALL USERS - LOST REPORTS
    $totalLost = $reportsTable->find()
        ->where([
            'type' => 'Lost',
            'status' => 'Approved'
        ])
        ->count();

    // CURRENT USER - PENDING REPORTS
    $pendingReports = $reportsTable->find()
        ->where([
            'user_id' => $user['id'],
            'status' => 'Pending'
        ])
        ->count();

    // APPROVE REPORTS
$approvedReports = $reportsTable->find()
    ->where([
        'user_id' => $user['id'],
        'status' => 'Approved'
    ])
    ->count();

    // ==========================
    // LATEST REPORTS
    // ==========================

    $latestReports = $reportsTable->find()
        ->contain([
            'Users',
            'Categories'
        ])
        ->where([
            'status' => 'Approved'
        ])
        ->orderBy([
            'Reports.created' => 'DESC'
        ])
        ->limit(8)
        ->all();

    // ==========================
    // RECENT REPORT ACTIVITIES
    // ==========================

    $reportActivities = $reportsTable->find()
        ->select([
            'id',
            'item_name',
            'status',
            'created'
        ])
        ->where([
            'user_id' => $user['id']
        ])
        ->orderBy([
            'created' => 'DESC'
        ])
        ->limit(5)
        ->all();

    // ==========================
    // RECENT ACTIVITY
    // ==========================

    $recentActivities = [];

    // REPORTS

    $reports = $reportsTable->find()
        ->where([
            'user_id' => $user['id']
        ])
        ->orderBy([
            'created' => 'DESC'
        ])
        ->limit(6)
        ->all();

    foreach ($reports as $report) {

        if ($report->status == 'Pending') {

            $title = 'Report Submitted';
            $status = 'submitted';

        } else {

            $title = 'Report ' . ucfirst($report->status);
            $status = strtolower($report->status);

        }

        $recentActivities[] = [

            'title' => $title,
            'item' => $report->item_name,
            'status' => $status,
            'created' => $report->created

        ];

    }

    // CLAIMS

    $claims = $claimsTable->find()
        ->contain([
            'Reports'
        ])
        ->where([
            'Claims.user_id' => $user['id']
        ])
        ->orderBy([
            'Claims.created' => 'DESC'
        ])
        ->limit(6)
        ->all();

    foreach ($claims as $claim) {

        if ($claim->status == 'Pending') {

            $title = 'Claim Submitted';
            $status = 'submitted';

        } else {

            $title = 'Claim ' . ucfirst($claim->status);
            $status = strtolower($claim->status);

        }

        $recentActivities[] = [

            'title' => $title,
            'item' => $claim->report->item_name,
            'status' => $status,
            'created' => $claim->created

        ];

    }

    usort($recentActivities, function ($a, $b) {

        return $b['created']->getTimestamp() <=> $a['created']->getTimestamp();

    });

    $recentActivities = array_slice($recentActivities, 0, 6);

    // ==========================
    // USER NOTIFICATIONS
    // ==========================

    $notifications = $notificationsTable->find()
        ->where([
            'user_id' => $user['id']
        ])
        ->orderBy([
            'created' => 'DESC'
        ])
        ->all();

    $notificationCount = $notificationsTable->find()
        ->where([
            'user_id' => $user['id'],
            'is_read' => 0
        ])
        ->count();

    // ==========================
    // SEND TO VIEW
    // ==========================

    $this->set(compact(
        'user',
        'totalFound',
        'totalLost',
        'pendingReports',
        'approvedReports',
        'latestReports',
        'recentActivities',
        'notifications',
        'notificationCount'
    ));
}

    public function adminDashboard()
    {
    $this->viewBuilder()->setLayout('admin');

    $session = $this->request->getSession();

    if (!$session->check('Auth')) {

        return $this->redirect(['action'=>'login']);

    }

    $user = $session->read('Auth');

    if($user['role']!='admin'){

        return $this->redirect(['action'=>'dashboard']);

    }

    $reportsTable = $this->fetchTable('Reports');
    $claimsTable  = $this->fetchTable('Claims');
    $usersTable   = $this->fetchTable('Users');

    /* SUMMARY */

    $totalReports = $reportsTable->find()->count();

    $pendingClaims = $claimsTable
    ->find()
    ->where([
        'status' => 'Pending'
    ])
    ->count();

    $totalUsers = $usersTable->find()->count();

    $pendingReports = $reportsTable
    ->find()
    ->where([
        'status'=>'Pending'
    ])
    ->count();

    /*latest penambahan*/
    $approvedReports = $reportsTable
    ->find()
    ->where([
        'status' => 'Approved'
    ])
    ->count();

    $rejectedReports = $reportsTable
    ->find()
    ->where([
        'status' => 'Rejected'
    ])
    ->count();

    $claimedReports = $reportsTable
    ->find()
    ->where([
        'status' => 'Claimed'
    ])
    ->count();

    $latestPendingReports = $this->fetchTable('Reports')
    ->find()
    ->contain(['Users'])
    ->where([
        'Reports.status' => 'Pending'
    ])
    ->order(['Reports.created' => 'DESC'])
    ->limit(3)
    ->all();

    $latestPendingClaims = $this->fetchTable('Claims')
    ->find()
    ->contain([
        'Users',
        'Reports'
    ])
    ->where([
        'Claims.status' => 'Pending'
    ])
    ->orderDesc('Claims.created')
    ->limit(3)
    ->all();

    $adminNotifications = $this->fetchTable('AdminNotifications');

$notifications = $adminNotifications
    ->find()
    ->orderBy([
        'created' => 'DESC'
    ])
    ->limit(10)
    ->all();

$notificationCount = $adminNotifications
    ->find()
    ->where([
        'is_read' => 'No'
    ])
    ->count();

    $this->set(compact(
    'totalReports',
    'pendingReports',
    'pendingClaims',
    'totalUsers',
    'approvedReports',
    'rejectedReports',
    'claimedReports',
    'latestPendingReports',
    'latestPendingClaims',
    'user',
    'notifications',
    'notificationCount'
    ));

    }

public function adminIndex()
{
    $this->viewBuilder()->setLayout('admin');

    $session = $this->request->getSession();

    if (!$session->check('Auth')) {
        return $this->redirect([
            'action' => 'login'
        ]);
    }

    $user = $session->read('Auth');

    if ($user['role'] != 'admin') {
        return $this->redirect([
            'action' => 'dashboard'
        ]);
    }

    // =========================
    // QUERY
    // =========================

    $users = $this->Users->find();

    // =========================
    // SEARCH
    // =========================

    $search = trim((string)$this->request->getQuery('search'));

    if ($search !== '') {

        $users->where([
            'OR' => [
                'Users.name LIKE'       => "%{$search}%",
                'Users.student_id LIKE' => "%{$search}%",
                'Users.email LIKE'      => "%{$search}%"
            ]
        ]);

    }

    // =========================
    // FILTER ROLE
    // =========================

    $role = $this->request->getQuery('role');

    if (!empty($role)) {

        $users->where([
            'Users.role' => $role
        ]);

    }

    // =========================
    // PAGINATION
    // =========================

    $users = $this->paginate($users, [
        'limit' => 7,
        'order' => [
            'Users.created' => 'DESC'
        ]
    ]);

    // =========================
    // SUMMARY
    // =========================

    $totalUsers = $this->Users->find()->count();

    $adminCount = $this->Users->find()
        ->where(['role' => 'admin'])
        ->count();

    $studentCount = $this->Users->find()
        ->where(['role' => 'user'])
        ->count();

    $this->set(compact(
        'users',
        'user',
        'totalUsers',
        'adminCount',
        'studentCount'
    ));
}

public function adminView($id = null)
{
    $this->viewBuilder()->setLayout('admin');

    $session = $this->request->getSession();

    if (!$session->check('Auth')) {
        return $this->redirect([
            'action' => 'login'
        ]);
    }

    $user = $session->read('Auth');

    if ($user['role'] != 'admin') {
        return $this->redirect([
            'action' => 'dashboard'
        ]);
    }

    $viewUser = $this->Users->get($id);

    $this->set(compact('viewUser'));
}

    public function profile()
{
    $session = $this->request->getSession();

    $userSession = $session->read('Auth');

    $user = $this->Users->get($userSession['id']);

    // Report statistics
    $reportsTable = $this->fetchTable('Reports');

    $claimsTable = $this->fetchTable('Claims');

    $totalReports = $reportsTable->find()
        ->where([
            'user_id' => $user->id
        ])
        ->count();

    $totalClaims = $claimsTable->find()
        ->where([
            'user_id' => $user->id
        ])
        ->count();

    $pendingReports = $reportsTable->find()
        ->where([
            'user_id' => $user->id,
            'status' => 'Pending'
        ])
        ->count();

    $returnedItems = $reportsTable->find()
        ->where([
            'user_id' => $user->id,
            'status' => 'Claimed'
        ])
        ->count();

    $this->set(compact(
        'user',
        'totalReports',
        'totalClaims',
        'pendingReports',
        'returnedItems'
    ));
}
}
