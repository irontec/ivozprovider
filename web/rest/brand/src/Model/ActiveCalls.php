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
    protected $total;

    public function __construct($total)
    {
        $this->setTotal($total);
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
