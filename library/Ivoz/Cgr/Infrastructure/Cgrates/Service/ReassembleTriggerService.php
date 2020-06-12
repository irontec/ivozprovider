<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Graze\GuzzleHttp\JsonRpc\ClientInterface;

class ReassembleTriggerService extends AbstractApiBasedService
{
    public function __construct(
        ClientInterface $jsonRpcClient
    ) {
        parent::__construct(
            $jsonRpcClient
        );
    }

    /**
     * @return void
     */
    public function execute(string $tenant, string $account, bool $reset = false)
    {
        $arguments = [
            'Tenant' => $tenant,
            'Account' => $account,
            'ResetCounters' => $reset
        ];

        $this->sendRequest(
            'ApierV1.ResetAccountActionTriggers',
            $arguments
        );
    }
}
