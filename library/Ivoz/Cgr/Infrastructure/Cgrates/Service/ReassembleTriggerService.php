<?php

namespace Ivoz\Cgr\Infrastructure\Cgrates\Service;

use Graze\GuzzleHttp\JsonRpc\ClientInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Cgrates\AbstractApiBasedService;

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
