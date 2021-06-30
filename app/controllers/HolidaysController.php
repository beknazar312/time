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
        
        $holidays = Holidays::find([
            'date>=:date: OR repeateDate=:repeate:',
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
            // print_die($this->request->getPost('date'));
            $repeate = 'N';
            if ($this->request->getPost('repeate') == 'on') {
                $repeate = 'Y';
            }

            $holiday = new Holidays([
                'date' => $this->request->getPost('date'),
                'repeateDate' => $repeate,
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
            $this->flash->error($holiday->getMessages());
        }
    }

}

