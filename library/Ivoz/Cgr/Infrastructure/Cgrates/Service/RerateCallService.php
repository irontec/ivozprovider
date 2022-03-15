<?php

namespace Ivoz\Cgr\Infrastructure\Cgrates\Service;

use Graze\GuzzleHttp\JsonRpc\ClientInterface;
use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrRepository;
use Ivoz\Core\Infrastructure\Domain\Service\Cgrates\AbstractApiBasedService;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrRepository;
use Ivoz\Kam\Domain\Service\TrunksCdr\RerateCallServiceInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;
use Psr\Log\LoggerInterface;

class RerateCallService extends AbstractApiBasedService implements RerateCallServiceInterface
{
    /**
     * @var TrunksCdrRepository
     */
    protected $trunksCdrRepository;

    /**
     * @var TpCdrRepository
     */
    protected $tpCdrRepository;

    /**
     * @var BillableCallRepository
     */
    protected $billableCallRepository;

    /**
     * @var ProcessExternalCdr
     */
    protected $processExternalCdr;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(
        ClientInterface $jsonRpcClient,
        BillableCallRepository $billableCallRepository,
        TrunksCdrRepository $trunksCdrRepository,
        TpCdrRepository $tpCdrRepository,
        ProcessExternalCdr $processExternalCdr,
        LoggerInterface $logger
    ) {
        $this->billableCallRepository = $billableCallRepository;
        $this->trunksCdrRepository = $trunksCdrRepository;
        $this->tpCdrRepository = $tpCdrRepository;
        $this->processExternalCdr = $processExternalCdr;
        $this->logger = $logger;

        parent::__construct(
            $jsonRpcClient
        );
    }

    /**
     * @inheritdoc
     * @see RerateCallServiceInterface::execute()
     */
    public function execute(array $pks)
    {
        $error = false;

        $cgrids = $this->trunksCdrRepository->getCgridsByBillableCallIds(
            $pks
        );

        $this
            ->tpCdrRepository
            ->fixCorruptedByCgrids(
                $cgrids
            );

        $this
            ->trunksCdrRepository
            ->resetOrphanCgrids(
                $cgrids
            );

        $cgrIds = $this
            ->billableCallRepository
            ->findRerateableCgridsInGroup($pks);

        if (!empty($cgrIds)) {
            try {
                $this->rerate($cgrIds);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $error = true;
            }
        }

        $unrated = $this->billableCallRepository->findUnratedInGroup($pks);
        if (!empty($unrated)) {
            foreach ($unrated as $billableCall) {
                try {
                    $this->processExternalCdr->execute(
                        $billableCall->getTrunksCdr()
                    );
                } catch (\Exception $e) {
                    $this->logger->error($e->getMessage());
                    $error = true;
                    continue;
                }
            }
        }

        // shared
        $this
            ->billableCallRepository
            ->resetPricingData($pks);

        $trunkCdrIds = $this
            ->billableCallRepository
            ->idsToTrunkCdrId($pks);

        $this->trunksCdrRepository
            ->resetParsed($trunkCdrIds);

        if ($error) {
            throw new \DomainException(
                'Some calls could not be rerated'
            );
        }
    }

    /**
     * @param array $cgrIds
     * @return void
     */
    private function rerate(array $cgrIds)
    {
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
    }
}
