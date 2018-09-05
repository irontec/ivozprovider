<?php

namespace Ivoz\Core\Application\Helper;

use Doctrine\Common\Persistence\Proxy;
use Ivoz\Core\Domain\Model\EntityInterface;

class EntityClassHelper
{
    public static function getEntityClass(EntityInterface $entity)
    {
        $class = get_class($entity);
        if (!($entity instanceof \Doctrine\ORM\Proxy\Proxy)) {
            return $class;
        }

        return substr(
            $class,
            strpos($class, Proxy::MARKER) + Proxy::MARKER_LENGTH + 1
        );
    }
}
