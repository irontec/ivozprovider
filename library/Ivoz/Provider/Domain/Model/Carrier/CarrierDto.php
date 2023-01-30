<?php

namespace Ivoz\Provider\Domain\Model\Carrier;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

class CarrierDto extends CarrierDtoAbstract
{
    /**
     * @var ?CarrierStatus
     * @AttributeDefinition(
     *     type="object",
     *     class="Ivoz\Provider\Domain\Model\Carrier\CarrierStatus",
     *     description="Registration status"
     * )
     */
    private $status = null;

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'id' => 'id',
                'description' => 'description',
                'name' => 'name',
                'externallyRated' => 'externallyRated',
                'calculateCost' => 'calculateCost',
                'transformationRuleSetId' => 'transformationRuleSet',
                'balance' => 'balance',
                'proxyTrunkId' => 'proxyTrunk',
                'status' => ['registered']
            ];
        } else {
            $response = parent::getPropertyMap(...func_get_args());
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

    public function addStatus(CarrierStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = parent::toArray($hideSensitiveData);

        if (is_null($this->status)) {
            return $response;
        }

        $response['status'] = array_map(
            function (bool $registrationStatus): bool {
                return $registrationStatus;
            },
            $this->status->toArray()
        );
        return $response;
    }
}
