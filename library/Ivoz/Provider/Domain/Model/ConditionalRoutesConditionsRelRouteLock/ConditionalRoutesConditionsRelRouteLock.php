<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock;

/**
 * ConditionalRoutesConditionsRelRouteLock
 * @codeCoverageIgnore
 */
class ConditionalRoutesConditionsRelRouteLock extends ConditionalRoutesConditionsRelRouteLockAbstract implements ConditionalRoutesConditionsRelRouteLockInterface
{
    use ConditionalRoutesConditionsRelRouteLockTrait;

    /**
     * @codeCoverageIgnore
     * @return array
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
