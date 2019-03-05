<?php

namespace Ivoz\Provider\Domain\Model\RatingPlan;

class RatingPlanDto extends RatingPlanDtoAbstract
{
    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'weight' => 'weight',
                'timingType' => 'timingType',
                'timeIn' => 'timeIn',
                'monday' => 'monday',
                'tuesday' => 'tuesday',
                'wednesday' => 'wednesday',
                'thursday' => 'thursday',
                'friday' => 'friday',
                'saturday' => 'saturday',
                'sunday' => 'sunday',
                'id' => 'id',
                'ratingPlanGroupId' => 'ratingPlanGroup',
                'destinationRateGroupId' => 'destinationRateGroup',
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
