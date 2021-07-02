<?php

namespace Time\Controllers;

use Time\Models\Users;
use Time\Models\Timer;
use Time\Models\Lates;
use Time\Calendar\Calendar;
use Time\Total\Total;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $identity = $this->auth->getIdentity();
        $usersId = $identity['id'];
        $this->view->setVar('administrator', $identity['profile']  == 'Administrators');
        
        if ($this->request->isPost()) {
            $month = $this->request->getPost('month');
            $year = $this->request->getPost('year');
        } else {
            $month = date('m');
            $year = date('Y');
        }

        $totals = Total::totals($month, $year);
        $totalHoursOfMonth = Total::totalHoursOfMonth($month, $year, $usersId);
        $calendar = Calendar::calendar($month, $year);
        $monthes = Calendar::monthes();
        $years = Calendar::years();
        $user = Users::findFirstById($usersId);
        $users = Users::find([
            "active = 'Y'",
            "order" => 'id='.$usersId.' DESC'
        ]);

        $dateFrom = $year.'-'.$month.'-1';
        $lastDate = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $dateTo = $year.'-'.$month.'-'.$lastDate;
        $lates = Lates::count([
            'createdAt >= :dateFrom: AND createdAt <= :dateTo: AND usersId = :usersId:',
            'bind' => [
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'usersId' => $usersId
            ]
        ]);
        
        $this->view->totalHoursOfMonth = $totalHoursOfMonth;
        $this->view->totals = $totals;
        $this->view->month = $month;
        $this->view->years = $years;
        $this->view->year = $year;
        $this->view->calendar = $calendar;
        $this->view->monthes = $monthes;
        $this->view->users = $users;
        $this->view->user = $user;
        $this->view->lates = $lates;
    }

}

