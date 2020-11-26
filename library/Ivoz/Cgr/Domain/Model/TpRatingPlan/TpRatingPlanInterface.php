<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingPlan;

use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlan;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* TpRatingPlanInterface
*/
interface TpRatingPlanInterface extends LoggableEntityInterface
{

    public function getChangeSet();

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
     * Get destratesTag
     *
     * @return string | null
     */
    public function getDestratesTag(): ?string;

    /**
     * Get timingTag
     *
     * @return string
     */
    public function getTimingTag(): string;

    /**
     * Get weight
     *
     * @return float
     */
    public function getWeight(): float;

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
    public function setRatingPlan(RatingPlan $ratingPlan): TpRatingPlanInterface;

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
