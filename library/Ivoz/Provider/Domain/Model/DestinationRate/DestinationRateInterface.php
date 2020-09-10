<?php

namespace Ivoz\Provider\Domain\Model\DestinationRate;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
    public function setConnectFee($connectFee);

    /**
     * Ensure Valid connectFee format
     *
     * @inheritdoc
     */
    public function setCost($cost);

    /**
     * Ensure Group Interval Start has seconds suffix
     *
     * @inheritdoc
     */
    public function setGroupIntervalStart($groupIntervalStart);

    /**
     * Ensure Rating Increment has seconds suffix
     *
     * @inheritdoc
     */
    public function setRateIncrement($rateIncrement);

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
     * Get tpRate
     *
     * @return \Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface | null
     */
    public function getTpRate();

    /**
     * Get tpDestinationRate
     *
     * @return \Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface | null
     */
    public function getTpDestinationRate();

    /**
     * Set destinationRateGroup
     *
     * @param \Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface $destinationRateGroup
     *
     * @return static
     */
    public function setDestinationRateGroup(\Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface $destinationRateGroup);

    /**
     * Get destinationRateGroup
     *
     * @return \Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface
     */
    public function getDestinationRateGroup();

    /**
     * Set destination
     *
     * @param \Ivoz\Provider\Domain\Model\Destination\DestinationInterface $destination
     *
     * @return static
     */
    public function setDestination(\Ivoz\Provider\Domain\Model\Destination\DestinationInterface $destination);

    /**
     * Get destination
     *
     * @return \Ivoz\Provider\Domain\Model\Destination\DestinationInterface
     */
    public function getDestination();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
