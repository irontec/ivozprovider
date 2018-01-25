<?php

namespace Model;

/**
 * Class CallStats
 * @package Model
 * @codeCoverageIgnore
 */
class CallStats
{
    /**
     * @var integer
     */
    protected $totalCalls;

    /**
     * @var integer
     */
    protected $totalDetours;

    public function __construct($totalCalls, $totalDetours)
    {
        $this->setTotalCalls($totalCalls);
        $this->setTotalDetours($totalDetours);
    }

    /**
     * @return int
     */
    public function getTotalCalls(): int
    {
        return $this->totalCalls;
    }

    /**
     * @param int $totalCalls
     * @return CallStats
     */
    public function setTotalCalls(int $totalCalls): CallStats
    {
        $this->totalCalls = $totalCalls;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalDetours(): int
    {
        return $this->totalDetours;
    }

    /**
     * @param int $totalDetours
     * @return CallStats
     */
    public function setTotalDetours(int $totalDetours): CallStats
    {
        $this->totalDetours = $totalDetours;
        return $this;
    }
}