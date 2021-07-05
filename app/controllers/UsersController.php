<?php
namespace Time\Controllers;

use Time\Models\Users;
use Time\Models\PasswordChanges;
use Time\Forms\ChangePasswordForm;

class UsersController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateBefore('admin');
    }

    public function indexAction()
    {
        $this->view->users = Users::find();
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
                    $users = Users::find();
                    $this->response->setJsonContent(json_encode(['users' => $users]));
                    return $this->response;
                } else {
                    $this->response->setJsonContent(json_encode(['errors' => 'wrong']));
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
                    $users = Users::find();
                    $this->response->setJsonContent(json_encode(['users' => $users]));
                    return $this->response;
                } else {
                    $this->response->setJsonContent(json_encode(['error' => 'Ошибка!']));
                    return $this->response;
                }
            }
        }
    }

    public function updateAction() 
    {
        if ($this->request->isPost()) {
            $user = Users::findFirstById($this->request->getPost('id'));
            $user->active = $this->request->getPost('active'); 
            $user->name = $this->request->getPost('name');
            $user->login = $this->request->getPost('login');
            $user->email = $this->request->getPost('email');
            if (!$user->save()) {
                foreach ($user->getMessages() as $message) {
                    $this->flash->error($message);
                }
            } 
            return $this->response->redirect('users');
        }
    }

    public function changePasswordAction()
    {
        $form = new ChangePasswordForm();

        if ($this->request->isPost()) {
            if (!$form->isValid($this->request->getPost())) {
                foreach ($form->getMessages() as $message) {
                    $this->flash->error($message);
                }
            } else {
                $user = $this->auth->getUser();

                $user->password = $this->security->hash($this->request->getPost('password'));

                $passwordChange = new PasswordChanges();
                $passwordChange->user = $user;
                $passwordChange->ipAddress = $this->request->getClientAddress();
                $passwordChange->userAgent = $this->request->getUserAgent();

                if (!$passwordChange->save()) {
                    $this->flash->error($passwordChange->getMessages());
                } else {
                    $this->flash->success('Your password was successfully changed');

                    $form->clear();
                }
            }
        }

        $this->view->form = $form;
    }
}

