<?php

namespace Time\Controllers;

use Time\Models\Users;
use Time\Models\Timer;
use Time\Calendar\Calendar;
use Time\Total\Total;

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

        $totals = Total::totals($month, $year);

        $usersId = 4;
        $timers = Timer::find([
            'usersId = :usersId: AND createdAt >= :date:',
            'bind' => [
                'usersId' => $usersId,
                'date' => date("Y-m-d")
            ]
        ]);
        $monthDays = Calendar::monthDays($month, $year);
        $user = Users::findFirstById($usersId);
        $users = Users::find([
            "active = 'Y'",
            "order" => 'id='.$usersId.' DESC'
        ]);
        

        $this->view->totals = $totals;
        $this->view->timers = $timers;
        $this->view->month = $month;
        $this->view->year = $year;
        $this->view->monthDays = $monthDays;
        $this->view->users = $users;
        $this->view->user = $user;

        
    }

}

