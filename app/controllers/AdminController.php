<?php
namespace Time\Controllers;

use Phalcon\Mvc\View;
use Time\Models\Users;

class AdminController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->users = Users::find([
            "active = 'Y'",
        ]);
    }

}

