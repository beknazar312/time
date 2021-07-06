<?php

namespace Time\Controllers;

use Time\Models\Worktime;


class WorktimeController extends ControllerBase
{
    /**
     * update worktime
     */
    public function updateAction()
    {
        if ($this->request->isPost()) {
            $worktime = Worktime::findFirst(1);
            $worktime->time = $this->request->getPost('time');
            if ($worktime->save()) {
                return $this->response->redirect('lates');
            }
        }
    }
}

