<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Graze\GuzzleHttp\JsonRpc\ClientInterface;
use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountActionInterface;
use Ivoz\Cgr\Domain\Service\TpAccountAction\LoadTpAccountActionInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Redis\Client as RedisClient;

class LoadTpAccountAction extends AbstractApiBasedService implements LoadTpAccountActionInterface
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
     * @see TpAccountActionServiceInterface::setAccount()
     * @inheritdoc
     */
    public function execute(TpAccountActionInterface $accountAction)
    {
        $payload = [
            "Tenant" => $accountAction->getTenant(),
            "Account" => $accountAction->getAccount(),
            "ActionPlanIDs" => null,
            "ActionPlansOverwrite" => false,
            "ActionTriggerIDs" => null,
            "ActionTriggerOverwrite" => false,
            "AllowNegative" => null,
            "Disabled" => null,
            "ReloadScheduler" => false
        ];

        $this->sendRequest('ApierV2.SetAccount', $payload);
    }
}