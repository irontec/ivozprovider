<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Ivoz\Kam\Domain\Service\TrunksCdr\RerateCallServiceInterface;
use Graze\GuzzleHttp\JsonRpc\ClientInterface;

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
