<?php

namespace Ivoz\Provider\Domain\Model\PeerServer;

class PeerServerDto extends PeerServerDtoAbstract
{
    /**
     * @inheritdoc
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


