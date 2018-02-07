<?php

namespace Ivoz\Kam\Domain\Model\UsersCdr;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;


class UsersCdrDto extends UsersCdrDtoAbstract
{

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'startTime' => 'startTime',
                'endTime' => 'endTime',
                'duration' => 'duration',
                'direction' => 'direction',
                'caller' => 'caller',
                'callee' => 'callee'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}


