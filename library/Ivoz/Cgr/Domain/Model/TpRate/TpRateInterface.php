<?php

namespace Ivoz\Cgr\Domain\Model\TpRate;

use Ivoz\Core\Domain\Model\EntityInterface;

interface TpRateInterface extends EntityInterface
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
     * Set connectFee
     *
     * @param string $connectFee
     *
     * @return self
     */
    public function setConnectFee($connectFee);

    /**
     * Get connectFee
     *
     * @return string
     */
    public function getConnectFee();

    /**
     * @deprecated
     * Set rateCost
     *
     * @param string $rateCost
     *
     * @return self
     */
    public function setRateCost($rateCost);

    /**
     * Get rateCost
     *
     * @return string
     */
    public function getRateCost();

    /**
     * @deprecated
     * Set rateUnit
     *
     * @param string $rateUnit
     *
     * @return self
     */
    public function setRateUnit($rateUnit);

    /**
     * Get rateUnit
     *
     * @return string
     */
    public function getRateUnit();

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
     * @deprecated
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

