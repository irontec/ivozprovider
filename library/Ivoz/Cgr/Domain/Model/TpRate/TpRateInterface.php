<?php

namespace Ivoz\Cgr\Domain\Model\TpRate;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface TpRateInterface extends LoggableEntityInterface
{
    public function getChangeSet();

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
