<?php

namespace Model;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

/**
 * @codeCoverageIgnore
 */
class LastMonthCalls
{
    /**
     * @var integer
     * @AttributeDefinition(type="int")
     */
    protected $inbound;

    /**
     * @var integer
     * @AttributeDefinition(type="int")
     */
    protected $outbound;

    /**
     * @var integer
     * @AttributeDefinition(type="int")
     */
    protected $total;

    public function __construct(
        int $inbound,
        int $outbound
    ) {
        $this->setInbound($inbound);
        $this->setOutbound($outbound);
        $this->setTotal(
            $inbound + $outbound
        );
    }

    public function getInbound(): int
    {
        return $this->inbound;
    }

    public function setInbound(int $inbound): void
    {
        $this->inbound = $inbound;
    }

    public function getOutbound(): int
    {
        return $this->outbound;
    }

    public function setOutbound(int $outbound): void
    {
        $this->outbound = $outbound;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @return LastMonthCalls
     */
    public function setTotal(int $total): LastMonthCalls
    {
        $this->total = $total;
        return $this;
    }
}
