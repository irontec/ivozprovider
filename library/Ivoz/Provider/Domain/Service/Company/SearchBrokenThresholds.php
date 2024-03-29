<?php

namespace Ivoz\Provider\Domain\Service\Company;

use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationRepository;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\Events\CompanyBalanceThresholdWasBroken;

/**
 * Class SearchBrokenThresholds
 * @package Ivoz\Provider\Domain\Service\Company
 * @lifecycle on_commit
 */
class SearchBrokenThresholds implements CompanyLifecycleEventHandlerInterface
{
    public function __construct(
        private BalanceNotificationRepository $balanceNotificationRepository,
        private DomainEventPublisher $domainEventPublisher
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => 10
        ];
    }

    public function execute(CompanyInterface $company): void
    {
        // Skip new created company
        $isNew = $company->isNew();
        if ($isNew) {
            return;
        }

        // Only handle balance changes
        if (!$company->hasChanged('balance')) {
            return;
        }

        $prevBalance = $company->getInitialValue('balance');
        $currentBalance = $company->getBalance();

        // Only handle balance decreasement
        if ($currentBalance > $prevBalance) {
            return;
        }

        $brokenThresholds = $this->balanceNotificationRepository->findBrokenThresholdsByCompany(
            $company,
            $prevBalance,
            $currentBalance
        );

        foreach ($brokenThresholds as $brokenThreshold) {
            $this->domainEventPublisher->publish(
                new CompanyBalanceThresholdWasBroken(
                    $brokenThreshold,
                    $prevBalance,
                    $currentBalance
                )
            );
        }
    }
}
