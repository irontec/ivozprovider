<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingPlan;

use Ivoz\Core\Domain\Model\EntityInterface;

interface TpRatingPlanInterface extends EntityInterface
{
    public function __toString();

    /**
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
     * Set timingTag
     *
     * @param string $timingTag
     *
     * @return self
     */
    public function setTimingTag($timingTag = null);

    /**
     * Get timingTag
     *
     * @return string
     */
    public function getTimingTag();

    /**
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
     * Set timing
     *
     * @param \Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface $timing
     *
     * @return self
     */
    public function setTiming(\Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface $timing);

    /**
     * Get timing
     *
     * @return \Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface
     */
    public function getTiming();

    /**
     * Set ratingPlan
     *
     * @param \Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan
     *
     * @return self
     */
    public function setRatingPlan(\Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan);

    /**
     * Get ratingPlan
     *
     * @return \Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlanInterface
     */
    public function getRatingPlan();

    /**
     * Set destinationRate
     *
     * @param \Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateInterface $destinationRate
     *
     * @return self
     */
    public function setDestinationRate(\Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateInterface $destinationRate);

    /**
     * Get destinationRate
     *
     * @return \Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateInterface
     */
    public function getDestinationRate();

}

