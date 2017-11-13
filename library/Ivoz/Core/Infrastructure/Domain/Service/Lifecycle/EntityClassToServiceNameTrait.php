<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Lifecycle;

use Doctrine\Common\Inflector\Inflector;
use Doctrine\Common\Persistence\Proxy;
use Ivoz\Core\Domain\Model\EntityInterface;

trait EntityClassToServiceNameTrait
{
    protected function getServiceName(EntityInterface $entity, $event)
    {
        $entityClass = $this->getEntityClass($entity);
        $classSegments = explode('\\', $entityClass);

        $prefix = $classSegments[1];
        $entityName = end($classSegments);
        $snakeCaseEntity = Inflector::tableize($entityName);
        $serviceName = $prefix . '.lifecycle.' . $snakeCaseEntity . '.' . $event;

        return strtolower($serviceName);
    }

    protected function getEntityClass($entity)
    {
        return $entity instanceof \Doctrine\ORM\Proxy\Proxy
            ? $this->getProxiedClass($entity)
            : get_class($entity);
    }

    protected function getProxiedClass(EntityInterface $entity)
    {
        $class = get_class($entity);

        return substr(
            $class,
            strpos($class,Proxy::MARKER) + Proxy::MARKER_LENGTH + 1
        );
    }
}