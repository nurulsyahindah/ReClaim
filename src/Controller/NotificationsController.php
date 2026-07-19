<?php
declare(strict_types=1);

namespace App\Controller;

class NotificationsController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();

        $this->viewBuilder()->disableAutoLayout();

        $this->loadComponent('RequestHandler');
    }

    //========================================================
    // USER NOTIFICATION LIST
    //========================================================

    public function index()
    {
        $session = $this->request->getSession();

        $user = $session->read('Auth');

        $notifications = $this->Notifications
            ->find()
            ->where([
                'user_id'=>$user['id']
            ])
            ->orderBy([
                'created'=>'DESC'
            ])
            ->all();

        $this->set(compact('notifications'));
    }

    //========================================================
    // MARK ALL AS READ
    //========================================================

    public function markAllRead()
    {

        $this->request->allowMethod(['post']);

        $session=$this->request->getSession();

        $user=$session->read('Auth');

        $this->Notifications
            ->updateQuery()

            ->set([
                'is_read'=>1
            ])

            ->where([
                'user_id'=>$user['id']
            ])

            ->execute();

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode([
                'success'=>true
            ]));

    }

    //========================================================
    // CLEAR ALL
    //========================================================

    public function clearAll()
    {

        $this->request->allowMethod(['post']);

        $session=$this->request->getSession();

        $user=$session->read('Auth');

        $this->Notifications
            ->deleteQuery()

            ->where([
                'user_id'=>$user['id']
            ])

            ->execute();

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode([
                'success'=>true
            ]));

    }

}