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
    public function getTpid(): string;

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
    public function getYears(): string;

    /**
     * Get months
     *
     * @return string
     */
    public function getMonths(): string;

    /**
     * Get monthDays
     *
     * @return string
     */
    public function getMonthDays(): string;

    /**
     * Get weekDays
     *
     * @return string
     */
    public function getWeekDays(): string;

    /**
     * Get time
     *
     * @return string
     */
    public function getTime(): string;

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime;

    /**
     * Set ratingPlan
     *
     * @param \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan
     *
     * @return static
     */
    public function setRatingPlan(\Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan);

    /**
     * Get ratingPlan
     *
     * @return \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface
     */
    public function getRatingPlan();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
