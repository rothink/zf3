<?php
/**
 * Created by PhpStorm.
 * User: rothink
 * Date: 20/05/18
 * Time: 21:13
 */

namespace Blog;

use Blog\Controller\BlogController;
use Blog\Model\PostTable;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\PostTable::class => function ($container) {
                    $tableGateway = $container->get(Model\PostTableGateway::class);
                    return new Model\PostTable($tableGateway);
                },
                Model\PostTableGateway::class => function($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Post());
                    return new TableGateway('post', $dbAdapter, null, $resultSetPrototype);
                }
            ]
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                BlogController::class => function ($container) {
                    return new BlogController(
                        $container->get(Model\PostTable::class)
                    );
                }
            ]
        ];
    }
}