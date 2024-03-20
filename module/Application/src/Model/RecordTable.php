<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGatewayInterface;

class RecordTable
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

    public function fetchAllWithDeviceName()
    {
        $sqlSelect = $this->tableGateway->getSql()->select();
        $sqlSelect->join('devices', 'devices.id = records.device_id', array('device_name' => 'name'), 'left');

        return $this->tableGateway->selectWith($sqlSelect);
    }

    public function getRecord($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row with id $id");
        }
        return $row;
    }

    public function saveRecord(Record $record)
    {
        $data = [
            'device_id' => $record->getDeviceId(),
            'status' => $record->getStatus(),
            'datetime' => (new \DateTime())->format('Y-m-d H:i:s'),
        ];

        $id = (int) $record->getId();

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (!$this->getRecord($id)) {
            throw new \Exception('Record id does not exist');
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteCategory($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}