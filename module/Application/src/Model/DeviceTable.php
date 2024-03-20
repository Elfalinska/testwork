<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGatewayInterface;

class DeviceTable
{
    protected $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function fetchAllWithCategory($status = null)
    {
        $sqlSelect = $this->tableGateway->getSql()->select();
        $sqlSelect->join('categories', 'categories.id = devices.category_id', array('category_name' => 'name'), 'left');

        if (isset($status) && $status != 0) {
            $sqlSelect->where('status = ' . $status);
        }

        return $this->tableGateway->selectWith($sqlSelect);
    }

    public function getDevice($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row with id $id");
        }
        return $row;
    }

    public function saveDevice(Device $device)
    {
        $data = [
            'name' => $device->getName(),
            'description' => $device->getDescription(),
            'category_id' => $device->getCategoryId(),
            'status' => $device->getStatus(),
        ];

        $id = (int) $device->getId();

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (!$this->getDevice($id)) {
            throw new \Exception('Device id does not exist');
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteDevice($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}
