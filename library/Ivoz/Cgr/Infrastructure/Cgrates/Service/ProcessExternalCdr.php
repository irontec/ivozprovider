<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrInterface;
use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrRepository;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrDto;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Psr\Log\LoggerInterface;

class ProcessExternalCdr
{
    const DATE_FORMAT = 'Y-m-d\TH:i:s\Z';

    protected $apiClient;
    protected $entityTools;
    protected $tpCdrRepository;
    protected $logger;
    protected $trunksClient;

    public function __construct(
        ApiClient $apiClient,
        EntityTools $entityTools,
        TpCdrRepository $tpCdrRepository,
        LoggerInterface $logger,
        TrunksClientInterface $trunksClient
    ) {
        $this->entityTools = $entityTools;
        $this->logger = $logger;
        $this->tpCdrRepository = $tpCdrRepository;
        $this->apiClient = $apiClient;
        $this->trunksClient = $trunksClient;
    }

    /**
     * @param TrunksCdrInterface $trunksCdr
     * @return bool
     * @throws \DomainException
     */
    public function execute(TrunksCdrInterface $trunksCdr)
    {
        $isNotOutbound = !$trunksCdr->isOutboundCall();
        if ($isNotOutbound) {
            return false;
        }

        $carrier = $trunksCdr->getCarrier();
        if ($carrier && $carrier->getExternallyRated()) {
            return false;
        }

        if (!$this->trunksClient->isCgrEnabled()) {
            return false;
        }

        $brand = $trunksCdr->getBrand();
        $company = $trunksCdr->getCompany();
        $time = $trunksCdr
            ->getStartTime()
            ->format(self::DATE_FORMAT);

        $callId = $trunksCdr->getCallid();

        $payload = [
            'OriginHost' => '127.0.0.1',
            'Source' => 'offline',
            'OriginID' => $callId,
            'ToR' => '*voice',
            'RequestType' => '*' . $company->getBillingMethod(),
            'Tenant' => 'b' . $brand->getId(),
            'Account' => 'c' . $company->getId(),
            'Destination' => $trunksCdr->getCallee(),
            'SetupTime' => $time,
            'AnswerTime' => $time,
            'Usage' => round($trunksCdr->getDuration()) . 's'
        ];

        if ($carrier) {
            $calculateCost = $carrier->getCalculateCost()
                ? '1'
                : '0';

            $payload['ExtraFields'] = [
                'carrierId' => 'cr' . $carrier->getId(),
                'calculateCost' => $calculateCost
            ];
        }

        try {
            $response = $this->apiClient->sendRequest(
                'CdrsV1.ProcessExternalCDR',
                $payload
            );

            /** @var TpCdrInterface $tpCdr */
            $tpCdr = $this->tpCdrRepository->getByOriginId($callId);
            if (!$tpCdr) {
                throw new \DomainException('TpCdr not found');
            }

            /** @var TrunksCdrDto $trunksCdrDto */
            $trunksCdrDto = $this->entityTools->entityToDto($trunksCdr);
            $trunksCdrDto->setCgrid($tpCdr->getCgrid());

            $this->entityTools->persistDto(
                $trunksCdrDto,
                $trunksCdr,
                false
            );
        } catch (\Exception $e) {
            $errorMsg = sprintf(
                'Unable to process external cdr for #%s: %s',
                $trunksCdr->getId(),
                $e->getMessage()
            );
            $this->logger->error($errorMsg);

            throw new \DomainException('There was a error on external CDR processing', $e->getCode(), $e);
        }

        return true;
    }
}
