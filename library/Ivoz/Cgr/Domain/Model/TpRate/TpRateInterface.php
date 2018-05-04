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
     * Set tpDestinationRate
     *
     * @param \Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface $tpDestinationRate
     *
     * @return self
     */
    public function setTpDestinationRate(\Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface $tpDestinationRate);

    /**
     * Get tpDestinationRate
     *
     * @return \Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface
     */
    public function getTpDestinationRate();

}

