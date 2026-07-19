<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Reports Controller
 *
 * @property \App\Model\Table\ReportsTable $Reports
 */
class ReportsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
{
    parent::beforeFilter($event);

    $this->viewBuilder()->setLayout('dashboard');
}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
public function index()
{
    $query = $this->Reports->find()
        ->contain([
            'Users',
            'Categories'
        ])
        ->where([
            'Reports.status' => 'Approved'
        ]);

    // Search
    $search = $this->request->getQuery('search');

    if (!empty($search)) {

        $query->where([
            'OR' => [
                'Reports.item_name LIKE' => '%' . $search . '%',
                'Reports.location LIKE' => '%' . $search . '%',
                'Users.name LIKE' => '%' . $search . '%'
            ]
        ]);

    }

    // Category
    $category = $this->request->getQuery('category');

    if (!empty($category)) {

        $query->where([
            'Reports.category_id' => $category
        ]);

    }

    // Type
    $type = $this->request->getQuery('type');

    if (!empty($type)) {

        $query->where([
            'Reports.type' => ucfirst($type)
        ]);

    }

    $query->order([
        'Reports.created' => 'DESC'
    ]);

    $reports = $this->paginate($query,[
        'limit'=>12
    ]);

    $categories = $this->Reports->Categories
        ->find('list')
        ->all();

    $this->set(compact(
        'reports',
        'categories'
    ));
}

public function myReports()
{
    $session = $this->request->getSession();

    $user = $session->read('Auth');

    // SEARCH & FILTER
    $search = trim((string)$this->request->getQuery('search'));
    $type = $this->request->getQuery('type');

    $query = $this->Reports->find()

        ->contain(['Categories'])

        ->where([
            'Reports.user_id' => $user['id']
        ]);

    // SEARCH
    if (!empty($search)) {

        $query->where(function ($exp) use ($search) {

            return $exp->or([

                'Reports.report_code LIKE' => '%' . $search . '%',

                'Reports.item_name LIKE' => '%' . $search . '%',

                'Reports.status LIKE' => '%' . $search . '%',

                'Reports.type LIKE' => '%' . $search . '%',

                'Categories.category_name LIKE' => '%' . $search . '%'

            ]);

        });

    }

    // FILTER TYPE
    if (!empty($type)) {

        $query->where([
            'Reports.type' => $type
        ]);

    }

    $query->orderBy([
        'Reports.created' => 'DESC'
    ]);

    $reports = $this->paginate($query, [
        'limit' => 7
    ]);

    $this->set(compact('reports'));
}
    /**
     * View method
     *
     * @param string|null $id Report id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

public function view($id = null)
{
    $report = $this->Reports->get(
        $id,
        contain: ['Users', 'Categories', 'Claims']
    );

    $this->set(compact('report'));
}

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
{
    $report = $this->Reports->newEmptyEntity();

    if ($this->request->is('post')) {

        $data = $this->request->getData();

        unset($data['image']);

        $report = $this->Reports->patchEntity(
            $report,
            $data
        );

        $image = $this->request->getData('image');
        if ($image && $image->getError() === UPLOAD_ERR_OK) {

    $filename = time() . '_' . $image->getClientFilename();

    $image->moveTo(
        WWW_ROOT . 'img' . DS . 'reports' . DS . $filename
    );

    $report->image = $filename;
}

        $session = $this->request->getSession();
        $user = $session->read('Auth');

        $report->user_id = $user['id'];

        
$type = ucfirst(strtolower(trim($report->type)));

$prefix = ($type === 'Found') ? 'F' : 'L';

$lastReport = $this->Reports->find()
    ->where([
        'type' => $type
    ])
    ->order([
        'report_code' => 'DESC'
    ])
    ->first();

if ($lastReport) {

    $number = (int) substr($lastReport->report_code, 1);
    $number++;

} else {

    $number = 1;

}

$report->type = $type;

$report->report_code =
    $prefix .
    str_pad((string)$number, 3, '0', STR_PAD_LEFT);
            $report->status = 'Pending';
if ($this->Reports->save($report)) {

    $adminNotifications = $this->fetchTable('AdminNotifications');

    $adminNotification = $adminNotifications->newEmptyEntity();

    if ($report->type == 'Lost') {

        $adminNotification->title = 'New Lost Report';

        $adminNotification->category = 'lost_report';

    } else {

        $adminNotification->title = 'New Found Report';

        $adminNotification->category = 'found_report';

    }

    $adminNotification->message =
        $user['name'] .
        ' submitted a ' .
        $report->type .
        ' Report for "' .
        $report->item_name .
        '".';

    $adminNotification->is_read = 'No';

    $adminNotifications->save($adminNotification);

    $this->Flash->success(__('The report has been saved.'));

    return $this->redirect([
        'action' => 'myReports'
    ]);
}
            $this->Flash->error(__('The report could not be saved. Please, try again.'));
            
        }
    
        $categories = $this->Reports->Categories->find('list', limit: 200)->all();
        $this->set(compact('report', 'categories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Report id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
{
    $report = $this->Reports->get($id);

    $session = $this->request->getSession();
    $user = $session->read('Auth');

    if (
        $user['role'] !== 'admin' &&
        $report->user_id != $user['id']
    ) {
        $this->Flash->error('Access denied.');

        return $this->redirect([
            'action' => 'myReports'
        ]);
    }

    if ($this->request->is(['patch', 'post', 'put'])) {

        $data = $this->request->getData();

        $image = $data['image'];

        unset($data['image']);

        $report = $this->Reports->patchEntity($report, $data);

        if ($image && $image->getError() === UPLOAD_ERR_OK) {

            // Padam gambar lama
            if (!empty($report->image)) {

                $oldImage = WWW_ROOT . 'img' . DS . 'reports' . DS . $report->image;

                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }

            // Simpan gambar baru
            $filename = time() . '_' . $image->getClientFilename();

            $image->moveTo(
                WWW_ROOT . 'img' . DS . 'reports' . DS . $filename
            );

            $report->image = $filename;
        }

        if ($this->Reports->save($report)) {

            $this->Flash->success('The report has been updated.');

            return $this->redirect([
                'action' => 'myReports'
            ]);
        }

        $this->Flash->error(
            'The report could not be saved. Please try again.'
        );
    }

    $categories = $this->Reports->Categories
        ->find('list')
        ->all();

    $this->set(compact('report', 'categories'));
}
    /**
     * Delete method
     *
     * @param string|null $id Report id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
{
    $this->request->allowMethod(['post', 'delete']);

    $report = $this->Reports->get($id);

    $session = $this->request->getSession();
    $user = $session->read('Auth');

    if (
        $user['role'] !== 'admin' &&
        $report->user_id != $user['id']
    ) {
        $this->Flash->error('Access denied.');

        return $this->redirect([
            'action' => 'myReports'
        ]);
    }

    if ($this->Reports->delete($report)) {

    if (!empty($report->image)) {

        $imagePath = WWW_ROOT . 'img' . DS . 'reports' . DS . $report->image;

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    $this->Flash->success(
        'The report has been deleted.'
    );

} else {

        $this->Flash->error(
            'The report could not be deleted.'
        );
    }

    return $this->redirect([
        'action' => 'myReports'
    ]);
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

    $query = $this->request->getQuery('search');
    $status = $this->request->getQuery('status');

$reports = $this->Reports->find()

    ->contain([
        'Users',
        'Categories'
    ]);

if(!empty($query)){

    $reports->where([

        'OR' => [

            'Reports.report_code LIKE' => "%{$query}%",

            'Reports.item_name LIKE' => "%{$query}%",

            'Users.name LIKE' => "%{$query}%",

            'Categories.category_name LIKE' => "%{$query}%",

        ]

    ]);

}

if(!empty($status)){

    if($status=="Lost" || $status=="Found"){

        $reports->where([
            'Reports.type' => $status
        ]);

    }else{

        $reports->where([
            'Reports.status' => $status
        ]);

    }

}

$this->paginate = [

    'limit' => 7,

    'order' => [

        'Reports.created' => 'DESC'

    ]

];

$reports = $this->paginate($reports);


    $this->set(compact(
    'reports',
    'user',
));
}

public function adminView($id = null)
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

    $report = $this->Reports->get($id, [

        'contain' => [
            'Users',
            'Categories'
        ]

    ]);

    $this->set(compact(
        'report',
        'user'
    ));
}

public function approve($id = null)
{
    $this->request->allowMethod(['post','get']);

    $report = $this->Reports->get($id);

    $report->status = 'Approved';

    if($this->Reports->save($report)){


    $notificationsTable = $this->fetchTable('Notifications');

    $notification = $notificationsTable->newEmptyEntity();

    $notification->user_id = $report->user_id;

    $notification->title = 'Report Approved';

    $notification->message = 'Your report "' . $report->item_name . '" has been approved by the administrator.';

    $notification->is_read = 0;

    $notificationsTable->save($notification);

        $this->Flash->success('Report approved successfully.');

    }else{

        $this->Flash->error('Unable to approve report.');

    }

    return $this->redirect([
        'action'=>'adminIndex'
    ]);
}

public function reject($id = null)
{
    $this->request->allowMethod(['post','get']);

    $report = $this->Reports->get($id);

    $report->status = 'Rejected';

    if($this->Reports->save($report)){

    $notificationsTable = $this->fetchTable('Notifications');

    $notification = $notificationsTable->newEmptyEntity();

    $notification->user_id = $report->user_id;

    $notification->title = 'Report Rejected';

    $notification->message = 'Your report "' . $report->item_name . '" has been rejected by the administrator.';

    $notification->is_read = 0;

    $notificationsTable->save($notification);

        $this->Flash->success('Report rejected.');

    }else{

        $this->Flash->error('Unable to reject report.');

    }

    return $this->redirect([
        'action'=>'adminIndex'
    ]);
}
}
