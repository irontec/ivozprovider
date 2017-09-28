<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Lifecycle;

use Doctrine\Common\Inflector\Inflector;

trait EntityClassToServiceNameTrait
{
    protected function getServiceName($className, $event)
    {
        $classSegments = explode('\\', $className);

        $prefix = $classSegments[1];
        $entity = end($classSegments);
        $snakeCaseEntity = Inflector::tableize($entity);
        $serviceName = $prefix . '.lifecycle.' . $snakeCaseEntity . '.' . $event;

        return strtolower($serviceName);
    }
}