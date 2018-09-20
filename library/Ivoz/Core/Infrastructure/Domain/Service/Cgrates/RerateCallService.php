<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrRepository;
use Ivoz\Kam\Domain\Service\TrunksCdr\RerateCallServiceInterface;
use Graze\GuzzleHttp\JsonRpc\ClientInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;

class RerateCallService extends AbstractApiBasedService implements RerateCallServiceInterface
{
    /**
     * @var TrunksCdrRepository
     */
    protected $trunksCdrRepository;

    /**
     * @var BillableCallRepository
     */
    protected $billableCallRepository;

    public function __construct(
        ClientInterface $jsonRpcClient,
        BillableCallRepository $billableCallRepository,
        TrunksCdrRepository $trunksCdrRepository
    ) {
        $this->billableCallRepository = $billableCallRepository;
        $this->trunksCdrRepository = $trunksCdrRepository;

        return parent::__construct(
            $jsonRpcClient
        );
    }

    /**
     * @inheritdoc
     * @see RerateCallServiceInterface::execute()
     */
    public function execute(array $pks)
    {
        $cgrIds = $this
            ->billableCallRepository
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
            "RerateErrors" => true,
            "RerateRated" => true,
            "SendToStats" => false
        ];

        $this->sendRequest(
            'CdrsV1.RateCDRs',
            $payload
        );

        $this
            ->billableCallRepository
            ->resetPrices($pks);

        $trunkCdrIds = $this
            ->billableCallRepository
            ->idsToTrunkCdrId($pks);

        $this->trunksCdrRepository
            ->resetMetered($trunkCdrIds);
    }
}
