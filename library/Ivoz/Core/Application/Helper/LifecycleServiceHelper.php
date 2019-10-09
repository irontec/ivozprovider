<?php

namespace Ivoz\Core\Application\Helper;

use Doctrine\Common\Inflector\Inflector;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Service\CommonLifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\CommonPersistErrorHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;

class LifecycleServiceHelper
{
    public static function getServiceNameByEntity(EntityInterface $entity, string $event = 'service_collection'): string
    {
        $entityClass = EntityClassHelper::getEntityClass($entity);
        return self::getServiceNameByEntityFqdn($entityClass, $event);
    }

    public static function getServiceNameByEntityFqdn(string $entityClass, string $event): string
    {
        $classSegments = explode('\\', $entityClass);

        $prefix = $classSegments[1];
        $entityName = end($classSegments);
        $snakeCaseEntity = Inflector::tableize($entityName);
        $serviceName = $prefix . '.lifecycle.' . $snakeCaseEntity . '.' . $event;

        return strtolower($serviceName);
    }

    public static function getServiceTagByServiceFqdn(string $serviceClass, $event): string
    {
        $serviceInterfaces = class_implements($serviceClass);
        $targetInterface = null;

        $isEventSubscriberInterface = is_subclass_of(
            $serviceClass,
            DomainEventSubscriberInterface::class
        );

        if ($isEventSubscriberInterface) {
            $taggableServiceName = str_replace(
                [
                    '\\Event\\',
                    '\\Model\\'
                ],
                [
                    '\\',
                    '\\Service\\'
                ],
                $serviceClass
            );

            $serviceNamespace = substr(
                $taggableServiceName,
                0,
                strrpos($taggableServiceName, '\\')
            );

            return self::getServiceNameByEntityFqdn($serviceNamespace, $event);
        }

        foreach ($serviceInterfaces as $serviceInterface) {
            $isCommonServiceInterface =
                ($serviceInterface === CommonLifecycleEventHandlerInterface::class)
                || ($serviceInterface === CommonPersistErrorHandlerInterface::class);

            if ($isCommonServiceInterface) {
                return 'lifecycle.common.' . $event;
            }

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

    public static function getServiceCollectionTag(string $serviceClass): string
    {
        $serviceInterfaces = class_implements($serviceClass);
        $targetInterface = null;

        foreach ($serviceInterfaces as $serviceInterface) {
            $isServiceCollectionInterface = $serviceInterface === LifecycleServiceCollectionInterface::class;
            $isDomainEventSubscriberInterface = $serviceInterface === DomainEventSubscriberInterface::class;
            if (!$isServiceCollectionInterface && !$isDomainEventSubscriberInterface) {
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
