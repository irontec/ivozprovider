<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Ivoz\Kam\Domain\Service\TrunksCdr\RerateCallServiceInterface;

class ReloadService extends AbstractApiBasedService
{
    public function __construct(CgrRpcClient $jsonRpcClient)
    {
        parent::__construct(
            $jsonRpcClient
        );
    }

    /**
     * @return void
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
