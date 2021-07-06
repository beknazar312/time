<?php

namespace Time\Controllers;

use Time\Exception\Exception;
use Time\Validation\LoginValidation;

/**
 * Controller used handle non-authenticated session actions like login/logout, user signup, and forgotten passwords
 * Time\Controllers\SessionController
 * @package Time\Controllers
 */
class SessionController extends ControllerBase
{
    /**
     * login
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

                    return $this->response->redirect('index');
                }
            }
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }

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

