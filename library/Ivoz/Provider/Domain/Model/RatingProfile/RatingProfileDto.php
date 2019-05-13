<?php

namespace Ivoz\Provider\Domain\Model\RatingProfile;

class RatingProfileDto extends RatingProfileDtoAbstract
{
    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '', string $rol = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'activationTime' => 'activationTime',
                'id' => 'id',
                'companyId' => 'company',
                'carrierId' => 'carrier',
                'ratingPlanGroupId' => 'ratingPlanGroup',
                'routingTagId' => 'routingTag'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
