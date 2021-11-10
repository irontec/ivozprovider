<?php

namespace Ivoz\Provider\Domain\Model\CarrierServer;

class CarrierServerDto extends CarrierServerDtoAbstract
{
    protected $sensitiveFields = [
        'authPassword',
    ];

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'id' => 'id',
                'ip' => 'ip',
                'hostname' => 'hostname',
                'sipProxy' => 'sipProxy',
                'authNeeded' => 'authNeeded',
            ];
        } else {
            $response = parent::getPropertyMap(...func_get_args());
            if (array_key_exists('lcrGatewayId', $response)) {
                unset($response['lcrGatewayId']);
            }
        }

        if ($role === 'ROLE_BRAND_ADMIN') {
            unset($response['brandId']);
        }

        return $response;
    }

    public function denormalize(array $data, string $context, string $role = ''): void
    {
        $contextProperties = self::getPropertyMap($context, $role);
        if ($role === 'ROLE_BRAND_ADMIN') {
            $contextProperties['brandId'] = 'brand';
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
    }
}
