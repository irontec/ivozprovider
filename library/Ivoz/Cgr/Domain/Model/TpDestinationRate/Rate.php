<?php

namespace Ivoz\Cgr\Domain\Model\TpDestinationRate;

use Assert\Assertion;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * Rate
 * @codeCoverageIgnore
 */
class Rate
{
    /**
     * column: rate
     * @var string
     */
    protected $cost;

    /**
     * column: connect_fee
     * @var string
     */
    protected $connectFee;

    /**
     * column: rate_increment
     * @var string
     */
    protected $rateIncrement;

    /**
     * column: group_interval_start
     * @var string
     */
    protected $groupIntervalStart = '0s';


    /**
     * Constructor
     */
    public function __construct(
        $cost,
        $connectFee,
        $rateIncrement,
        $groupIntervalStart
    ) {
        $this->setCost($cost);
        $this->setConnectFee($connectFee);
        $this->setRateIncrement($rateIncrement);
        $this->setGroupIntervalStart($groupIntervalStart);
    }

    // @codeCoverageIgnoreStart

    /**
     * Set cost
     *
     * @param string $cost
     *
     * @return self
     */
    protected function setCost($cost)
    {
        Assertion::notNull($cost, 'cost value "%s" is null, but non null value was expected.');
        Assertion::numeric($cost);

        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return string
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set connectFee
     *
     * @param string $connectFee
     *
     * @return self
     */
    protected function setConnectFee($connectFee)
    {
        Assertion::notNull($connectFee, 'connectFee value "%s" is null, but non null value was expected.');
        Assertion::numeric($connectFee);

        $this->connectFee = $connectFee;

        return $this;
    }

    /**
     * Get connectFee
     *
     * @return string
     */
    public function getConnectFee()
    {
        return $this->connectFee;
    }

    /**
     * Set rateIncrement
     *
     * @param string $rateIncrement
     *
     * @return self
     */
    protected function setRateIncrement($rateIncrement)
    {
        Assertion::notNull($rateIncrement, 'rateIncrement value "%s" is null, but non null value was expected.');
        Assertion::maxLength($rateIncrement, 16, 'rateIncrement value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->rateIncrement = $rateIncrement;

        return $this;
    }

    /**
     * Get rateIncrement
     *
     * @return string
     */
    public function getRateIncrement()
    {
        return $this->rateIncrement;
    }

    /**
     * Set groupIntervalStart
     *
     * @param string $groupIntervalStart
     *
     * @return self
     */
    protected function setGroupIntervalStart($groupIntervalStart)
    {
        Assertion::notNull($groupIntervalStart, 'groupIntervalStart value "%s" is null, but non null value was expected.');
        Assertion::maxLength($groupIntervalStart, 16, 'groupIntervalStart value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->groupIntervalStart = $groupIntervalStart;

        return $this;
    }

    /**
     * Get groupIntervalStart
     *
     * @return string
     */
    public function getGroupIntervalStart()
    {
        return $this->groupIntervalStart;
    }



    // @codeCoverageIgnoreEnd
}

