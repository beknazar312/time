<?php

namespace Time\Controllers;

use Time\Models\Users;
use Time\Models\Lates;
use Time\Calendar\Calendar;
use Time\Total\Total;


class IndexController extends ControllerBase
{

    /**
     * page for stop-start 
     */
    public function indexAction()
    {
        $identity = $this->auth->getIdentity();
        $usersId = $identity['id'];

        if ($this->request->isPost()) {
            $month = $this->request->getPost('month');
            $year = $this->request->getPost('year');
        } else {
            $month = date('m');
            $year = date('Y');
        }
        
        $totals = Total::totals($month, $year); //get array with totals and timers for all users
        $totalHoursOfMonth = Total::totalHoursOfMonth($month, $year, $usersId); //get total hours of month for this users
        $calendar = Calendar::calendar($month, $year); //get array with calendar and total work hours of month
        $monthes = Calendar::monthes(); //array with monthes
        $years = Calendar::years(); //array with years
        $user = Users::findFirstById($usersId);
        $users = Users::find([
            "active = 'Y'",
            "order" => 'id='.$usersId.' DESC'
        ]);

        /**
         * get first and last day of month
         */
        $dateFrom = $year.'-'.$month.'-1'; 
        $lastDate = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $dateTo = $year.'-'.$month.'-'.$lastDate; 

        /**
         * get how match time late this user
         */
        $lates = Lates::count([
            'createdAt >= :dateFrom: AND createdAt <= :dateTo: AND usersId = :usersId:',
            'bind' => [
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'usersId' => $usersId
            ]
        ]);
        
        $this->view->setVars([
            'totalHoursOfMonth' => $totalHoursOfMonth,
            'totals' => $totals,
            'month' => $month,
            'years' => $years,
            'year' => $year,
            'calendar' => $calendar,
            'monthes' => $monthes,
            'users' => $users,
            'user' => $user,
            'lates' => $lates,
            'administrator' => $identity['profile']  == 'Administrators',
        ]);
    }

}

