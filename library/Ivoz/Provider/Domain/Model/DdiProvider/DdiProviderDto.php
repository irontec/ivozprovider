<?php

namespace Ivoz\Provider\Domain\Model\DdiProvider;

use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySet;

class DdiProviderDto extends DdiProviderDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            if ($role === 'ROLE_SUPER_ADMIN') {
                $response = [
                    'id' => 'id',
                    'name' => 'name',
                ];
            } else {
                $response = [
                    'id' => 'id',
                    'name' => 'name',
                    'description' => 'description',
                    'transformationRuleSetId' => 'transformationRuleSet',
                    'proxyTrunkId' => 'proxyTrunk',
                ];
            }
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
