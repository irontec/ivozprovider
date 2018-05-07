<?php

namespace Ivoz\Core\Application\Helper;

use Doctrine\Common\Inflector\Inflector;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;


class LifecycleServiceHelper
{
    public static function getServiceNameByEntity(EntityInterface $entity, $event)
    {
        $entityClass = EntityClassHelper::getEntityClass($entity);
        return self::getServiceNameByEntityFqdn($entityClass, $event);
    }

    public static function getServiceNameByEntityFqdn(string $entityClass, $event)
    {
        $classSegments = explode('\\', $entityClass);

        $prefix = $classSegments[1];
        $entityName = end($classSegments);
        $snakeCaseEntity = Inflector::tableize($entityName);
        $serviceName = $prefix . '.lifecycle.' . $snakeCaseEntity . '.' . $event;

        return strtolower($serviceName);
    }

    public static function getServiceTagByServiceFqdn(string $serviceClass, $event)
    {
        $serviceInterfaces = class_implements($serviceClass);
        $targetInterface = null;

        foreach ($serviceInterfaces as $serviceInterface) {

            $isDomainServiceInterface = is_subclass_of(
                $serviceInterface,
                LifecycleEventHandlerInterface::class
            );

            if (!$isDomainServiceInterface) {
                continue;
            }

            $serviceNamespace = substr(
                $serviceInterface,
                0,
                strrpos($serviceInterface, '\\')
            );

            return self::getServiceNameByEntityFqdn($serviceNamespace, $event);
        }

       throw new \Exception(
           "Could not resolve $serviceClass service tag"
       );
    }

    public static function getServiceCollectionTag(string $serviceClass)
    {
        $serviceInterfaces = class_implements($serviceClass);
        $targetInterface = null;

        foreach ($serviceInterfaces as $serviceInterface) {

            $isServiceCollectionInterface = $serviceInterface === LifecycleServiceCollectionInterface::class;
            if (!$isServiceCollectionInterface) {
                continue;
            }

            $serviceNamespace = substr(
                $serviceClass,
                0,
                strrpos($serviceClass, '\\')
            );

            return self::getServiceNameByEntityFqdn($serviceNamespace, 'service_collection');
        }

        throw new \Exception(
            "Could not resolve $serviceClass service tag"
        );
    }
}