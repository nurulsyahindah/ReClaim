<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Claims Controller
 *
 * @property \App\Model\Table\ClaimsTable $Claims
 */
class ClaimsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Claims->find()
            ->contain(['Reports', 'Users']);
        $claims = $this->paginate($query);

        $this->set(compact('claims'));
    }

public function myClaims()
{
    $session = $this->request->getSession();

    $user = $session->read('Auth');

    // ==========================
    // SEARCH & FILTER
    // ==========================

    $search = trim((string)$this->request->getQuery('search'));

    $status = trim((string)$this->request->getQuery('status'));

    // ==========================
    // QUERY
    // ==========================

    $query = $this->Claims->find()

        ->contain([
            'Reports',
            'Reports.Categories'
        ])

        ->where([
            'Claims.user_id' => $user['id']
        ]);

    // ==========================
    // SEARCH
    // ==========================

    if (!empty($search)) {

        $query->where(function ($exp) use ($search) {

            return $exp->or([

                'Reports.report_code LIKE' =>
                    '%' . $search . '%',

                'Reports.item_name LIKE' =>
                    '%' . $search . '%',

                'Reports.type LIKE' =>
                    '%' . $search . '%',

                'Categories.category_name LIKE' =>
                    '%' . $search . '%'

            ]);

        });

    }

    // ==========================
    // STATUS FILTER
    // ==========================

    if (!empty($status)) {

        $query->where([
            'Claims.status' => $status
        ]);

    }

    // ==========================
    // ORDER
    // ==========================

    $query->orderBy([
        'Claims.created' => 'DESC'
    ]);

    // ==========================
    // RESULT
    // ==========================

    $claims = $query->all();

    $this->set(compact('claims'));
}

public function adminIndex()
{
    $this->viewBuilder()->setLayout('admin');

    $session = $this->request->getSession();

    if (!$session->check('Auth')) {
        return $this->redirect([
            'controller' => 'Users',
            'action' => 'login'
        ]);
    }

    $user = $session->read('Auth');

    if ($user['role'] != 'admin') {
        return $this->redirect([
            'controller' => 'Users',
            'action' => 'dashboard'
        ]);
    }

    // =========================
    // QUERY
    // =========================

    $query = $this->Claims->find()
        ->contain([
            'Users',
            'Reports.Categories'
        ]);

    // =========================
    // SEARCH
    // =========================

    $search = trim((string)$this->request->getQuery('search', ''));

if (!empty($search)) {

    $conditions = [
        'OR' => [
            'Users.name LIKE' => "%{$search}%",
            'Reports.item_name LIKE' => "%{$search}%"
        ]
    ];

    // Kalau user search nombor sahaja, baru search Claim ID
    if (is_numeric($search)) {
        $conditions['OR']['Claims.id'] = (int)$search;
    }

    $query->where($conditions);

}

    // =========================
    // STATUS FILTER
    // =========================

    $status = $this->request->getQuery('status');

    if (!empty($status)) {

        $query->where([
            'Claims.status' => $status
        ]);

    }

    // =========================
    // PAGINATION
    // =========================

    $claims = $this->paginate($query, [
        'limit' => 7,
        'order' => [
            'Claims.created' => 'DESC'
        ]
    ]);

    $this->set(compact('claims'));
}

public function approve($id = null)
{
    $claim = $this->Claims->get($id, contain: ['Reports']);

    $claim->status = 'Approved';

    $report = $claim->report;

    $report->status = 'Claimed';

    if (
        $this->Claims->save($claim) &&
        $this->Claims->Reports->save($report)
    ) {

        $notificationsTable = $this->fetchTable('Notifications');

        $notification = $notificationsTable->newEmptyEntity();

        $notification->user_id = $claim->user_id;

        $notification->title = 'Claim Approved';

        $notification->message = 'Congratulations! Your claim for "' .
            $report->item_name .
            '" has been approved. Please collect your item.';

        $notification->is_read = 0;

        $notificationsTable->save($notification);

        $this->Flash->success('Claim approved successfully.');

    } else {

        $this->Flash->error('Unable to approve claim.');

    }

    return $this->redirect([
        'action' => 'adminIndex'
    ]);
}

public function reject($id = null)
{
    $claim = $this->Claims->get($id);

    $claim->status = 'Rejected';

    if ($this->Claims->save($claim)) {

        $notificationsTable = $this->fetchTable('Notifications');

        $notification = $notificationsTable->newEmptyEntity();

        $notification->user_id = $claim->user_id;

        $notification->title = 'Claim Rejected';

        $notification->message = 'Your claim has been rejected by the administrator.';

        $notification->is_read = 0;

        $notificationsTable->save($notification);

        $this->Flash->success('Claim rejected.');

    } else {

        $this->Flash->error('Unable to reject claim.');

    }

    return $this->redirect([
        'action' => 'adminIndex'
    ]);
}

public function adminView($id = null)
{
    $this->viewBuilder()->setLayout('admin');

    $claim = $this->Claims->get($id, [
        'contain' => [
            'Users',
            'Reports.Categories'
        ]
    ]);

    $this->set(compact('claim'));
}

    /**
     * View method
     *
     * @param string|null $id Claim id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
public function view($id = null)
{
    $claim = $this->Claims->get($id, [

        'contain' => [

            'Users',

            'Reports.Categories'

        ]

    ]);

    $this->set(compact('claim'));
}
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($reportId = null)
{
    if (!$reportId) {

    throw new \Cake\Http\Exception\NotFoundException('Report not found.');

}

    $claim = $this->Claims->newEmptyEntity();

    if ($this->request->is('post')) {

        $data = $this->request->getData();

        $session = $this->request->getSession();

$userId = $session->read('Auth.id');

$existingClaim = $this->Claims
    ->find()
    ->where([
        'report_id' => $reportId,
        'user_id' => $userId
    ])
    ->first();

if ($existingClaim) {

    $this->Flash->error(
        'You have already submitted a claim for this report.'
    );

    return $this->redirect([
        'controller'=>'Reports',
        'action'=>'view',
        $reportId
    ]);
}

        $file = $data['evidence'];

    if ($file && $file->getError() === UPLOAD_ERR_OK) {

    $filename = time() . '_' . $file->getClientFilename();

    $target = WWW_ROOT . 'img' . DS . 'evidence' . DS . $filename;

    $file->moveTo($target);

    $data['evidence'] = $filename;

}   else {

    $data['evidence'] = null;

}

        // report yang hendak dituntut
        $data['report_id'] = $reportId;

        // user yang sedang login
        $auth = $this->request->getSession()->read('Auth');

$data['user_id'] = $auth['id'];

        // status automatik
        $data['status'] = 'Pending';

        $claim = $this->Claims->patchEntity($claim, $data);

if ($this->Claims->save($claim)) {

    $report = $this->Claims->Reports->get($reportId);

    $adminNotifications = $this->fetchTable('AdminNotifications');

    $adminNotification = $adminNotifications->newEmptyEntity();

    $adminNotification->title = 'New Ownership Claim';

    $adminNotification->message =
        $auth['name'] .
        ' submitted an ownership claim for "' .
        $report->item_name .
        '".';

    $adminNotification->category = 'claim';

    $adminNotification->is_read = 'No';

    $adminNotifications->save($adminNotification);

    $this->Flash->success('Claim submitted successfully.');

    return $this->redirect([
        'controller' => 'Claims',
        'action' => 'myClaims'
    ]);
        }

        $this->Flash->error('Unable to submit claim.');
    }

    $this->set(compact('claim'));
}

    /**
     * Edit method
     *
     * @param string|null $id Claim id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $claim = $this->Claims->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $claim = $this->Claims->patchEntity($claim, $this->request->getData());
            if ($this->Claims->save($claim)) {
                $this->Flash->success(__('The claim has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The claim could not be saved. Please, try again.'));
        }
        $reports = $this->Claims->Reports->find('list', limit: 200)->all();
        $users = $this->Claims->Users->find('list', limit: 200)->all();
        $this->set(compact('claim', 'reports', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Claim id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $claim = $this->Claims->get($id);
        if ($this->Claims->delete($claim)) {
            $this->Flash->success(__('The claim has been deleted.'));
        } else {
            $this->Flash->error(__('The claim could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
