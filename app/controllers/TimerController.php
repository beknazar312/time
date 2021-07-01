<?php

namespace Time\Controllers;

use Time\Models\Timer;
use Time\Models\Lates;
use Time\Models\Workday;
use Time\Calendar\Calendar;
use Time\Total\Total;
use Time\Models\Users;

class TimerController extends ControllerBase
{
    public function initialize()
    {
        
        $this->view->setTemplateBefore('admin');
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

        $calendar = new Calendar;
        $calendar = $calendar->calendar($month, $year);

        $users = Users::find([
            "active = 'Y'",
        ]);
        
        $this->view->totals = $totals;
        $this->view->month = $month;
        $this->view->year = $year;
        $this->view->calendar = $calendar;
        $this->view->users = $users;
    }

    public function startAction() 
    {
        if ($this->request->isPost()) {
            $usersId = 4;

            $timer = new Timer;
            $timer->usersId = $usersId;
            if ($timer->save()) {
                $this->isLate($timer->id);
                $timers = Timer::find([
                    'usersId = :usersId: AND createdAt >= :date:',
                    'bind' => [
                        'usersId' => $usersId,
                        'date' => date("Y-m-d")
                    ]
                ]);
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

    public function stopAction() 
    {
        if ($this->request->isPost()) {
            $usersId = 4;

            $timer = Timer::findFirstById($this->request->getPost('id'));
            $timer->stop = date('Y-m-d H:i:s');
            if ($timer->save()) {
                $timers = Timer::find([
                    'usersId = :usersId: AND createdAt >= :date:',
                    'bind' => [
                        'usersId' => $usersId,
                        'date' => date("Y-m-d")
                    ]
                ]);
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

    public function updateAction()
    {
        if ($this->request->isPost()) {
            $timer = Timer::findFirstById($this->request->getPost('timerId'));
            $timerStartDate = date('Y-m-d', strtotime($timer->start));
            $timerStopDate = date('Y-m-d', strtotime($timer->stop));
            $usersId = $timer->usersId;
            
            $newStartTime = $this->request->getPost('start');
            $newStopTime = $this->request->getPost('stop');

            $timer->start = date('Y-m-d H:i:s', strtotime($timerStartDate.' '.$newStartTime));
            $timer->stop = date('Y-m-d H:i:s', strtotime($timerStopDate.' '.$newStopTime));
            if ($timer->save()) {
                $timers = Timer::find([
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

    protected function isLate ($timerId) 
    {
        $timer = Timer::findFirstById($timerId);
        $timers = Timer::find([
            'usersId = :usersId: AND createdAt >= :date:',
            'bind' => [
                'usersId' => $timer->usersId,
                'date' => date("Y-m-d")
            ]
        ]);

        $workday = Workday::findFirst(1);
        $workdayStart = new \DateTime($workday->time);
        $timerStart = $timer->start;

        if (count($timers) === 1 && $workdayStart < $timerStart) {
            $lates = new Lates;
            $lates->usersId = $timer->usersId;
            $lates->save();
        }
    }

    public function total($timers) {
        $format = '%02d:%02d';
        $minutes = 0;

        foreach ($timers as $timer) {
            if ($timer->stop != null) {
                $minutes += (strtotime($timer->stop) - strtotime($timer->start))/60;
            } else {
                $minutes += (strtotime(date('Y-m-d H:i:s')) - strtotime($timer->start))/60;
            }
            
            $minutes = round($minutes);
        }

        $hours = floor($minutes / 60);
        $minutes = ($minutes % 60);
        
        return sprintf($format, $hours, $minutes);
    }

}

