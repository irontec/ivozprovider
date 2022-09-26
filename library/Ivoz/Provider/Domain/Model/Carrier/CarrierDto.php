<?php

namespace Ivoz\Provider\Domain\Model\Carrier;

class CarrierDto extends CarrierDtoAbstract
{
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
}
