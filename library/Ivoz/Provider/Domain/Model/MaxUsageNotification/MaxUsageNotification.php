<?php

namespace Ivoz\Provider\Domain\Model\MaxUsageNotification;

/**
 * MaxUsageNotification
 */
class MaxUsageNotification extends MaxUsageNotificationAbstract implements MaxUsageNotificationInterface
{
    use MaxUsageNotificationTrait;

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
