<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Graze\GuzzleHttp\JsonRpc\ClientInterface;
use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountActionInterface;
use Ivoz\Cgr\Domain\Service\TpAccountAction\TpAccountActionServiceInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Redis\Client as RedisClient;

class TpAccountActionService extends AbstractApiBasedService implements TpAccountActionServiceInterface
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
    public function setAccount(TpAccountActionInterface $accountAction)
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

    /**
     * @see TpAccountActionServiceInterface::removeAccount()
     * @inheritdoc
     */
    public function removeAccount(TpAccountActionInterface $accountAction)
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