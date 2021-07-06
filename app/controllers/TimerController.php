<?php

namespace Time\Controllers;

use Time\Models\Timers;
use Time\Models\Lates;
use Time\Models\Worktime;
use Time\Calendar\Calendar;
use Time\Total\Total;
use Time\Late\Late;
use Time\Models\Users;


class TimerController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateBefore('admin');
    }

    /**
     * display timers table with all users for admin
     */
    public function indexAction()
    {
        if ($this->request->isPost()) {
            $month = $this->request->getPost('month');
            $year = $this->request->getPost('year');
        } else {
            $month = date('m');
            $year = date('Y');
        }

        $totals = Total::totals($month, $year); //get array with totals and timers for all users
        $calendar = Calendar::calendar($month, $year); //get array with calendar and total work hours of month
        $monthes = Calendar::monthes(); //array with monthes
        $years = Calendar::years(); //array with years
        $users = Users::find([
            "active = 'Y'",
        ]);

        $this->view->setVars([
            'totals' => $totals,
            'month' => $month,
            'year' => $year,
            'calendar' => $calendar,
            'users' => $users,
            'years' => $years,
            'monthes' => $monthes,
        ]);
        
    }

    /**
     * start and stop timer
     */
    public function timerAction() 
    {
        if ($this->request->isPost()) {
            $identity = $this->auth->getIdentity();
            $usersId = $identity['id'];
            if (!$this->request->getPost('id')) {
                $timer = new Timers;
                $timer->usersId = $usersId;
                $timer->start = date('Y-m-d H:i:s');
            } else {
                $timer = Timers::findFirstById($this->request->getPost('id'));
                $timer->stop = date('Y-m-d H:i:s');
            }

            if ($timer->save()) {
                if ($this->request->getPost('id')) {
                    Late::isLate($timer->id);
                }
                $timers = Timers::find([
                    'usersId = :usersId: AND createdAt >= :date:',
                    'bind' => [
                        'usersId' => $usersId,
                        'date' => date("Y-m-d")
                    ]
                ]);
                $this->response->setJsonContent(json_encode([
                    'timers' => $timers,
                    'total' => Total::today($timers)
                ]));

                return $this->response;
            } else {
                $this->response->setJsonContent(json_encode(['error' => 'wrong']));
                return $this->response;
            }
        }
    }

    /**
     * update timer by admin
     */
    public function updateAction()
    {
        if ($this->request->isPost()) {
            $timer = Timers::findFirstById($this->request->getPost('timerId'));
            $timerStartDate = date('Y-m-d', strtotime($timer->start));
            $timerStopDate = date('Y-m-d', strtotime($timer->stop));
            $usersId = $timer->usersId;
            
            $newStartTime = $this->request->getPost('start');
            $newStopTime = $this->request->getPost('stop');

            $timer->start = date('Y-m-d H:i:s', strtotime($timerStartDate.' '.$newStartTime));
            $timer->stop = date('Y-m-d H:i:s', strtotime($timerStopDate.' '.$newStopTime));

            if ($timer->save()) {
                $timers = Timers::find([
                    'usersId = :usersId: AND DATE_FORMAT(createdAt, "%Y-%m-%d") = :date:',
                    'bind' => [
                        'usersId' => $usersId,
                        'date' => $timerStartDate
                    ]
                ]);

                $id = '#'.date('j', strtotime($timerStartDate)).'-'.$usersId;
                
                $this->response->setJsonContent(json_encode([
                    'timers' => $timers,
                    'id' => $id,
                    'total' => $this->total($timers)
                ]));
                return $this->response;
            } else {
                $this->response->setJsonContent(json_encode(['error' => 'wrong']));
                return $this->response;
            }
        }
    } 
}

