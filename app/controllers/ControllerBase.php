<?php

namespace Time\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

class ControllerBase extends Controller
{
    /**
     * Execute before the router so we can determine if this is a private controller, and must be authenticated, or a
     * public controller that is open to all.
     *
     * @param Dispatcher $dispatcher
     * @return boolean
     */
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        $controllerName = $dispatcher->getControllerName();

        // Only check permissions on private controllers
        if ($this->acl->isPrivate($controllerName)) {
            // Get the current identity
            $identity = $this->auth->getIdentity();

            // If there is no identity available the user is redirected to index/index
            if (!is_array($identity)) {
                $this->flash->notice('You don\'t have access to this module: private');

                $dispatcher->forward([
                    'controller' => 'session',
                    'action' => 'login'
                ]);

                return false;
            }
            
            // If is guest
            if ($identity['profile'] == 'Guest') {

            }

            // Check if the user have permission to the current option
            $actionName = $dispatcher->getActionName();
            if (!$this->acl->isAllowed($identity['profile'], $controllerName, $actionName)) {
                $this->flash->notice('You don\'t have access to this module: ' . $controllerName . ':' . $actionName);

                // If is guest
                if ($identity['profile'] == 'Guest') {
                    $dispatcher->forward([
                        'controller' => 'index',
                        'action' => 'readOnly'
                    ]);
                } else {
                    $dispatcher->forward([
                        'controller' => 'index',
                        'action' => 'index'
                    ]);
                }

                return false;
            }
        }
    }
}


