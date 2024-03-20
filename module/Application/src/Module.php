<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Model\Device;
use Application\Model\DeviceTable;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    const VERSION = '3.1.3';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\DeviceTable::class => function($container) {
                    $tableGateway = $container->get(Model\DeviceTableGateway::class);
                    return new Model\DeviceTable($tableGateway);
                },
                Model\DeviceTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Device());
                    return new TableGateway('devices', $dbAdapter, null, $resultSetPrototype);
                },
                Model\RecordTable::class => function($container) {
                    $tableGateway = $container->get(Model\RecordTableGateway::class);
                    return new Model\RecordTable($tableGateway);
                },
                Model\RecordTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Record());
                    return new TableGateway('records', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\DeviceController::class => function($container) {
                    return new Controller\DeviceController(
                        $container->get(Model\DeviceTable::class)
                    );
                },
                Controller\RecordController::class => function($container) {
                    return new Controller\RecordController(
                        $container->get(Model\RecordTable::class)
                    );
                },
            ],
        ];
    }
}
