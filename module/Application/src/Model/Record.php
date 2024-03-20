<?php

namespace Application\Model;

class Record
{
    /** @var int */
    private $id;

    /** @var int */
    private $device_id;

    /** @var int */
    private $status;

    private $datetime;

    private $device_name;

    public function exchangeArray(array $data)
    {
        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->device_id = !empty($data['device_id']) ? $data['device_id'] : null;
        $this->status = !empty($data['status']) ? $data['status'] : null;
        $this->datetime = !empty($data['datetime']) ? $data['datetime'] : null;
        $this->device_name = !empty($data['device_name']) ? $data['device_name'] : null;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getDeviceId()
    {
        return $this->device_id;
    }

    /**
     * @param int $device_id
     */
    public function setDeviceId($device_id)
    {
        $this->device_id = $device_id;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * @param mixed $datetime
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;
    }

    /**
     * @return mixed
     */
    public function getDeviceName()
    {
        return $this->device_name;
    }

    /**
     * @param mixed $device_name
     */
    public function setDeviceName($device_name)
    {
        $this->device_name = $device_name;
    }
}