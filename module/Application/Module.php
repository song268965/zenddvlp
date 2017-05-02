<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;

use Zend\Mvc\MvcEvent;

use Zend\Db\ResultSet\ResultSet;

use Zend\Db\TableGateway\TableGateway;

use Application\Model\News;

use Application\Model\NewsTable;
class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                )
            )
        );
    }

    public function getServiceConfig()
    {
        return array(
            
            'factories' => array(
                
                'Application\Model\NewsTable' => function ($sm) {
                    
                    $tg = $sm->get('NewsTableGateway');
                    
                    $table = new NewsTable($tg);
                    
                    return $table;
                },
                
                'NewsTableGateway' => function ($sm) {
                    
                    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                    
                    $rs = new ResultSet();
                    
                    $rs->setArrayObjectPrototype(new News());
                    
                    return new TableGateway('news', $adapter, null, $rs);
                }
            )
            
        )
        ;
    }
}
