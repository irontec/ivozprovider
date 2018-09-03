<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Graze\GuzzleHttp\JsonRpc\ClientInterface;
use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountActionInterface;
use Ivoz\Cgr\Domain\Service\TpAccountAction\RemoveTpAccountActionInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Redis\Client as RedisClient;

class RemoveTpAccountAction extends AbstractApiBasedService implements RemoveTpAccountActionInterface
{
    /**
     * TpAccountActionService constructor.
     * @param ClientInterface $client
     * @param RedisClient $redisClient
     */
    public function __construct(
        ClientInterface $jsonRpcClient,
        RedisClient $redisClient
    ) {
        parent::__construct(...func_get_args());
    }

    /**
     * @see TpAccountActionServiceInterface::removeAccount()
     * @inheritdoc
     */
    public function execute(TpAccountActionInterface $accountAction)
    {
        $company = $accountAction->getCompany();

        if ($company && $company->getId()) {
            return;
        }

        $payload = [
            "Tenant" => $accountAction->getTenant(),
            "Account" => $accountAction->getAccount(),
            "ReloadScheduler" => false
        ];

        $this->sendRequest(
            'ApierV1.RemoveAccount',
            $payload
        );
    }
}
