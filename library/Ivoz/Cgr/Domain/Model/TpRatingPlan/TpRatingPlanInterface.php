<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingPlan;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface TpRatingPlanInterface extends LoggableEntityInterface
{
    public function getChangeSet();

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
     * Get destratesTag
     *
     * @return string | null
     */
    public function getDestratesTag();

    /**
     * Get timingTag
     *
     * @return string
     */
    public function getTimingTag();

    /**
     * Get weight
     *
     * @return float
     */
    public function getWeight();

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
     * @return static
     */
    public function setRatingPlan(\Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan);

    /**
     * Get ratingPlan
     *
     * @return \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface
     */
    public function getRatingPlan();
}
