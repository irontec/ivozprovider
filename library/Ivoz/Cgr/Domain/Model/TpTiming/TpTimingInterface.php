<?php

namespace Ivoz\Cgr\Domain\Model\TpTiming;

use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlan;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
* TpTimingInterface
*/
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
    public function getTag(): ?string;

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
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface;

    /**
     * Set ratingPlan
     *
     * @param RatingPlan
     *
     * @return static
     */
    public function setRatingPlan(RatingPlan $ratingPlan): TpTimingInterface;

    /**
     * Get ratingPlan
     *
     * @return RatingPlan
     */
    public function getRatingPlan(): RatingPlan;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
