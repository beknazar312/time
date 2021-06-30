<?php
namespace Time\Controllers;

use Phalcon\Mvc\View;
use Time\Models\Users;

class UsersController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateBefore('admin');
    }

    public function indexAction()
    {
        $this->view->users = Users::find([
            "active = 'Y'",
        ]);
    }

    public function createAction()
    {
        if ($this->request->isPost()) {
            if ($this->request->isAjax()) {
                
                $user = new Users([
                    'name' => $this->request->getPost('name'),
                    'login' => $this->request->getPost('login'),
                    'email' => $this->request->getPost('email'),
                    'password' => $this->security->hash($this->request->getPost('password')),
                    'profilesId' => 2,
                ]);
                
                if ($user->save()) {
                    $users = Users::find(["active = 'Y'"]);
                    $this->response->setJsonContent(json_encode(['users' => $users]));
                    return $this->response;
                } else {
                    $this->response->setJsonContent(json_encode(['error' => 'wrong']));
                    return $this->response;
                }
            }
        }
    }


    public function deleteAction() 
    {
        if ($this->request->isPost()) {
            if ($this->request->isAjax()) {
                $user = Users::findFirstById($this->request->getPost('id'));
                $user->active =  'N'; 
                if ($user->save()) {
                    $users = Users::find(["active = 'Y'"]);
                    $this->response->setJsonContent(json_encode(['users' => $users]));
                    return $this->response;
                } else {
                    print_die($this->flash->error($user->getMessages()));
                    $this->response->setJsonContent(json_encode(['error' => 'Ошибка!']));
                    return $this->response;
                }
            }
        }
    }

}

