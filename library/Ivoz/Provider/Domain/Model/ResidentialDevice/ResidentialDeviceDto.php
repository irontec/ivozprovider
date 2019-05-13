<?php

namespace Ivoz\Provider\Domain\Model\ResidentialDevice;

class ResidentialDeviceDto extends ResidentialDeviceDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $rol = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'name' => 'name',
                'transport' => 'transport',
                'authNeeded' => 'authNeeded'
            ];
        }

        $response = parent::getPropertyMap(...func_get_args());
        if (array_key_exists('domainId', $response)) {
            unset($response['domainId']);
        }

        return $response;
    }
}
