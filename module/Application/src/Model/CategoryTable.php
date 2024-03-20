<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGatewayInterface;

class CategoryTable
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

    public function getCategory($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row with id $id");
        }
        return $row;
    }

    public function saveCategory(Category $category)
    {
        $data = [
            'name' => $category->getName(),
            'parent_id' => $category->getParentId(),
        ];

        $id = (int) $category->getId();

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (!$this->getCategory($id)) {
            throw new \Exception('Category id does not exist');
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteCategory($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}