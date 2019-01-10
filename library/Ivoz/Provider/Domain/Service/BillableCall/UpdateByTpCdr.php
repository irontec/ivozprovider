<?php

namespace Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrInterface;
use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrRepository;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationRepository;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanRepository;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallDto;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\Destination\DestinationInterface;
use Ivoz\Kam\Domain\Model\TrunksCdr\Event\TrunksCdrWasMigrated;
use Ivoz\Core\Domain\Event\DomainEventInterface;

class UpdateByTpCdr implements DomainEventSubscriberInterface
{
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
     * @var EntityTools
     */
    protected $entityTools;

    public function __construct(
        TpCdrRepository $tpCdrRepository,
        TpRatingPlanRepository $tpRatingPlanRepository,
        TpDestinationRepository $tpDestinationRepository,
        EntityTools $entityTools
    ) {
        $this->tpCdrRepository = $tpCdrRepository;
        $this->tpRatingPlanRepository = $tpRatingPlanRepository;
        $this->tpDestinationRepository = $tpDestinationRepository;
        $this->entityTools = $entityTools;
    }

    /**
     * @param DomainEventInterface $domainEvent
     * @return boolean
     */
    public function isSubscribedTo(DomainEventInterface $domainEvent)
    {
        if ($domainEvent instanceof TrunksCdrWasMigrated) {
            return true;
        }

        return false;
    }

    /**
     * @param TrunksCdrWasMigrated $domainEvent
     * @throws \Exception
     * @return void
     */
    public function handle(DomainEventInterface $domainEvent)
    {
        if (!($domainEvent instanceof TrunksCdrWasMigrated)) {
            throw new \Exception('TrunksCdrWasMigrated was expected');
        }

        $trunksCdr = $domainEvent->getTrunksCdr();
        $cgrid = $trunksCdr->getCgrid();
        if (!$cgrid) {
            return;
        }
        $billableCall = $domainEvent->getBillableCall();

        $this->execute(
            $trunksCdr,
            $billableCall
        );
    }

    /**
     * @param BillableCallInterface $billableCall
     * @return void
     */
    protected function execute(
        TrunksCdrInterface $trunksCdr,
        BillableCallInterface $billableCall
    ) {
        $cgrid = $trunksCdr->getCgrid();

        /** @var BillableCallDto $billableCallDto */
        $billableCallDto = $this->entityTools->entityToDto($billableCall);

        /**
         * @var TpCdrInterface $defaultRunTpCdr
         */
        $defaultRunTpCdr = $this->tpCdrRepository->getDefaultRunByCgrid(
            $cgrid
        );

        if (!$defaultRunTpCdr) {
            return;
        }

        if (!$defaultRunTpCdr->getCostDetailsFirstTimespan()) {
            return;
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
        if (!$tpRatingPlan) {
            return;
        }

        $ratingPlan = $tpRatingPlan->getRatingPlan();
        $ratingPlanGroup = $ratingPlan->getRatingPlanGroup();

        $ratingPlanGroupId = $ratingPlanGroup
            ? $ratingPlanGroup->getId()
            : null;

        $languageCode = ucfirst($trunksCdr->getBrand()->getLanguageCode());
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

        $this->entityTools->persistDto(
            $billableCallDto,
            $billableCall,
            false
        );

        return $billableCall;
    }
}
