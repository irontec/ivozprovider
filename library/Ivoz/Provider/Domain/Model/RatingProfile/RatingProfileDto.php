<?php

namespace Ivoz\Provider\Domain\Model\RatingProfile;

class RatingProfileDto extends RatingProfileDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '')
    {
        $response = parent::getPropertyMap(...func_get_args());
        if (array_key_exists('tpRatingProfileId', $response)) {
            unset($response['tpRatingProfileId']);
        }

        return $response;
    }
}
