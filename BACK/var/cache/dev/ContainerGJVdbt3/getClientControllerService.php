<?php

namespace ContainerGJVdbt3;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getClientControllerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'App\Controller\ClientController' shared autowired service.
     *
     * @return \App\Controller\ClientController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
        include_once \dirname(__DIR__, 4).'/src/Controller/ClientController.php';
        include_once \dirname(__DIR__, 4).'/src/Service/ClientServiceInterface.php';
        include_once \dirname(__DIR__, 4).'/src/Service/ClientService.php';

        $container->services['App\\Controller\\ClientController'] = $instance = new \App\Controller\ClientController(new \App\Service\ClientService(($container->services['doctrine.orm.default_entity_manager'] ?? $container->load('getDoctrine_Orm_DefaultEntityManagerService')), ($container->services['doctrine.dbal.default_connection'] ?? $container->load('getDoctrine_Dbal_DefaultConnectionService'))));

        $instance->setContainer(($container->privates['.service_locator.jUv.zyj'] ?? $container->load('get_ServiceLocator_JUv_ZyjService'))->withContext('App\\Controller\\ClientController', $container));

        return $instance;
    }
}
