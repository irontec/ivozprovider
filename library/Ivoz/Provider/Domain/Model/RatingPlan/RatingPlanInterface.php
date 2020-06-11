<?php

namespace Ivoz\Provider\Domain\Model\RatingPlan;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
    public function getTimingType();

    /**
     * Get timeIn
     *
     * @return \DateTime
     */
    public function getTimeIn(): \DateTime;

    /**
     * Get monday
     *
     * @return boolean | null
     */
    public function getMonday();

    /**
     * Get tuesday
     *
     * @return boolean | null
     */
    public function getTuesday();

    /**
     * Get wednesday
     *
     * @return boolean | null
     */
    public function getWednesday();

    /**
     * Get thursday
     *
     * @return boolean | null
     */
    public function getThursday();

    /**
     * Get friday
     *
     * @return boolean | null
     */
    public function getFriday();

    /**
     * Get saturday
     *
     * @return boolean | null
     */
    public function getSaturday();

    /**
     * Get sunday
     *
     * @return boolean | null
     */
    public function getSunday();

    /**
     * Set ratingPlanGroup
     *
     * @param \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface $ratingPlanGroup
     *
     * @return static
     */
    public function setRatingPlanGroup(\Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface $ratingPlanGroup);

    /**
     * Get ratingPlanGroup
     *
     * @return \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface
     */
    public function getRatingPlanGroup();

    /**
     * Get destinationRateGroup
     *
     * @return \Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface
     */
    public function getDestinationRateGroup();

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Set tpTiming
     *
     * @param \Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface $tpTiming
     *
     * @return static
     */
    public function setTpTiming(\Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface $tpTiming = null);

    /**
     * Get tpTiming
     *
     * @return \Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface | null
     */
    public function getTpTiming();

    /**
     * Set tpRatingPlan
     *
     * @param \Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface $tpRatingPlan
     *
     * @return static
     */
    public function setTpRatingPlan(\Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface $tpRatingPlan = null);

    /**
     * Get tpRatingPlan
     *
     * @return \Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface | null
     */
    public function getTpRatingPlan();
}
