<?php

namespace Ivoz\Cgr\Domain\Model\TpDestinationRate;

use Ivoz\Core\Domain\Model\EntityInterface;

interface TpDestinationRateInterface extends EntityInterface
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
    public function setDestinationRate(\Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateInterface $destinationRate);

    /**
     * Get destinationRate
     *
     * @return \Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateInterface
     */
    public function getDestinationRate();

    /**
     * Set destination
     *
     * @param \Ivoz\Cgr\Domain\Model\Destination\DestinationInterface $destination
     *
     * @return self
     */
    public function setDestination(\Ivoz\Cgr\Domain\Model\Destination\DestinationInterface $destination);

    /**
     * Get destination
     *
     * @return \Ivoz\Cgr\Domain\Model\Destination\DestinationInterface
     */
    public function getDestination();

    /**
     * Set rate
     *
     * @param \Ivoz\Cgr\Domain\Model\Rate\RateInterface $rate
     *
     * @return self
     */
    public function setRate(\Ivoz\Cgr\Domain\Model\Rate\RateInterface $rate);

    /**
     * Get rate
     *
     * @return \Ivoz\Cgr\Domain\Model\Rate\RateInterface
     */
    public function getRate();

}

