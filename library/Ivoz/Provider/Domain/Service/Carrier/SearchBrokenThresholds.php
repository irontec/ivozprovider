<?php

namespace Ivoz\Provider\Domain\Service\Carrier;

use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationRepository;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Carrier\Events\CarrierBalanceThresholdWasBroken;

/**
 * Class SearchBrokenThresholds
 * @package Ivoz\Provider\Domain\Service\Carrier
 * @lifecycle on_commit
 */
class SearchBrokenThresholds implements CarrierLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = 10;

    public function __construct(
        private BalanceNotificationRepository $balanceNotificationRepository,
        private DomainEventPublisher $domainEventPublisher
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY
        ];
    }

    /**
     * @param CarrierInterface $carrier
     *
     * @throws \Exception
     *
     * @return void
     */
    public function execute(CarrierInterface $carrier)
    {
        // Skip new created carriers
        $isNew = $carrier->isNew();
        if ($isNew) {
            return;
        }

        // Only handle balance changes
        if (!$carrier->hasChanged('balance')) {
            return;
        }

        $prevBalance = $carrier->getInitialValue('balance');
        $currentBalance = $carrier->getBalance();

        // Only handle balance decreasement
        if ($currentBalance > $prevBalance) {
            return;
        }

        $brokenThresholds = $this->balanceNotificationRepository->findBrokenThresholdsByCarrier(
            $carrier,
            $prevBalance,
            $currentBalance
        );

        foreach ($brokenThresholds as $brokenThreshold) {
            $this->domainEventPublisher->publish(
                new CarrierBalanceThresholdWasBroken(
                    $brokenThreshold,
                    $prevBalance,
                    $currentBalance
                )
            );
        }
    }
}
