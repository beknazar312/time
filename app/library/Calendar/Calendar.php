<?php

namespace Time\Calendar;

use Time\Models\Holidays;

class Calendar
{
    public static function calendar ($month, $year) 
    {
        $calendar =  [
            'workhours' => 0,
            'calendar' => []
            ];

        $daysCount = cal_days_in_month(CAL_GREGORIAN, $month, $year); 

        $holidays = self::getHolidays($daysCount, $month, $year);

        for ($i = 1; $i<=$daysCount; $i++)
        {
            $jd=gregoriantojd($month,$i,$year); 
            $day = jddayofweek($jd,1); //get day name of week
            $calendar['calendar'][$i]['day'] = $day;

            if ($day == 'Saturday' || $day == 'Sunday' || in_array($i,$holidays)) {
                $calendar['calendar'][$i]['weekend'] = true;
            } else {
                $calendar['calendar'][$i]['weekend'] = false;
                $calendar['workhours'] += 8;
            }
        }

        return $calendar;
    }

    public static function  getHolidays($lastDate, $month, $year)
    {
        $dateFrom = $year.'-'.$month.'-1';
        $dateTo = $year.'-'.$month.'-'.$lastDate;

        $holidays = Holidays::find([
            'date >= :dateFrom: AND date <= :dateTo: OR month(date) = '.$month.' AND repeate = :repeate:',
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

    public static function monthes() 
    {
        return [
            1 => 'January',  
            2 => 'February', 
            3 => 'March',    
            4 => 'April',    
            5 => 'May',      
            6 => 'june',     
            7 => 'July',     
            8 => 'August',   
            9 => 'September',
            10 => 'October',  
            11 => 'November', 
            12 => 'December' 
        ];
    }

    public static function years() 
    {
        $years = [];

        for ($i = 2009; $i <= 2021; $i++) {
            $years[$i] = $i;
        }
        return $years;
    }

    public static function days($month, $year) 
    {
        $days = [];

        $daysCount = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        for ($i = 1; $i <= $daysCount; $i++) {
            $days[$i] = $i;
        }
        return $days;
    }


}