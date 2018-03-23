<?php

namespace Ivoz\Provider\Domain\Model\Company\Events;

use Ivoz\Core\Domain\Event\DomainEventInterface;
use Ivoz\Core\Domain\Event\DomainEventTrait;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationInterface;

class CompanyBalanceThresholdWasBroken implements DomainEventInterface
{
    use DomainEventTrait;

    /**
     * @var int
     */
    protected $balanceNotificationId;

    /**
     * @var float
     */
    protected $prevBalance;

    /**
     * @var float
     */
    protected $threshold;

    /**
     * @var float
     */
    protected $currentBalance;

    public function __construct(
        BalanceNotificationInterface $balaceNotification,
        float $prevBalance,
        float $currentBalance
    ) {
        $this->setEventTimestamp();
        $this
            ->setBalanceNotificationId(
                $balaceNotification->getId()
            )
            ->setThreshold(
                $balaceNotification->getThreshold()
            )
            ->setPrevBalance(
                $prevBalance
            )
            ->setCurrentBalance(
                $currentBalance
            );
    }

    /**
     * @return int
     */
    public function getBalanceNotificationId()
    {
        return $this->balanceNotificationId;
    }

    /**
     * @param int $balanceNotificationId
     * @throws \Exception
     */
    protected function setBalanceNotificationId(
        $balanceNotificationId
    ) {
        if (empty($balanceNotificationId)) {
            throw new \Exception('Balance notification id cannot be empty');
        }

        $this->balanceNotificationId = $balanceNotificationId;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrevBalance()
    {
        return $this->prevBalance;
    }

    /**
     * @param float $prevBalance
     * @return CompanyBalanceThresholdWasBroken
     */
    protected function setPrevBalance($prevBalance)
    {
        $this->prevBalance = $prevBalance;
        return $this;
    }

    /**
     * @return float
     */
    public function getThreshold()
    {
        return $this->threshold;
    }

    /**
     * @param float $threshold
     * @return CompanyBalanceThresholdWasBroken
     */
    protected function setThreshold($threshold)
    {
        $this->threshold = $threshold;
        return $this;
    }

    /**
     * @return float
     */
    public function getCurrentBalance()
    {
        return $this->currentBalance;
    }

    /**
     * @param float $currentBalance
     * @return CompanyBalanceThresholdWasBroken
     */
    protected function setCurrentBalance($currentBalance)
    {
        $this->currentBalance = $currentBalance;
        return $this;
    }
}