<?php

namespace Ivoz\Kam\Domain\Model\UsersAddress;

class UsersAddressDto extends UsersAddressDtoAbstract
{
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'sourceAddress' => 'sourceAddress',
                'description' => 'description',
                'id' => 'id',
                'companyId' => 'company'
            ];
        }

        $response = parent::getPropertyMap($context, $role);

        $blacklistedFlds = [
            'ipAddr',
            'mask',
            'port',
            'tag'
        ];

        foreach ($blacklistedFlds as $blacklistedFld) {
            unset($response[$blacklistedFld]);
        }

        return $response;
    }
}
