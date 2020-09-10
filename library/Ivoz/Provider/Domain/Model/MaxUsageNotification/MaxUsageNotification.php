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
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
