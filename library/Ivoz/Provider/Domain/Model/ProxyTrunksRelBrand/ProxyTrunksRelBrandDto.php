<?php

namespace Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand;

class ProxyTrunksRelBrandDto extends ProxyTrunksRelBrandDtoAbstract
{
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'brandId' => 'brand',
                'proxyTrunkId' => 'proxyTrunk'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
