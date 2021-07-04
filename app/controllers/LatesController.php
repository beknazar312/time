<?php

namespace Time\Controllers;

use Time\Models\Lates;
use Time\Models\Worktime;

class LatesController extends ControllerBase
{

    public function initialize()
    {
        $this->view->setTemplateBefore('admin');
    }

    public function indexAction()
    {
        $date = date('Y-m-d');
        if ($this->request->isPost()) {
            $date = $this->request->getPost('date');
        }
        $lates = Lates::find([
            'createdAt >= :date:',
                'bind' => [
                    'date' => $date
                ]
            ]);
        $worktime = Worktime::findFirst(1);

        $this->view->lates = $lates;
        $this->view->worktime = $worktime;

    }

    public function deleteAction($id)
    {
        $late = Lates::findFirstById($id);
        if ($late->delete()) {
            return $this->response->redirect('lates');
        }
    }

}

