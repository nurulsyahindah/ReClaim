<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * AdminNotifications Controller
 *
 * @property \App\Model\Table\AdminNotificationsTable $AdminNotifications
 */
class AdminNotificationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->AdminNotifications->find();
        $adminNotifications = $this->paginate($query);

        $this->set(compact('adminNotifications'));
    }

    /**
     * View method
     *
     * @param string|null $id Admin Notification id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $adminNotification = $this->AdminNotifications->get($id, contain: []);
        $this->set(compact('adminNotification'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $adminNotification = $this->AdminNotifications->newEmptyEntity();
        if ($this->request->is('post')) {
            $adminNotification = $this->AdminNotifications->patchEntity($adminNotification, $this->request->getData());
            if ($this->AdminNotifications->save($adminNotification)) {
                $this->Flash->success(__('The admin notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The admin notification could not be saved. Please, try again.'));
        }
        $this->set(compact('adminNotification'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Admin Notification id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $adminNotification = $this->AdminNotifications->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $adminNotification = $this->AdminNotifications->patchEntity($adminNotification, $this->request->getData());
            if ($this->AdminNotifications->save($adminNotification)) {
                $this->Flash->success(__('The admin notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The admin notification could not be saved. Please, try again.'));
        }
        $this->set(compact('adminNotification'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Admin Notification id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $adminNotification = $this->AdminNotifications->get($id);
        if ($this->AdminNotifications->delete($adminNotification)) {
            $this->Flash->success(__('The admin notification has been deleted.'));
        } else {
            $this->Flash->error(__('The admin notification could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

public function markRead($id = null)
{
    $this->request->allowMethod(['post']);

    $notification = $this->AdminNotifications->get($id);

    if($notification->is_read=="No"){

        $notification->is_read="Yes";

        $this->AdminNotifications->save($notification);

    }

    $count=$this->AdminNotifications
    ->find()
    ->where([
        'is_read'=>'No'
    ])
    ->count();

    $this->viewBuilder()->disableAutoLayout();

    $this->autoRender=false;

    return $this->response
    ->withType('application/json')
    ->withStringBody(json_encode([

        'success'=>true,

        'count'=>$count

    ]));
}

public function markAllRead()
{
    $this->request->allowMethod(['post']);

    $this->AdminNotifications
        ->updateAll(
            ['is_read' => 'Yes'],
            ['is_read' => 'No']
        );

    return $this->response
        ->withType('application/json')
        ->withStringBody(json_encode([
            'success' => true
        ]));
}

public function clearAll()
{
    $this->request->allowMethod(['post']);

    $this->AdminNotifications->deleteAll([]);

    return $this->response
        ->withType('application/json')
        ->withStringBody(json_encode([
            'success' => true
        ]));
}
}
