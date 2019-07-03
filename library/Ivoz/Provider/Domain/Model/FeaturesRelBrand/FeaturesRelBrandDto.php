<?php

namespace Ivoz\Provider\Domain\Model\FeaturesRelBrand;

class FeaturesRelBrandDto extends FeaturesRelBrandDtoAbstract
{
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'brandId' => 'brand',
                'featureId' => 'feature'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
