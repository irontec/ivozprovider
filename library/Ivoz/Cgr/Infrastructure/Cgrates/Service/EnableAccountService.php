<?php

namespace Ivoz\Cgr\Infrastructure\Cgrates\Service;

use Graze\GuzzleHttp\JsonRpc\ClientInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Cgrates\AbstractApiBasedService;

class EnableAccountService extends AbstractApiBasedService
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
    public function execute(string $tenant, string $account)
    {
        $this->sendRequest(
            'ApierV1.SetAccount',
            [
                'Tenant' => $tenant,
                'Account' => $account,
                'Disabled' => false
            ]
        );
    }
}
