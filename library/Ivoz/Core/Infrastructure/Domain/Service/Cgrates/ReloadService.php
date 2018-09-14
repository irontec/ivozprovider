<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrRepository;
use Ivoz\Kam\Domain\Service\TrunksCdr\RerateCallServiceInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Redis\Client as RedisClient;
use Graze\GuzzleHttp\JsonRpc\ClientInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;

class ReloadService extends AbstractApiBasedService
{
    /**
     * ReloadService constructor.
     *
     * @param ClientInterface $jsonRpcClient
     */
    public function __construct(ClientInterface $jsonRpcClient)
    {
        return parent::__construct(
            $jsonRpcClient
        );
    }

    /**
     * @inheritdoc
     * @see RerateCallServiceInterface::execute()
     */
    public function execute(string $tpid)
    {
        $payload = [
            "Tpid" => $tpid,
            "Validate" => true,
            "Cleanup" => true,
        ];

        $this->sendRequest(
            'ApierV1.LoadTariffPlanFromStorDb',
            $payload
        );
    }
}
