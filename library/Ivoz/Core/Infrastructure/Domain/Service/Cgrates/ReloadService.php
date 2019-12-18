<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

class ReloadService extends AbstractApiBasedService
{
    public function __construct(CgrRpcClient $jsonRpcClient)
    {
        parent::__construct(
            $jsonRpcClient
        );
    }

    /**
     * @param string $tpid
     * @param bool $disableDestinations
     * @return void
     */
    public function execute(string $tpid, bool $disableDestinations = true)
    {
        $payload = [
            "Tpid" => $tpid,
            "Validate" => true,
            "Cleanup" => true,
            "DisableDestinations" => $disableDestinations,
        ];

        $this->sendRequest(
            'ApierV1.LoadTariffPlanFromStorDb',
            $payload
        );
    }
}
