<?php

namespace Ivoz\Provider\Domain\Model\BalanceNotification;

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

    protected function sanitizeValues()
    {
        if ($this->getCarrier()) {
            $this->setCompany(null);
        }

        if ($this->getCompany()) {
            $this->setCarrier(null);
        }
    }
}

