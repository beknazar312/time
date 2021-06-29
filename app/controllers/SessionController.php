<?php

namespace Time\Controllers;

use Time\Models\Users;
use Time\Exception\Exception;
use Time\Models\ResetPasswords;
use Time\Forms\ForgotPasswordForm;
use Time\Validation\LoginValidation;

/**
 * Controller used handle non-authenticated session actions like login/logout, user signup, and forgotten passwords
 * Time\Controllers\SessionController
 * @package Time\Controllers
 */
class SessionController extends ControllerBase
{


    public function indexAction()
    {
        
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
                $user->active =  0; 
                if ($user->save()) {
                    $users = Users::find(["active = 'Y'"]);
                    $this->response->setJsonContent(json_encode(['users' => $users]));
                    return $this->response;
                } else {
                    $this->response->setJsonContent(json_encode(['error' => 'Ошибка!']));
                    return $this->response;
                }
            }
        }
    }
    /**
     * Starts a session in the admin backend
     */
    public function loginAction()
    {
        try {
            if (!$this->request->isPost()) {
                if ($this->auth->hasRememberMe()) {
                    return $this->auth->loginWithRememberMe();
                }
            } else {
                $validation = new LoginValidation;
                $messages = $validation->validate($this->request->getPost());
                if (count($messages)) {
                    foreach ($messages as $message) {
                        $this->flash->error($message);
                    }
                } else {
                    $this->auth->check([
                        'email' => $this->request->getPost('email'),
                        'password' => $this->request->getPost('password'),
                        'remember' => $this->request->getPost('remember')
                    ]);

                    return $this->response->redirect('users');
                }
            }
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }

    }

    /**
     * Shows the forgot password form
     */
    public function forgotPasswordAction()
    {
        if ($this->request->isPost()) {
            // Send emails only is config value is set to true
            if ($this->getDI()->get('config')->useMail) {
                if ($form->isValid($this->request->getPost()) == false) {
                    foreach ($form->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                } else {
                    $user = Users::findFirstByEmail($this->request->getPost('email'));
                    if (!$user) {
                        $this->flash->success('There is no account associated to this email');
                    } else {
                        $resetPassword = new ResetPasswords();
                        $resetPassword->usersId = $user->id;
                        if ($resetPassword->save()) {
                            $this->flash->success('Success! Please check your messages for an email reset password');
                        } else {
                            foreach ($resetPassword->getMessages() as $message) {
                                $this->flash->error($message);
                            }
                        }
                    }
                }
            } else {
                $this->flash->warning(
                    'Emails are currently disabled. Change config key "useMail" to true to enable emails.'
                );
            }
        }

        $this->view->form = $form;
    }

    /**
     * Closes the session
     */
    public function logoutAction()
    {
        $this->auth->remove();

        return $this->response->redirect('index');
    }
}

