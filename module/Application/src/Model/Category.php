<?php

namespace Application\Model;

class Category
{
    /** @var int */
    private $id;

    /** @var int */
    private $parent_id;

    /** @var string */
    private $name;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parent_id;
    }
}