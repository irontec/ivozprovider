<?php

namespace Ivoz\Cgr\Domain\Model\TpRate;

use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRate;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* TpRateInterface
*/
interface TpRateInterface extends LoggableEntityInterface
{

    public function getChangeSet();

    /**
     * Validate RateIncrement has valid unit
     *
     * @param string $rateIncrement
     * @return $this|TpRateAbstract|TpRateInterface
     */
    public function setRateIncrement(string $rateIncrement): TpRateInterface;

    /**
     * Validate GroupIntervalStart has valid unit
     *
     * @param string $groupIntervalStart
     * @return $this|TpRateAbstract|TpRateInterface
     */
    public function setGroupIntervalStart(string $groupIntervalStart): TpRateInterface;

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
     * Get connectFee
     *
     * @return float
     */
    public function getConnectFee(): float;

    /**
     * Get rateCost
     *
     * @return float
     */
    public function getRateCost(): float;

    /**
     * Get rateUnit
     *
     * @return string
     */
    public function getRateUnit(): string;

    /**
     * Get rateIncrement
     *
     * @return string
     */
    public function getRateIncrement(): string;

    /**
     * Get groupIntervalStart
     *
     * @return string
     */
    public function getGroupIntervalStart(): string;

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
    public function setDestinationRate(DestinationRate $destinationRate): TpRateInterface;

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
