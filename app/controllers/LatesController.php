<?php

namespace Time\Controllers;

use Time\Models\Lates;
use Time\Models\Workday;

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

        $workday = Workday::findFirst(1);

        $this->view->lates = $lates;
        $this->view->workday = $workday;
    }

    public function deleteAction($id)
    {
        $workday = Lates::findFirstById($id);
        if ($workday->delete()) {
            return $this->response->redirect('lates');
        }
    }

}

