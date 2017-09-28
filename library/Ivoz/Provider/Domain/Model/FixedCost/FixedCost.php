<?php

namespace Ivoz\Provider\Domain\Model\FixedCost;

/**
 * FixedCost
 */
class FixedCost extends FixedCostAbstract implements FixedCostInterface
{
    use FixedCostTrait;
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

