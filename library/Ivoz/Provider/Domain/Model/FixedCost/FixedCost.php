<?php

namespace Ivoz\Provider\Domain\Model\FixedCost;

/**
 * FixedCost
 */
class FixedCost extends FixedCostAbstract implements FixedCostInterface
{
    use FixedCostTrait;

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
