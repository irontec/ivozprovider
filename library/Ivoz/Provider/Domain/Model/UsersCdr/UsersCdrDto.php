<?php

namespace Ivoz\Provider\Domain\Model\UsersCdr;

class UsersCdrDto extends UsersCdrDtoAbstract
{
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'startTime' => 'startTime',
                'owner' => 'owner',
                'direction' => 'direction',
                'caller' => 'caller',
                'callee' => 'callee',
                'duration' => 'duration',
                'disposition' => 'disposition',
                'id' => 'id'
            ];
        } else {
            $response = parent::getPropertyMap(...func_get_args());
        }

        return $response;
    }
}
