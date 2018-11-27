<?php

namespace Ivoz\Provider\Domain\Model\CarrierServer;

class CarrierServerDto extends CarrierServerDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'ip' => 'ip',
                'hostname' => 'hostname',
                'sipProxy' => 'sipProxy',
                'authNeeded' => 'authNeeded',
            ];
        }

        $response = parent::getPropertyMap(...func_get_args());
        if (array_key_exists('lcrGatewayId', $response)) {
            unset($response['lcrGatewayId']);
        }

        return $response;
    }

    /**
     * @inheritdoc
     */
    public function toArray($hideSensitiveData = false)
    {
        $response = parent::toArray($hideSensitiveData);
        if (!$hideSensitiveData) {
            return $response;
        }
        $response['auth_password'] = '****';

        return $response;
    }
}
