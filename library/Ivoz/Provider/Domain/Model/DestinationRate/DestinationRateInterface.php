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
    public function getCost();

    /**
     * Get connectFee
     *
     * @return float
     */
    public function getConnectFee();

    /**
     * Get rateIncrement
     *
     * @return string
     */
    public function getRateIncrement();

    /**
     * Get groupIntervalStart
     *
     * @return string
     */
    public function getGroupIntervalStart();

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

    /**
     * Set tpDestinationRate
     *
     * @param \Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface $tpDestinationRate
     *
     * @return self
     */
    public function setTpDestinationRate(\Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface $tpDestinationRate = null);

    /**
     * Get tpDestinationRate
     *
     * @return \Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface
     */
    public function getTpDestinationRate();

    /**
     * Set destinationRateGroup
     *
     * @param \Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface $destinationRateGroup
     *
     * @return self
     */
    public function setDestinationRateGroup(\Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface $destinationRateGroup = null);

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
     * @return self
     */
    public function setDestination(\Ivoz\Provider\Domain\Model\Destination\DestinationInterface $destination = null);

    /**
     * Get destination
     *
     * @return \Ivoz\Provider\Domain\Model\Destination\DestinationInterface
     */
    public function getDestination();
}
