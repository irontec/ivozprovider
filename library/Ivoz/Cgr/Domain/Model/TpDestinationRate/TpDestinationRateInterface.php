<?php

namespace Ivoz\Cgr\Domain\Model\TpDestinationRate;

use Ivoz\Core\Domain\Model\EntityInterface;

interface TpDestinationRateInterface extends EntityInterface
{
    /**
     * Validate RateIncrement has valid unit
     *
     * @param string $rateIncrement
     * @return $this|TpRateAbstract|TpRateInterface
     */
    public function setRateIncrement($rateIncrement);

    /**
     * Validate GroupIntervalStart has valid unit
     *
     * @param string $groupIntervalStart
     * @return $this|TpRateAbstract|TpRateInterface
     */
    public function setGroupIntervalStart($groupIntervalStart);

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
     * Set destinationsTag
     *
     * @param string $destinationsTag
     *
     * @return self
     */
    public function setDestinationsTag($destinationsTag = null);

    /**
     * Get destinationsTag
     *
     * @return string
     */
    public function getDestinationsTag();

    /**
     * Set ratesTag
     *
     * @param string $ratesTag
     *
     * @return self
     */
    public function setRatesTag($ratesTag = null);

    /**
     * Get ratesTag
     *
     * @return string
     */
    public function getRatesTag();

    /**
     * Set roundingMethod
     *
     * @param string $roundingMethod
     *
     * @return self
     */
    public function setRoundingMethod($roundingMethod);

    /**
     * Get roundingMethod
     *
     * @return string
     */
    public function getRoundingMethod();

    /**
     * Set roundingDecimals
     *
     * @param integer $roundingDecimals
     *
     * @return self
     */
    public function setRoundingDecimals($roundingDecimals);

    /**
     * Get roundingDecimals
     *
     * @return integer
     */
    public function getRoundingDecimals();

    /**
     * Set maxCost
     *
     * @param string $maxCost
     *
     * @return self
     */
    public function setMaxCost($maxCost);

    /**
     * Get maxCost
     *
     * @return string
     */
    public function getMaxCost();

    /**
     * Set maxCostStrategy
     *
     * @param string $maxCostStrategy
     *
     * @return self
     */
    public function setMaxCostStrategy($maxCostStrategy);

    /**
     * Get maxCostStrategy
     *
     * @return string
     */
    public function getMaxCostStrategy();

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
     * Set destinationRate
     *
     * @param \Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateInterface $destinationRate
     *
     * @return self
     */
    public function setDestinationRate(\Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateInterface $destinationRate = null);

    /**
     * Get destinationRate
     *
     * @return \Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateInterface
     */
    public function getDestinationRate();

    /**
     * Set destination
     *
     * @param \Ivoz\Cgr\Domain\Model\TpDestinationRate\Destination $destination
     *
     * @return self
     */
    public function setDestination(\Ivoz\Cgr\Domain\Model\TpDestinationRate\Destination $destination);

    /**
     * Get destination
     *
     * @return \Ivoz\Cgr\Domain\Model\TpDestinationRate\Destination
     */
    public function getDestination();

    /**
     * Set rate
     *
     * @param \Ivoz\Cgr\Domain\Model\TpDestinationRate\Rate $rate
     *
     * @return self
     */
    public function setRate(\Ivoz\Cgr\Domain\Model\TpDestinationRate\Rate $rate);

    /**
     * Get rate
     *
     * @return \Ivoz\Cgr\Domain\Model\TpDestinationRate\Rate
     */
    public function getRate();

    /**
     * Set tpDestination
     *
     * @param \Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface $tpDestination
     *
     * @return self
     */
    public function setTpDestination(\Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface $tpDestination = null);

    /**
     * Get tpDestination
     *
     * @return \Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface
     */
    public function getTpDestination();

    /**
     * Set tpRate
     *
     * @param \Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface $tpRate
     *
     * @return self
     */
    public function setTpRate(\Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface $tpRate = null);

    /**
     * Get tpRate
     *
     * @return \Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface
     */
    public function getTpRate();

}

