<?php

namespace Ivoz\Core\Application\Helper;

use Doctrine\Common\Persistence\Proxy;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\EntityInterface;

class EntityClassHelper
{
    /**
     * @return string|false
     */
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

    /**
     * @return string|false
     */
    public static function getEntityClassByDto(DataTransferObjectInterface $dto)
    {
        $class = get_class($dto);

        return substr(
            $class,
            0,
            (strlen('Dto') * -1)
        );
    }
}
