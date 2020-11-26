<?php

namespace Ivoz\Cgr\Domain\Model\TpDestinationRate;

use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRate;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* TpDestinationRateInterface
*/
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
    public function getTag(): ?string;

    /**
     * Get destinationsTag
     *
     * @return string | null
     */
    public function getDestinationsTag(): ?string;

    /**
     * Get ratesTag
     *
     * @return string | null
     */
    public function getRatesTag(): ?string;

    /**
     * Get roundingMethod
     *
     * @return string
     */
    public function getRoundingMethod(): string;

    /**
     * Get roundingDecimals
     *
     * @return int
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
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface;

    /**
     * Set destinationRate
     *
     * @param DestinationRate
     *
     * @return static
     */
    public function setDestinationRate(DestinationRate $destinationRate): TpDestinationRateInterface;

    /**
     * Get destinationRate
     *
     * @return DestinationRate
     */
    public function getDestinationRate(): DestinationRate;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
