<?php

namespace Ivoz\Provider\Domain\Model\RatingPlanGroup;

class RatingPlanGroupDto extends RatingPlanGroupDtoAbstract
{
    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'id' => 'id',
                'name' => ['en','es','ca','it'],
                'brandId' => 'brand',
                'currencyId' => 'currency'
            ];
        } else {
            $response = parent::getPropertyMap(...func_get_args());
        }

        if (in_array($role, ['ROLE_BRAND_ADMIN', 'ROLE_COMPANY_ADMIN'])) {
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
