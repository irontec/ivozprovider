<?php

namespace Ivoz\Provider\Domain\Model\BannedAddress;

class BannedAddressDto extends BannedAddressDtoAbstract
{
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'ip' => 'ip',
                'lastTimeBanned' => 'lastTimeBanned',
                'id' => 'id',
                'companyId' => 'company',
                'blocker' => 'blocker',
                'aor' => 'aor'
            ];
        } else {
            $response = parent::getPropertyMap($context, $role);
        }

        unset($response['brandId']);
        if ($role === 'ROLE_SUPER_ADMIN') {
            unset($response['companyId']);
        }

        return $response;
    }
}
