<?php

namespace Ivoz\Provider\Domain\Model\RatingPlan;

class RatingPlanDto extends RatingPlanDtoAbstract
{
    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
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


    public function setTimeIn(\DateTimeInterface|string|null $timeIn): static
    {
        if (is_null($timeIn)) {
            $timeIn = new \DateTime('00:00:00');
        }

        return parent::setTimeIn($timeIn);
    }

    public function setTimingType(?string $timingType = null): static
    {
        if ($timingType == RatingPlanInterface::TIMINGTYPE_ALWAYS) {
            $this->setTimeIn(
                new \DateTime('00:00:00')
            );
        }

        return parent::setTimingType($timingType);
    }
}
