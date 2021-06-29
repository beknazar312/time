<?php

namespace Time\Controllers;

use Time\Models\Timer;
use Time\Models\Lates;

class TimerController extends ControllerBase
{
    public function initialize()
    {
        date_default_timezone_set("Asia/Bishkek");
    }

    public function indexAction()
    {
        
    }

    public function startAction() {
        if ($this->request->isPost()) {
            $usersId = 2;

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
                $this->response->setJsonContent(json_encode($timers));
                return $this->response;
            } else {
                $this->response->setJsonContent(json_encode(['error' => 'wrong']));
                return $this->response;
            }
        }
    }

    public function stopAction() {
        if ($this->request->isPost()) {
            $usersId = 2;

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
                $this->response->setJsonContent(json_encode($timers));
                return $this->response;
            } else {
                $this->response->setJsonContent(json_encode(['error' => 'wrong']));
                return $this->response;
            }
        }
    }

    protected function isLate ($timerId) {
        $timer = Timer::findFirstById($timerId);
        $timers = Timer::find([
            'usersId = :usersId: AND createdAt >= :date:',
            'bind' => [
                'usersId' => $timer->usersId,
                'date' => date("Y-m-d")
            ]
        ]);

        $today = date('Y-m-d H:i:s');
        $todayDateTime = new \DateTime($today);

        $startTime = $todayDateTime->setTime(9,0,1);

        if (count($timers) === 1 && $startTime < new \DateTime($timer->start)) {
            $lates = new Lates;
            $lates->usersId = $timer->usersId;
            $lates->save();
        }

    }

}
