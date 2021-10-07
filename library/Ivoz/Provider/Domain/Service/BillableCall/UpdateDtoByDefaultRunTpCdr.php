<?php

namespace Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrInterface;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationRepository;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanRepository;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallDto;
use Psr\Log\LoggerInterface;

class UpdateDtoByDefaultRunTpCdr
{
    public function __construct(
        private TpRatingPlanRepository $tpRatingPlanRepository,
        private TpDestinationRepository $tpDestinationRepository,
        private LoggerInterface $logger
    ) {
    }

    /**
     * @param BillableCallDto $billableCallDto
     * @param TrunksCdrInterface $trunksCdr
     * @param TpCdrInterface $defaultRunTpCdr
     * @returns BillableCallDto
     */
    public function execute(
        BillableCallDto $billableCallDto,
        TrunksCdrInterface $trunksCdr,
        TpCdrInterface $defaultRunTpCdr
    ) :BillableCallDto {
        if (!$defaultRunTpCdr->getCostDetailsFirstTimespan()) {
            $errorMsg = sprintf(
                'Empty cost details. Skipping'
            );
            $this->logger->error($errorMsg);

            return $billableCallDto;
        }

        $cost = $defaultRunTpCdr->getCost();
        $callee = $defaultRunTpCdr->getDestination()
            ? $defaultRunTpCdr->getDestination()
            : $billableCallDto->getCallee();

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
            ->setPrice(
                $cost
            );

        $tpRatingPlan = $this->tpRatingPlanRepository->findOneByTag(
            $defaultRunTpCdr->getRatingPlanTag()
        );

        if ($cost < 0 || !$tpRatingPlan) {
            $errorMsg = empty($tpRatingPlan)
                ? 'Rating plan not found'
                : 'Rating price error';

            $this->logger->error(
                $errorMsg . '. Setting some Destination/RatingPlan save values and skipping'
            );

            $billableCallDto
                ->setDestinationId(
                    null
                )
                ->setDestinationName(
                    null
                )
                ->setRatingPlanGroupId(
                    null
                )
                ->setRatingPlanName(
                    null
                );

            return $billableCallDto;
        }

        $ratingPlan = $tpRatingPlan->getRatingPlan();

        $ratingPlanGroup = $ratingPlan->getRatingPlanGroup();
        $ratingPlanGroupId = $ratingPlanGroup->getId();

        $languageCode = ucfirst($trunksCdr->getBrand()->getLanguageCode());
        $brandLangGetter = 'get' . $languageCode;
        $ratingPlanGroupName = $ratingPlanGroup->getName()->{$brandLangGetter}();

        $tpDestination = $this->tpDestinationRepository->findOneByTag(
            $defaultRunTpCdr->getMatchedDestinationTag()
        );

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

        $billableCallDto
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
            );

        return $billableCallDto;
    }
}
