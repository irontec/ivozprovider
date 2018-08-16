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
     * @param \Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface $destinationRate
     *
     * @return self
     */
    public function setDestinationRate(\Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface $destinationRate);

    /**
     * Get destinationRate
     *
     * @return \Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface
     */
    public function getDestinationRate();

}

