<?php

namespace Ivoz\Provider\Domain\Model\CarrierServer;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

class CarrierServerDto extends CarrierServerDtoAbstract
{
    public const CONTEXT_STATUS = 'status';

    /**
     * @var ?CarrierServerStatus
     * @AttributeDefinition(
     *     type="object",
     *     class="Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerStatus",
     *     description="Registration status"
     * )
     */
    private $status;

    protected $sensitiveFields = [
        'authPassword',
    ];

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_STATUS) {
            $baseAttributes = [
                'id' => 'id',
                'ip' => 'ip',
                'hostname' => 'hostname',
                'sipProxy' => 'sipProxy',
                'authNeeded' => 'authNeeded',
                'status' => ['registered']
            ];

            if ($role === 'ROLE_BRAND_ADMIN') {
                $baseAttributes['companyId'] = 'company';
            }

            return $baseAttributes;
        }

        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'id' => 'id',
                'ip' => 'ip',
                'hostname' => 'hostname',
                'sipProxy' => 'sipProxy',
                'authNeeded' => 'authNeeded',
                'outboundProxy' => 'outboundProxy',
                'status' => ['registered']
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

    public function addStatus(CarrierServerStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = parent::toArray($hideSensitiveData);

        if (!is_null($this->status)) {
            $response['status'] = $this->status->toArray();
        }

        return $response;
    }
}
