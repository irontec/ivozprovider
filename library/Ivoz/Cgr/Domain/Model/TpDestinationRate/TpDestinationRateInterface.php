<?php

namespace Ivoz\Cgr\Domain\Model\TpDestinationRate;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface TpDestinationRateInterface extends LoggableEntityInterface
{
    const ROUNDINGMETHOD_UP = '*up';
    const ROUNDINGMETHOD_UPMINCOST = '*upmincost';


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
    public function getTag();

    /**
     * Get destinationsTag
     *
     * @return string | null
     */
    public function getDestinationsTag();

    /**
     * Get ratesTag
     *
     * @return string | null
     */
    public function getRatesTag();

    /**
     * Get roundingMethod
     *
     * @return string
     */
    public function getRoundingMethod(): string;

    /**
     * Get roundingDecimals
     *
     * @return integer
     */
    public function getRoundingDecimals(): int;

    /**
     * Get maxCost
     *
     * @return float
     */
    public function getMaxCost(): float;

    /**
     * Get maxCostStrategy
     *
     * @return string
     */
    public function getMaxCostStrategy(): string;

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime;

    /**
     * Set destinationRate
     *
     * @param \Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface $destinationRate
     *
     * @return static
     */
    public function setDestinationRate(\Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface $destinationRate);

    /**
     * Get destinationRate
     *
     * @return \Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface
     */
    public function getDestinationRate();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
