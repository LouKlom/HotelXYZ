<?php

namespace ContainerGJVdbt3;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getPortefeuilleServiceService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\Service\PortefeuilleService' shared autowired service.
     *
     * @return \App\Service\PortefeuilleService
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/Service/PortefeuilleServiceInterface.php';
        include_once \dirname(__DIR__, 4).'/src/Service/PortefeuilleService.php';

        return $container->privates['App\\Service\\PortefeuilleService'] = new \App\Service\PortefeuilleService(($container->services['doctrine.orm.default_entity_manager'] ?? $container->load('getDoctrine_Orm_DefaultEntityManagerService')));
    }
}
