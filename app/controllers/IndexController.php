<?php

namespace Time\Controllers;

use Time\Models\Users;
use Time\Models\Timer;
use Time\Calendar\Calendar;

class IndexController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateBefore('user');
    }

    public function indexAction()
    {

        if ($this->request->isPost()) {
            $month = $this->request->getPost('month');
            $year = $this->request->getPost('year');
        } else {
            $month = date('m');
            $year = date('Y');
        }

        $usersId = 2;
        $timers = Timer::find([
            'usersId = :usersId: AND createdAt >= :date:',
            'bind' => [
                'usersId' => $usersId,
                'date' => date("Y-m-d")
            ]
        ]);
        $today = date('d');
        $monthDays = Calendar::monthDays($month, $year);
        $user = Users::findFirstById(1);
        $users = Users::find([
            "active = 'Y'",
        ]);

        $this->view->timers = $timers;
        $this->view->today = $today;
        $this->view->month = $month;
        $this->view->year = $year;
        $this->view->monthDays = $monthDays;
        $this->view->users = $users;
        $this->view->user = $user;

        
    }

}

