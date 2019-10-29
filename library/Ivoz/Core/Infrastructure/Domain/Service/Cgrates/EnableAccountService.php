<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

class EnableAccountService extends AbstractApiBasedService
{
    public function __construct(
        CgrRpcClient $jsonRpcClient
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
