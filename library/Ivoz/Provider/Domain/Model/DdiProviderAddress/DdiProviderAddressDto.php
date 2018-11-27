<?php

namespace Ivoz\Provider\Domain\Model\DdiProviderAddress;

class DdiProviderAddressDto extends DdiProviderAddressDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'ip' => 'ip',
                'description' => 'description',
                'id' => 'id'
            ];
        }

        $response = parent::getPropertyMap(...func_get_args());
        if (array_key_exists('trunksAddressId', $response)) {
            unset($response['trunksAddressId']);
        }

        return $response;
    }
}
