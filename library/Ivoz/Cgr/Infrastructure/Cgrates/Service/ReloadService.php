<?php

namespace Ivoz\Cgr\Infrastructure\Cgrates\Service;

use Graze\GuzzleHttp\JsonRpc\ClientInterface;
use Ivoz\Core\Application\MutexInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Cgrates\AbstractApiBasedService;

class ReloadService extends AbstractApiBasedService
{
    const MUTEX_LOCK_NAME = 'cgr.reload';

    private $mutext;

    public function __construct(
        ClientInterface $jsonRpcClient,
        MutexInterface $mutext
    ) {
        parent::__construct(
            $jsonRpcClient
        );

        $this->mutext = $mutext;
    }

    /**
     * @param string $tpid
     * @param bool $disableDestinations
     * @return void
     */
    public function execute(string $tpid, bool $disableDestinations = true)
    {
        try {
            $this->mutext->lock(
                self::MUTEX_LOCK_NAME,
                1800
            );

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
        } finally {
            $this->mutext->release();
        }
    }
}
