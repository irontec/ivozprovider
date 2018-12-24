<?php

namespace Ivoz\Cgr\Domain\Model\TpTiming;

use Ivoz\Core\Domain\Model\EntityInterface;

interface TpTimingInterface extends EntityInterface
{
    /**
     * Get tpid
     *
     * @return string
     */
    public function getTpid();

    /**
     * Get tag
     *
     * @return string | null
     */
    public function getTag();

    /**
     * Get years
     *
     * @return string
     */
    public function getYears();

    /**
     * Get months
     *
     * @return string
     */
    public function getMonths();

    /**
     * Get monthDays
     *
     * @return string
     */
    public function getMonthDays();

    /**
     * Get weekDays
     *
     * @return string
     */
    public function getWeekDays();

    /**
     * Get time
     *
     * @return string
     */
    public function getTime();

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Set ratingPlan
     *
     * @param \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan
     *
     * @return self
     */
    public function setRatingPlan(\Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan);

    /**
     * Get ratingPlan
     *
     * @return \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface
     */
    public function getRatingPlan();
}
