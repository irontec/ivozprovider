<?php

namespace Ivoz\Provider\Domain\Model\RatingPlan;

use Ivoz\Core\Domain\Model\EntityInterface;

interface RatingPlanInterface extends EntityInterface
{
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
     * @return string
     */
    public function getWeight();

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
    public function getTimeIn();

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
     * @return self
     */
    public function setRatingPlanGroup(\Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface $ratingPlanGroup = null);

    /**
     * Get ratingPlanGroup
     *
     * @return \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface
     */
    public function getRatingPlanGroup();

    /**
     * Set destinationRateGroup
     *
     * @param \Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface $destinationRateGroup
     *
     * @return self
     */
    public function setDestinationRateGroup(\Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface $destinationRateGroup);

    /**
     * Get destinationRateGroup
     *
     * @return \Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface
     */
    public function getDestinationRateGroup();

    /**
     * Set tpTiming
     *
     * @param \Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface $tpTiming
     *
     * @return self
     */
    public function setTpTiming(\Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface $tpTiming = null);

    /**
     * Get tpTiming
     *
     * @return \Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface
     */
    public function getTpTiming();

    /**
     * Set tpRatingPlan
     *
     * @param \Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface $tpRatingPlan
     *
     * @return self
     */
    public function setTpRatingPlan(\Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface $tpRatingPlan = null);

    /**
     * Get tpRatingPlan
     *
     * @return \Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface
     */
    public function getTpRatingPlan();
}
