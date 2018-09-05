<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingPlan;

use Ivoz\Core\Domain\Model\EntityInterface;

interface TpRatingPlanInterface extends EntityInterface
{
    public function getWeekDays();

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
     * @deprecated
     * Set timingType
     *
     * @param string $timingType
     *
     * @return self
     */
    public function setTimingType($timingType = null);

    /**
     * Get timingType
     *
     * @return string
     */
    public function getTimingType();

    /**
     * @deprecated
     * Set timeIn
     *
     * @param \DateTime $timeIn
     *
     * @return self
     */
    public function setTimeIn($timeIn);

    /**
     * Get timeIn
     *
     * @return \DateTime
     */
    public function getTimeIn();

    /**
     * @deprecated
     * Set monday
     *
     * @param boolean $monday
     *
     * @return self
     */
    public function setMonday($monday = null);

    /**
     * Get monday
     *
     * @return boolean
     */
    public function getMonday();

    /**
     * @deprecated
     * Set tuesday
     *
     * @param boolean $tuesday
     *
     * @return self
     */
    public function setTuesday($tuesday = null);

    /**
     * Get tuesday
     *
     * @return boolean
     */
    public function getTuesday();

    /**
     * @deprecated
     * Set wednesday
     *
     * @param boolean $wednesday
     *
     * @return self
     */
    public function setWednesday($wednesday = null);

    /**
     * Get wednesday
     *
     * @return boolean
     */
    public function getWednesday();

    /**
     * @deprecated
     * Set thursday
     *
     * @param boolean $thursday
     *
     * @return self
     */
    public function setThursday($thursday = null);

    /**
     * Get thursday
     *
     * @return boolean
     */
    public function getThursday();

    /**
     * @deprecated
     * Set friday
     *
     * @param boolean $friday
     *
     * @return self
     */
    public function setFriday($friday = null);

    /**
     * Get friday
     *
     * @return boolean
     */
    public function getFriday();

    /**
     * @deprecated
     * Set saturday
     *
     * @param boolean $saturday
     *
     * @return self
     */
    public function setSaturday($saturday = null);

    /**
     * Get saturday
     *
     * @return boolean
     */
    public function getSaturday();

    /**
     * @deprecated
     * Set sunday
     *
     * @param boolean $sunday
     *
     * @return self
     */
    public function setSunday($sunday = null);

    /**
     * Get sunday
     *
     * @return boolean
     */
    public function getSunday();

    /**
     * Set timing
     *
     * @param \Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface $timing
     *
     * @return self
     */
    public function setTiming(\Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface $timing = null);

    /**
     * Get timing
     *
     * @return \Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface
     */
    public function getTiming();

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
}
