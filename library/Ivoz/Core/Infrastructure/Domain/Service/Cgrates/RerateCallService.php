<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrRepository;
use Ivoz\Kam\Domain\Service\TrunksCdr\RerateCallServiceInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Redis\Client as RedisClient;
use Ivoz\Core\Infrastructure\Domain\Service\Cgrates\AbstractApiBasedService;
use Graze\GuzzleHttp\JsonRpc\ClientInterface;

class RerateCallService extends AbstractApiBasedService implements RerateCallServiceInterface
{
    protected $cdrRepository;

    public function __construct(
        ClientInterface $jsonRpcClient,
        RedisClient $redisClient,
        TrunksCdrRepository $cdrRepository
    ) {
        $this->cdrRepository = $cdrRepository;

        return parent::__construct(
            $jsonRpcClient,
            $redisClient
        );
    }

    /**
     * @inheritdoc
     */
    public function execute(array $pks)
    {
        $cgrIds = $this
            ->cdrRepository
            ->idsToCgrid($pks);

        $payload = [
            "CgrIds" => $cgrIds,
            "MediationRunIds" => null,
            "TORs" => null,
            "CdrHosts" => null,
            "CdrSources" => null,
            "ReqTypes" => null,
            "Tenants" => null,
            "Categories" => null,
            "Accounts" => null,
            "Subjects" => null,
            "DestinationPrefixes" => null,
            "OrderIdStart" => null,
            "OrderIdEnd" => null,
            "TimeStart" => "",
            "TimeEnd" => "",
            "RerateErrors" => false,
            "RerateRated" => true,
            "SendToStats" => false
        ];

        return $this->sendRequest(
            'CdrsV1.RateCDRs',
            $payload
        );
    }
}