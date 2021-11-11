<?php

namespace Ivoz\Provider\Domain\Model\RouteLock;

/**
 * RouteLock
 */
class RouteLock extends RouteLockAbstract implements RouteLockInterface
{
    use RouteLockTrait;

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

    /**
     * Return in current lock status is open
     *
     * @return boolean
     */
    public function isOpen()
    {
        return $this->getOpen() == '1';
    }
}
