<?php

namespace Ivoz\Provider\Domain\Model\Destination;

class DestinationDto extends DestinationDtoAbstract
{
    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'prefix' => 'prefix',
                'id' => 'id',
                'name' => ['en','es'],
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
