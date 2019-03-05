<?php

namespace Ivoz\Provider\Domain\Model\RatingPlanGroup;

class RatingPlanGroupDto extends RatingPlanGroupDtoAbstract
{
    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'name' => ['en','es'],
                'brandId' => 'brand',
                'currencyId' => 'currency'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
