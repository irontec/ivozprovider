<?php

namespace Ivoz\Provider\Domain\Model\BalanceNotification;

use Doctrine\Common\Collections\Criteria;

/**
 * BalanceNotification
 */
class BalanceNotification extends BalanceNotificationAbstract implements BalanceNotificationInterface
{
    use BalanceNotificationTrait;

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

