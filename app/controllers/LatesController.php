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

    //display lates list
    public function indexAction()
    {
        $date = date('Y-m-d');

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

        $this->view->lates = $lates;
        $this->view->worktime = $worktime;
        $this->view->years = $years;
        $this->view->monthes = $monthes;
        $this->view->days = $days;
        $this->view->day = $day;
        $this->view->month = $month;
        $this->view->year = $year;

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

