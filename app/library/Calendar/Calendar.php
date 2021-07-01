<?php

namespace Time\Calendar;

use Time\Models\Holidays;

class Calendar
{
    public function calendar ($month, $year) 
    {
        $calendar =  [
            'workdays' => 0,
            'workhours' => 0,
            'calendar' => []
            ];

        $daysCount = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $holidays = $this->getHolidays($daysCount, $month, $year);

        for ($i = 1; $i<=$daysCount; $i++)
        {
            $jd=gregoriantojd($month,$i,$year);
            $day = jddayofweek($jd,1);
            $calendar['calendar'][$i]['day'] = $day;

            if ($day == 'Saturday' || $day == 'Sunday' || in_array($i,$holidays)) {
                $calendar['calendar'][$i]['weekend'] = true;
            } else {
                $calendar['calendar'][$i]['weekend'] = false;
            }
        }

        return $calendar;
    }

    protected function  getHolidays($lastDate, $month, $year)
    {
        $dateFrom = $year.'-'.$month.'-1';
        $dateTo = $year.'-'.$month.'-'.$lastDate;

        $holidays = Holidays::find([
            'date >= :dateFrom: AND date <= :dateTo: OR month(date) = '.$month.' AND repeateDate = :repeate:',
            'order' => 'date',
            'bind' => [
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'repeate' => 'Y'
            ]
            ]);
        
        $holydaysDates = [];

        foreach ($holidays as $holiday) {
            $holydaysDates[] = date('d', strtotime($holiday->date));
        }

        return $holydaysDates;
    }


}