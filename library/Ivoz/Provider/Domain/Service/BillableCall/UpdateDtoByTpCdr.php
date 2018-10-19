<?php

namespace Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrInterface;
use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrRepository;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationRepository;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanRepository;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallDto;
use Ivoz\Provider\Domain\Model\Destination\DestinationInterface;

class UpdateDtoByTpCdr
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

    public function __construct(
        TpCdrRepository $tpCdrRepository,
        TpRatingPlanRepository $tpRatingPlanRepository,
        TpDestinationRepository $tpDestinationRepository
    ) {
        $this->tpCdrRepository = $tpCdrRepository;
        $this->tpRatingPlanRepository = $tpRatingPlanRepository;
        $this->tpDestinationRepository = $tpDestinationRepository;
    }

    /**
     * @param BillableCallDto $billableCallDto
     * @param string $cgrid | null
     * @param string $languageCode
     * @return BillableCallDto
     */
    public function execute(BillableCallDto $billableCallDto, string $cgrid = null, string $languageCode)
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
