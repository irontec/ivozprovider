<?php

namespace Ivoz\Provider\Domain\Model\RouteLock;

class RouteLockDto extends RouteLockDtoAbstract
{
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'name' => 'name',
                'open' => 'open',
                'id' => 'id',
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
