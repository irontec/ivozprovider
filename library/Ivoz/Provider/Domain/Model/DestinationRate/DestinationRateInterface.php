<?php

namespace Ivoz\Provider\Domain\Model\DestinationRate;

use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface;
use Ivoz\Provider\Domain\Model\Destination\DestinationInterface;
use Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface;
use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* DestinationRateInterface
*/
interface DestinationRateInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @return string
     */
    public function getCgrTag();

    /**
     * @return string
     */
    public function getCgrRatesTag();

    /**
     * @return string
     */
    public function getCgrDestinationsTag();

    /**
     * Ensure Valid connectFee format
     *
     * @inheritdoc
     */
    public function setConnectFee(float $connectFee): DestinationRateInterface;

    /**
     * Ensure Valid connectFee format
     *
     * @inheritdoc
     */
    public function setCost(float $cost): DestinationRateInterface;

    /**
     * Ensure Group Interval Start has seconds suffix
     *
     * @inheritdoc
     */
    public function setGroupIntervalStart(string $groupIntervalStart): DestinationRateInterface;

    /**
     * Ensure Rating Increment has seconds suffix
     *
     * @inheritdoc
     */
    public function setRateIncrement(string $rateIncrement): DestinationRateInterface;

    /**
     * Get cost
     *
     * @return float
     */
    public function getCost(): float;

    /**
     * Get connectFee
     *
     * @return float
     */
    public function getConnectFee(): float;

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
     * Set destinationRateGroup
     *
     * @param DestinationRateGroupInterface
     *
     * @return static
     */
    public function setDestinationRateGroup(DestinationRateGroupInterface $destinationRateGroup): DestinationRateInterface;

    /**
     * Get destinationRateGroup
     *
     * @return DestinationRateGroupInterface
     */
    public function getDestinationRateGroup(): DestinationRateGroupInterface;

    /**
     * Set destination
     *
     * @param DestinationInterface
     *
     * @return static
     */
    public function setDestination(DestinationInterface $destination): DestinationRateInterface;

    /**
     * Get destination
     *
     * @return DestinationInterface
     */
    public function getDestination(): DestinationInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * @var TpRateInterface
     * mappedBy destinationRate
     */
    public function setTpRate(TpRateInterface $tpRate): DestinationRateInterface;

    /**
     * Get tpRate
     * @return TpRateInterface
     */
    public function getTpRate(): ?TpRateInterface;

    /**
     * @var TpDestinationRateInterface
     * mappedBy destinationRate
     */
    public function setTpDestinationRate(TpDestinationRateInterface $tpDestinationRate): DestinationRateInterface;

    /**
     * Get tpDestinationRate
     * @return TpDestinationRateInterface
     */
    public function getTpDestinationRate(): ?TpDestinationRateInterface;

}
