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

        if ($role === 'ROLE_BRAND_ADMIN') {
            unset($response['brandId']);
        } elseif ($role === 'ROLE_COMPANY_ADMIN') {
            unset($response['brandId']);
            unset($response['companyId']);
        } elseif ($role === 'ROLE_COMPANY_USER') {
            unset($response['brandId']);
            unset($response['companyId']);
        }

        return $response;
    }
}
