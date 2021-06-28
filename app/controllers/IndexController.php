<?php

namespace Time\Controllers;

use Time\Models\Users;

class IndexController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateBefore('user');
    }

    public function indexAction()
    {
        $user = Users::findFirstById(1);
        $this->view->user = $user;
    }

}

