<?php

namespace Time\Controllers;

use Time\Models\Lates;
use Time\Models\Worktime;
use Time\Calendar\Calendar;


class LatesController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateBefore('admin');
    }

    /**
     * display lates list
     */
    public function indexAction()
    {

        if ($this->request->isPost()) {
            $day = $this->request->getPost('day');
            $month = $this->request->getPost('month');
            $year = $this->request->getPost('year');
        } else {
            $day = date('d');
            $month = date('m');
            $year = date('Y');
        }

        $date = $year.'-'.$month.'-'.$day;

        $lates = Lates::find([
            'DATE(createdAt) = :date:',
                'bind' => [
                    'date' => $date
                ]
            ]);
        $worktime = Worktime::findFirst(1);
        $monthes = Calendar::monthes(); //array with monthes
        $years = Calendar::years(); //array with years
        $days = Calendar::days($month, $year); //array with days

        $this->view->setVars([
            'lates' => $lates,
            'worktime' =>$worktime,
            'years' => $years,
            'monthes' => $monthes,
            'days' => $days,
            'day' => $day,
            'month' => $month,
            'year' => $year,
        ]);

    }

    //delete late
    public function deleteAction($id)
    {
        $late = Lates::findFirstById($id);
        if ($late->delete()) {
            return $this->response->redirect('lates');
        }
    }

}

