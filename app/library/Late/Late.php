<?php

namespace Time\Late;

use Time\Models\Timers;
use Time\Models\Worktime;

class Late
{
    /**
     * check late or not
     */
    public static function isLate ($timerId) 
    {
        $timer = Timers::findFirstById($timerId);
        $timers = Timers::count([
            'usersId = :usersId: AND createdAt >= :date:',
            'bind' => [
                'usersId' => $timer->usersId,
                'date' => date("Y-m-d")
            ]
        ]);
        
        $worktime = Worktime::findFirst(1);
        $worktimeStart = new \DateTime($worktime->time);
        $timerStart = new \DateTime($timer->start);
        if ($timers == 1 && $worktimeStart < $timerStart) {
            $lates = new Lates;
            $lates->usersId = $timer->usersId;
            $lates->save();
        }
    }
}