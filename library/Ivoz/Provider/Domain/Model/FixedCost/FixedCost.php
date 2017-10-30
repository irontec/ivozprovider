<?php

namespace Ivoz\Provider\Domain\Model\FixedCost;

/**
 * FixedCost
 */
class FixedCost extends FixedCostAbstract implements FixedCostInterface
{
    use FixedCostTrait;

    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

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

