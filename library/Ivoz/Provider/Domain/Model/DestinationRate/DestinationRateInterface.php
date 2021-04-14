<?php

namespace Ivoz\Provider\Domain\Model\DestinationRate;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface;
use Ivoz\Provider\Domain\Model\Destination\DestinationInterface;
use Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface;
use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface;

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
    public function setConnectFee(float $connectFee): static;

    /**
     * Ensure Valid connectFee format
     *
     * @inheritdoc
     */
    public function setCost(float $cost): static;

    /**
     * Ensure Group Interval Start has seconds suffix
     *
     * @inheritdoc
     */
    public function setGroupIntervalStart(string $groupIntervalStart): static;

    /**
     * Ensure Rating Increment has seconds suffix
     *
     * @inheritdoc
     */
    public function setRateIncrement(string $rateIncrement): static;

    public function getCost(): float;

    public function getConnectFee(): float;

    public function getRateIncrement(): string;

    public function getGroupIntervalStart(): string;

    public function setDestinationRateGroup(DestinationRateGroupInterface $destinationRateGroup): static;

    public function getDestinationRateGroup(): DestinationRateGroupInterface;

    public function setDestination(DestinationInterface $destination): static;

    public function getDestination(): DestinationInterface;

    public function isInitialized(): bool;

    public function setTpRate(TpRateInterface $tpRate): static;

    public function getTpRate(): ?TpRateInterface;

    public function setTpDestinationRate(TpDestinationRateInterface $tpDestinationRate): static;

    public function getTpDestinationRate(): ?TpDestinationRateInterface;
}
