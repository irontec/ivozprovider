<?php

namespace Ivoz\Provider\Domain\Model\TransformationRuleSet;

class TransformationRuleSetDto extends TransformationRuleSetDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'description' => 'description',
                'internationalCode' => 'internationalCode',
                'trunkPrefix' => 'trunkPrefix',
                'areaCode' => 'areaCode',
                'nationalLen' => 'nationalLen',
                'id' => 'id',
                'name' => ['en','es','ca','it'],
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
