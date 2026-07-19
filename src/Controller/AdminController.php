<?php
declare(strict_types=1);

namespace App\Controller;

class AdminController extends AppController
{
    public function beforeRender(\Cake\Event\EventInterface $event)
    {
        parent::beforeRender($event);

        $this->viewBuilder()->setLayout('admin');
    }

    public function dashboard()
    {

    }

    public function reports()
    {

    }
}