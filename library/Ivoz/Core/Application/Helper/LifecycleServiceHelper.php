<?php

namespace Ivoz\Core\Application\Helper;

use Doctrine\Common\Inflector\Inflector;
use Ivoz\Core\Domain\Model\EntityInterface;

class LifecycleServiceHelper
{
    public static function getServiceName(EntityInterface $entity, $event)
    {
        $entityClass = EntityClassHelper::getEntityClass($entity);
        $classSegments = explode('\\', $entityClass);

        $prefix = $classSegments[1];
        $entityName = end($classSegments);
        $snakeCaseEntity = Inflector::tableize($entityName);
        $serviceName = $prefix . '.lifecycle.' . $snakeCaseEntity . '.' . $event;

        return strtolower($serviceName);
    }
}