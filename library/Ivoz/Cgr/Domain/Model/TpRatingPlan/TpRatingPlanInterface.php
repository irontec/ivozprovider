<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingPlan;

use Ivoz\Core\Domain\Model\EntityInterface;

interface TpRatingPlanInterface extends EntityInterface
{
    /**
     * @deprecated
     * Set tpid
     *
     * @param string $tpid
     *
     * @return self
     */
    public function setTpid($tpid);

    /**
     * Get tpid
     *
     * @return string
     */
    public function getTpid();

    /**
     * @deprecated
     * Set tag
     *
     * @param string $tag
     *
     * @return self
     */
    public function setTag($tag = null);

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag();

    /**
     * @deprecated
     * Set destratesTag
     *
     * @param string $destratesTag
     *
     * @return self
     */
    public function setDestratesTag($destratesTag = null);

    /**
     * Get destratesTag
     *
     * @return string
     */
    public function getDestratesTag();

    /**
     * @deprecated
     * Set timingTag
     *
     * @param string $timingTag
     *
     * @return self
     */
    public function setTimingTag($timingTag);

    /**
     * Get timingTag
     *
     * @return string
     */
    public function getTimingTag();

    /**
     * @deprecated
     * Set weight
     *
     * @param string $weight
     *
     * @return self
     */
    public function setWeight($weight);

    /**
     * Get weight
     *
     * @return string
     */
    public function getWeight();

    /**
     * @deprecated
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt($createdAt);

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
