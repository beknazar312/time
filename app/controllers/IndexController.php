<?php

namespace Time\Controllers;

use Time\Models\Users;
use Time\Models\Timer;
use Time\Calendar\Calendar;
use Time\Total\Total;

class IndexController extends ControllerBase
{

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
        
        $calendar = new Calendar;
        $calendar = $calendar->calendar($month, $year);
        $user = Users::findFirstById($usersId);
        $users = Users::find([
            "active = 'Y'",
            "order" => 'id='.$usersId.' DESC'
        ]);
        
        $this->view->totals = $totals;
        $this->view->month = $month;
        $this->view->year = $year;
        $this->view->calendar = $calendar;
        $this->view->users = $users;
        $this->view->user = $user;
    }

}

