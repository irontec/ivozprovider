<?php

namespace Ivoz\Provider\Domain\Model\RatingPlan;

use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface;
use Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* RatingPlanInterface
*/
interface RatingPlanInterface extends LoggableEntityInterface
{
    const TIMINGTYPE_ALWAYS = 'always';

    const TIMINGTYPE_CUSTOM = 'custom';

    public function getChangeSet();

    /**
     * Transform Weekdays booleans to a string for TpTimings
     *
     * @return string
     */
    public function getWeekDays();

    /**
     * CGRates tag for this Rating Plan
     *
     * @return string
     */
    public function getCgrTag();

    /**
     * CGrates tag for Timing associated to this Rating Plan
     *
     * @return string
     */
    public function getCgrTimingTag();

    /**
     * Get weight
     *
     * @return float
     */
    public function getWeight(): float;

    /**
     * Get timingType
     *
     * @return string | null
     */
    public function getTimingType(): ?string;

    /**
     * Get timeIn
     *
     * @return \DateTimeInterface
     */
    public function getTimeIn(): \DateTimeInterface;

    /**
     * Get monday
     *
     * @return bool | null
     */
    public function getMonday(): ?bool;

    /**
     * Get tuesday
     *
     * @return bool | null
     */
    public function getTuesday(): ?bool;

    /**
     * Get wednesday
     *
     * @return bool | null
     */
    public function getWednesday(): ?bool;

    /**
     * Get thursday
     *
     * @return bool | null
     */
    public function getThursday(): ?bool;

    /**
     * Get friday
     *
     * @return bool | null
     */
    public function getFriday(): ?bool;

    /**
     * Get saturday
     *
     * @return bool | null
     */
    public function getSaturday(): ?bool;

    /**
     * Get sunday
     *
     * @return bool | null
     */
    public function getSunday(): ?bool;

    /**
     * Set ratingPlanGroup
     *
     * @param RatingPlanGroupInterface
     *
     * @return static
     */
    public function setRatingPlanGroup(RatingPlanGroupInterface $ratingPlanGroup): RatingPlanInterface;

    /**
     * Get ratingPlanGroup
     *
     * @return RatingPlanGroupInterface
     */
    public function getRatingPlanGroup(): RatingPlanGroupInterface;

    /**
     * Get destinationRateGroup
     *
     * @return DestinationRateGroupInterface
     */
    public function getDestinationRateGroup(): DestinationRateGroupInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * @var TpTimingInterface
     * mappedBy ratingPlan
     */
    public function setTpTiming(TpTimingInterface $tpTiming): RatingPlanInterface;

    /**
     * Get tpTiming
     * @return TpTimingInterface
     */
    public function getTpTiming(): ?TpTimingInterface;

    /**
     * @var TpRatingPlanInterface
     * mappedBy ratingPlan
     */
    public function setTpRatingPlan(TpRatingPlanInterface $tpRatingPlan): RatingPlanInterface;

    /**
     * Get tpRatingPlan
     * @return TpRatingPlanInterface
     */
    public function getTpRatingPlan(): ?TpRatingPlanInterface;

}
