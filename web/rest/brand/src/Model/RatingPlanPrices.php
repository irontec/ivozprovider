<?php

namespace Model;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

/**
 * Class RatingPlanPrices
 * @package Model
 * @codeCoverageIgnore
 */
class RatingPlanPrices
{
    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $ratingPlan;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $name;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $prefix;

    /**
     * @var float
     * @AttributeDefinition(type="float")
     */
    protected $connectFee;

    /**
     * @var float
     * @AttributeDefinition(type="float")
     */
    protected $cost;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $rateIncrement;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $groupIntervalStart;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $timeIn;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $days;

    public function __construct()
    {
    }

    public static function fromArray(array $data)
    {
        $instance = new self();
        $instance
            ->setRatingPlan($data['ratingPlan'])
            ->setName($data['name'])
            ->setPrefix($data['prefix'])
            ->setConnectFee($data['connectFee'])
            ->setCost($data['cost'])
            ->setRateIncrement($data['rateIncrement'])
            ->setGroupIntervalStart($data['groupIntervalStart'])
            ->setTimeIn($data['timeIn'])
            ->setDays($data['days']);

        return $instance;
    }

    /**
     * @return string
     */
    public function getRatingPlan(): string
    {
        return $this->ratingPlan;
    }

    /**
     * @param string $ratingPlan
     * @return static
     */
    public function setRatingPlan(string $ratingPlan): self
    {
        $this->ratingPlan = $ratingPlan;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return static
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     * @return static
     */
    public function setPrefix(string $prefix): self
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * @return float
     */
    public function getConnectFee(): float
    {
        return $this->connectFee;
    }

    /**
     * @param float $connectFee
     * @return static
     */
    public function setConnectFee(float $connectFee): self
    {
        $this->connectFee = $connectFee;
        return $this;
    }

    /**
     * @return float
     */
    public function getCost(): float
    {
        return $this->cost;
    }

    /**
     * @param float $cost
     * @return static
     */
    public function setCost(float $cost): self
    {
        $this->cost = $cost;
        return $this;
    }

    /**
     * @return string
     */
    public function getRateIncrement(): string
    {
        return $this->rateIncrement;
    }

    /**
     * @param string $rateIncrement
     * @return static
     */
    public function setRateIncrement(string $rateIncrement): self
    {
        $this->rateIncrement = $rateIncrement;
        return $this;
    }

    /**
     * @return string
     */
    public function getGroupIntervalStart(): string
    {
        return $this->groupIntervalStart;
    }

    /**
     * @param string $groupIntervalStart
     * @return static
     */
    public function setGroupIntervalStart(string $groupIntervalStart): self
    {
        $this->groupIntervalStart = $groupIntervalStart;
        return $this;
    }

    /**
     * @return string
     */
    public function getTimeIn(): string
    {
        return $this->timeIn;
    }

    /**
     * @param string $timeIn
     * @return static
     */
    public function setTimeIn(string $timeIn): self
    {
        $this->timeIn = $timeIn;
        return $this;
    }

    /**
     * @return string
     */
    public function getDays(): string
    {
        return $this->days;
    }

    /**
     * @param string $days
     * @return static
     */
    public function setDays(string $days): self
    {
        $this->days = $days;
        return $this;
    }
}
