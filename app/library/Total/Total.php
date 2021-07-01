<?php

/*
  +------------------------------------------------------------------------+
  | Vökuró                                                                 |
  +------------------------------------------------------------------------+
  | Copyright (c) 2016-present Phalcon Team (https://www.phalconphp.com)   |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
*/

namespace Time\Total;

use Time\Models\Timer;

class Total
{
    public static function totals($month, $year) {
        
        $dateFrom = $year.'-'.$month.'-1';

        $lastDate = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $dateTo = $year.'-'.$month.'-'.$lastDate;

        $timers = Timer::find([
            'createdAt >= :dateFrom: AND createdAt <= :dateTo:',
            'bind' => [
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
            ]
        ]);
        
        $totals = [];

        foreach ($timers as $timer) {
            $date = date('d',strtotime($timer->createdAt))*1;
            $usersId = $timer->usersId;

            $totals[$date][$usersId]['timers'][] = $timer;

            $startTime = $timer->start;
            $stopTime = $timer->stop;

            if ($stopTime == null && date('Y-m-d', strtotime($startTime)) == date('Y-m-d')) {
                $stopTime = date('Y-m-d H:i:s');
            } else if($stopTime == null) {
                $stopTime = date('Y-m-d 18:00:00');
            }

            $seansTotal = (strtotime($stopTime) - strtotime($startTime))/60;
            $seansTotal = round($seansTotal);
            
            if (array_key_exists('total',$totals[$date][$usersId])) {
                $totals[$date][$usersId]['total'] = self::minutesToHours($seansTotal, $totals[$date][$usersId]['total']);
            } else {
                $totals[$date][$usersId]['total'] = self::minutesToHours($seansTotal);
            }
        }

        return $totals;
    }

    public static function minutesToHours($minutes, $total = null) {
        $format = '%02d:%02d';

        if ($total != null) {
            $total  = explode(':',$total);
            $totalMinutes = $total[0] * 60 + $total[1];
            $minutes = $minutes + $totalMinutes;
        }
            
        $hours = floor($minutes / 60);
        $minutes = ($minutes % 60);
        
        return sprintf($format, $hours, $minutes);
    }


}

