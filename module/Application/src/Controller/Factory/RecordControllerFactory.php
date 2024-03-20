<?php

namespace Application\Controller\Factory;

use Application\Controller\RecordController;
use Application\Model\RecordTable;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class RecordControllerFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $recordTable = $container->get(RecordTable::class);
        return new RecordController($recordTable);
    }
}