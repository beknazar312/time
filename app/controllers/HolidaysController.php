<?php

namespace Time\Controllers;

use Time\Models\Holidays;

class HolidaysController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateBefore('admin');
    }


    public function indexAction()
    {
        // get all holidays 
        $holidays = Holidays::find([
            'date>=:date: OR repeate=:repeate:',
            'order' => 'date',
            'bind' => [
                'date' => date('Y-m-1'),
                'repeate' => 'Y'
            ]
            ]);
        
        $this->view->holidays = $holidays;
    }

    public function createAction()
    {
        if ($this->request->isPost()) {
            $repeate = 'N';

            if ($this->request->getPost('repeate') == 'on') {
                $repeate = 'Y';
            }

            $holiday = new Holidays([
                'date' => $this->request->getPost('date'),
                'repeate' => $repeate,
            ]);

            if ($holiday->save()) {
                return $this->response->redirect('holidays');
            } else {
                $this->flash->error($holiday->getMessages());
            }
        }
    }

    public function deleteAction($id) 
    {
        $holiday = Holidays::findFirstById($id);
        if ($holiday->delete()) {
            return $this->response->redirect('holidays');
        } else {
            return $this->flash->error($holiday->getMessages());
        }
    }

}

