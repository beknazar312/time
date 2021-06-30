<?php

namespace Time\Controllers;

use Time\Models\Workday;

class WorkdayController extends ControllerBase
{

    public function updateAction()
    {
        if ($this->request->isPost()) {
            $workday = Workday::findFirst(1);
            $workday->time = $this->request->getPost('time');
            if ($workday->save()) {
                return $this->response->redirect('lates');
            }
        }
    }

}

