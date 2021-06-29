<?php

namespace Time\Calendar;

class Calendar
{
    public static function monthDays ($month = 6, $year = 2021) 
    {
        $daysCount = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $calendar =  [];

        for ($i = 1; $i<=$daysCount; $i++)
        {
            $jd=gregoriantojd($month,$i,$year);
            $calendar[$i] = jddayofweek($jd,1);
        }

        return $calendar;
    }
}