<?php

namespace Ivoz\Cgr\Infrastructure\Cgrates\Service;

use Graze\GuzzleHttp\JsonRpc\ClientInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Cgrates\AbstractApiBasedService;

class SetMaxUsageThresholdService extends AbstractApiBasedService
{
    public function __construct(
        ClientInterface $jsonRpcClient,
        private CompanyBalanceService $companyBalanceService,
        private ReassembleTriggerService $reassembleTriggerService,
        private EnableAccountService $enableAccountService
    ) {
        parent::__construct(
            $jsonRpcClient
        );
    }

    /**
     * @return void
     */
    public function execute(string $tenant, string $account, int $threshold)
    {
        $mustReassemble = $this->isReassembleNeeded(
            $tenant,
            $account,
            $threshold
        );

        $this->setNewThreshold(
            $tenant,
            $account,
            $threshold
        );

        if ($mustReassemble) {
            $this->reassembleTriggerService->execute(
                $tenant,
                $account
            );

            $this->enableAccountService->execute(
                $tenant,
                $account
            );
        }
    }

    private function isReassembleNeeded(string $tenant, string $account, int $threshold): bool
    {
        $brandId = substr($tenant, 1);
        $companyId = substr($account, 1);

        $currentDayUsage = $this->companyBalanceService->getCurrentDayUsage(
            $brandId,
            $companyId
        );

        return $threshold > $currentDayUsage;
    }

    /**
     * @param string $tenant
     * @param string $account
     * @param int $threshold
     *
     * @return void
     */
    private function setNewThreshold(string $tenant, string $account, int $threshold): void
    {
        $payload = [
            'Tenant' => $tenant,
            'Account' => $account,
            'UniqueID' => '*default',
            'BalanceType' => '*monetary',
            'ThresholdValue' => $threshold
        ];

        $this->sendRequest(
            'ApierV1.SetAccountActionTriggers',
            $payload
        );
    }
}
