<?php

namespace Ivoz\Provider\Domain\Model\User;

class UserDto extends UserDtoAbstract
{
    const CONTEXT_MY_PROFILE = 'myProfile';

    const CONTEXT_TYPES = [
        self::CONTEXT_COLLECTION,
        self::CONTEXT_SIMPLE,
        self::CONTEXT_DETAILED,
        self::CONTEXT_MY_PROFILE
    ];

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'name' => 'name',
                'lastname' => 'lastname',
            ];
        }

        if ($context === self::CONTEXT_MY_PROFILE) {
            return [
                'id' => 'id',
                'name' => 'name',
                'lastname' => 'lastname',
                'email' => 'email',
                'doNotDisturb' => 'doNotDisturb',
                'isBoss' => 'isBoss',
                'active' => 'active',
                'maxCalls' => 'maxCalls'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}


