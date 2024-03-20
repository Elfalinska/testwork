<?php

namespace Application\Controller;

use Application\Model\DeviceTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DeviceController extends AbstractActionController
{
    private $deviceTable;

    public function __construct(DeviceTable $deviceTable)
    {
        $this->deviceTable = $deviceTable;
    }

    public function indexAction()
    {
        $status = $this->getRequest()->getQuery('status_filter');

        return new ViewModel(array(
            'status' => $status,
            'devices' => $this->deviceTable->fetchAllWithCategory($status),
        ));
    }

    public function updateAction()
    {
        $status = $this->getRequest()->getPost('status');
        $device_id = $this->getRequest()->getPost('device_id');

        $device = $this->deviceTable->getDevice($device_id);
        $device->setStatus($status);
        $this->deviceTable->saveDevice($device);

        $response = ['success' => true];
        $this->getResponse()->setContent(json_encode($response));
        return $this->getResponse();
    }
}