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
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface;
use Psr\Log\LoggerInterface;

class UpdateDtoByDefaultRunTpCdr
{
    /**
     * @var TpRatingPlanRepository
     */
    protected $tpRatingPlanRepository;

    /**
     * @var TpDestinationRepository
     */
    protected $tpDestinationRepository;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(
        TpRatingPlanRepository $tpRatingPlanRepository,
        TpDestinationRepository $tpDestinationRepository,
        LoggerInterface $logger
    ) {
        $this->tpRatingPlanRepository = $tpRatingPlanRepository;
        $this->tpDestinationRepository = $tpDestinationRepository;
        $this->logger = $logger;
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

        /**
         * @var TpRatingPlanInterface $tpRatingPlan
         */
        $tpRatingPlan = $this->tpRatingPlanRepository->findOneByTag(
            $defaultRunTpCdr->getRatingPlanTag()
        );

        if (is_null($cost) || $cost < 0 || !$tpRatingPlan) {
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

        /** @var RatingPlanInterface $ratingPlan */
        $ratingPlan = $tpRatingPlan->getRatingPlan();

        /** @var RatingPlanGroupInterface $ratingPlanGroup */
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
