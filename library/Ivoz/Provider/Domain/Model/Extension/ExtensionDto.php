<?php

namespace Ivoz\Provider\Domain\Model\Extension;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;


class ExtensionDto extends ExtensionDtoAbstract
{

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'number' => 'number'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}


