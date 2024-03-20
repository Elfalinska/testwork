<?php

namespace Application\Controller;

use Application\Model\Record;
use Application\Model\RecordTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RecordController extends AbstractActionController
{
    private $recordTable;

    public function __construct(RecordTable $recordTable)
    {
        $this->recordTable = $recordTable;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'records' => $this->recordTable->fetchAllWithDeviceName(),
        ));
    }


    public function addRecordAction()
    {
        $status = $this->getRequest()->getPost('status');
        $device_id = $this->getRequest()->getPost('device_id');

        $record = new Record();
        $record->setStatus($status);
        $record->setDeviceId($device_id);
        $this->recordTable->saveRecord($record);

        $response = ['success' => true];
        $this->getResponse()->setContent(json_encode($response));
        return $this->getResponse();
    }
}