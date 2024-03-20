<?php

namespace Application\Controller\Factory;

use Application\Controller\DeviceController;
use Application\Model\DeviceTable;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class DeviceControllerFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $deviceTable = $container->get(DeviceTable::class);
        return new DeviceController($deviceTable);
    }
}