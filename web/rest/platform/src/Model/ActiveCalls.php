<?php

namespace Model;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

/**
 * @codeCoverageIgnore
 */
class ActiveCalls
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

    /**
     * @return int
     */
    public function getInbound(): int
    {
        return $this->inbound;
    }

    /**
     * @param int $inbound
     */
    public function setInbound(int $inbound)
    {
        $this->inbound = $inbound;
    }

    /**
     * @return int
     */
    public function getOutbound(): int
    {
        return $this->outbound;
    }

    /**
     * @param int $outbound
     */
    public function setOutbound(int $outbound)
    {
        $this->outbound = $outbound;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total
     * @return ActiveCalls
     */
    public function setTotal(int $total): ActiveCalls
    {
        $this->total = $total;
        return $this;
    }
}
