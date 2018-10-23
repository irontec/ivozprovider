<?php

namespace Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrInterface;
use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrRepository;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationRepository;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanRepository;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrDto;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrRepository;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCall;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallDto;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Destination\DestinationInterface;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanRepository;
use Psr\Log\LoggerInterface;

class MigrateFromTrunksCdr
{
    const BATCH_SIZE = 100;

    /**
     * @var TrunksCdrRepository
     */
    protected $trunksCdrRepository;

    /**
     * @var TpCdrRepository
     */
    protected $tpCdrRepository;

    /**
     * @var TpRatingPlanRepository
     */
    protected $tpRatingPlanRepository;

    /**
     * @var TpDestinationRepository
     */
    protected $tpDestinationRepository;

    /**
     * @var BillableCallRepository
     */
    protected $billableCallRepository;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(
        TrunksCdrRepository  $trunksCdrRepository,
        TpCdrRepository $tpCdrRepository,
        TpRatingPlanRepository $tpRatingPlanRepository,
        TpDestinationRepository $tpDestinationRepository,
        BillableCallRepository $billableCallRepository,
        EntityTools $entityTools,
        LoggerInterface $logger
    ) {
        $this->trunksCdrRepository = $trunksCdrRepository;
        $this->tpCdrRepository = $tpCdrRepository;
        $this->tpRatingPlanRepository = $tpRatingPlanRepository;
        $this->tpDestinationRepository = $tpDestinationRepository;
        $this->billableCallRepository = $billableCallRepository;
        $this->entityTools = $entityTools;
        $this->logger = $logger;
    }

    public function execute()
    {
        /**
         * @var \Generator
         */
        $trunksGenerator = $this->trunksCdrRepository->getUnmeteredCallsGeneratorWithoutOffset(self::BATCH_SIZE);

        $cdrCount = 0;
        foreach ($trunksGenerator as $trunks) {
            if (empty($trunks)) {
                break;
            }

            foreach ($trunks as $trunkCdr) {
                $this->migrateToBillableCall($trunkCdr);
            }

            try {
                $this->entityTools->dispatchQueuedOperations();
                $cdrCount += count($trunks);
            } catch (\Exception $e) {
                $this->logger->error('BillableCall migration service error:: ' . $e->getMessage());
                // Keep going
            }
        }

        $this->logger->info('BillableCall migration service has migrated ' . $cdrCount . ' successfully');
    }

    private function migrateToBillableCall(TrunksCdrInterface $trunksCdr)
    {
        /**
         * @var BillableCallInterface $billableCall
         */
        $billableCall = $this->billableCallRepository->findOneBy([
            'trunksCdr' => $trunksCdr->getId()
        ]);

        $billableCallDto = $this->createOrUpdateBillableCallByTrunksCdr(
            $trunksCdr,
            $billableCall
        );

        $this->updateBillableCallByTpCdr(
            $billableCallDto,
            $trunksCdr->getCgrid(),
            ucfirst($trunksCdr->getBrand()->getLanguageCode())
        );

        $this->entityTools->persistDto(
            $billableCallDto,
            $billableCall,
            false
        );

        /**
         * @var TrunksCdrDto $trunksCdrDto
         */
        $trunksCdrDto = $this->entityTools->entityToDto(
            $trunksCdr
        );
        $trunksCdrDto->setMetered(true);
        $this->entityTools->persistDto(
            $trunksCdrDto,
            $trunksCdr,
            false
        );
    }

    /**
     * @param TrunksCdrInterface $trunksCdr
     * @param TrunksCdrDto $trunksCdrDto
     *
     * @return BillableCallDto
     */
    private function createOrUpdateBillableCallByTrunksCdr(
        TrunksCdrInterface $trunksCdr,
        BillableCallInterface $billableCall = null
    ) {
        $billableCallDto = $billableCall
            ? $this->entityTools->entityToDto($billableCall)
            : BillableCall::createDto();

        /**
         * @var CarrierInterface $carrier
         */
        $carrier = $trunksCdr->getCarrier();

        $carrierName = $carrier
            ? $carrier->getName()
            : '';

        /**
         * @var TrunksCdrDto $trunksCdrDto
         */
        $trunksCdrDto = $this->entityTools->entityToDto(
            $trunksCdr
        );

        $caller = $trunksCdrDto->getDiversion()
            ? $trunksCdrDto->getDiversion()
            : $trunksCdrDto->getCaller();

        $billableCallDto
            ->setTrunksCdrId(
                $trunksCdrDto->getId()
            )->setBrandId(
                $trunksCdrDto->getBrandId()
            )->setCompanyId(
                $trunksCdrDto->getCompanyId()
            )->setCarrierId(
                $trunksCdrDto->getCarrierId()
            )->setCarrierName(
                $carrierName
            )->setCallid(
                $trunksCdrDto->getCallid()
            )->setCaller(
                $caller
            )->setCallee(
                $trunksCdrDto->getCallee()
            )->setStartTime(
                $trunksCdrDto->getStartTime()
            )->setDuration(
                $trunksCdrDto->getDuration()
            );

        if ($trunksCdrDto->getRetailAccountId()) {
            $billableCallDto
                ->setEndpointType('RetailAccount')
                ->setEndpointId($trunksCdrDto->getRetailAccountId());
        }

        return $billableCallDto;
    }

    /**
     * @param BillableCallDto $billableCallDto
     * @param string $cgrid | null
     * @param string $languageCode
     * @return BillableCallDto
     */
    private function updateBillableCallByTpCdr(BillableCallDto $billableCallDto, string $cgrid = null, string $languageCode)
    {
        if (!$cgrid) {
            return $billableCallDto;
        }

        /**
         * @var TpCdrInterface $defaultRunTpCdr
         */
        $defaultRunTpCdr = $this->tpCdrRepository->getDefaultRunByCgrid(
            $cgrid
        );

        if (!$defaultRunTpCdr) {
            return $billableCallDto;
        }

        if (!$defaultRunTpCdr->getCostDetailsFirstTimespan()) {
            return $billableCallDto;
        }

        $callee = $defaultRunTpCdr->getDestination()
            ? $defaultRunTpCdr->getDestination()
            : $billableCallDto->getCallee();

        /**
         * @var TpRatingPlanInterface $tpRatingPlan
         */
        $tpRatingPlan = $this->tpRatingPlanRepository->findOneByTag(
            $defaultRunTpCdr->getRatingPlanTag()
        );

        $ratingPlan = $tpRatingPlan->getRatingPlan();
        $ratingPlanGroup = $ratingPlan->getRatingPlanGroup();

        $ratingPlanGroupId = $ratingPlanGroup
            ? $ratingPlanGroup->getId()
            : null;

        $brandLangGetter = 'get' . $languageCode;
        $ratingPlanGroupName = $ratingPlanGroup
            ? $ratingPlanGroup->getName()->{$brandLangGetter}()
            : '';

        /** @var TpDestinationInterface $tpDestination */
        $tpDestination = $this->tpDestinationRepository->findOneByTag(
            $defaultRunTpCdr->getMatchedDestinationTag()
        );
        /** @var DestinationInterface $destination */
        $destination = $tpDestination
            ? $tpDestination->getDestination()
            : null;

        $destinationId = $destination
            ? $destination->getId()
            : null;

        $brandLangGetter = 'get' . $languageCode;
        $destinationName = $destination
            ? $destination->getName()->{$brandLangGetter}()
            : '';

        $startTime = $defaultRunTpCdr->getStartTime()
            ? $defaultRunTpCdr->getStartTime()
            : $billableCallDto->getStartTime();

        $duration = $defaultRunTpCdr->getDuration()
            ? $defaultRunTpCdr->getDuration()
            : $billableCallDto->getDuration();

        $billableCallDto
            ->setStartTime(
                $startTime
            )
            ->setDuration(
                $duration
            )
            ->setCallee(
                $callee
            )
            ->setDestinationId(
                $destinationId
            )
            ->setDestinationName(
                $destinationName
            )
            ->setRatingPlanGroupId(
                $ratingPlanGroupId
            )
            ->setRatingPlanName(
                $ratingPlanGroupName
            )->setPrice(
                $defaultRunTpCdr->getCost()
            );

        /**
         * @var TpCdrInterface $carrierRunTpCdr
         */
        $carrierRunTpCdr = $this->tpCdrRepository->getCarrierRunByCgrid(
            $cgrid
        );

        if ($carrierRunTpCdr) {
            $billableCallDto->setCost(
                $carrierRunTpCdr->getCost()
            );
        }

        return $billableCallDto;
    }
}
