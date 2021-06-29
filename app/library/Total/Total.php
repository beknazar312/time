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
        $timers = Timer::find([
            'createdAt >= :date:',
            'bind' => [
                'date' => $year.'-'.$month.'-1',
            ]
        ]);

        $totals = [];

        foreach ($timers as $timer) {
            $date = date('d',strtotime($timer->createdAt))*1;
            $usersId = $timer->usersId;

            $totals[$date][$usersId]['timers'][] = $timer;

            $seansTotal = (strtotime($timer->stop) - strtotime($timer->start))/60;
            $seansTotal = round($seansTotal);
            
            if (array_key_exists('total',$totals[$date][$usersId])) {
                $totals[$date][$usersId]['total'] += $seansTotal;
            } else {
                $totals[$date][$usersId]['total'] = $seansTotal;
            }
        }

        return $totals;
    }
}

