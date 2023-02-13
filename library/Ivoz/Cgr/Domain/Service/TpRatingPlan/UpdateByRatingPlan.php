<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingPlan;

use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlan;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanDto;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Ivoz\Provider\Domain\Service\RatingPlan\RatingPlanLifecycleEventHandlerInterface;

class UpdateByRatingPlan implements RatingPlanLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * @return void
     */
    public function execute(RatingPlanInterface $ratingPlan)
    {
        $tpRatingPlan = $ratingPlan->getTpRatingPlan();
        $brand = $ratingPlan->getRatingPlanGroup()->getBrand();
        $destinationRateGroup = $ratingPlan->getDestinationRateGroup();

        /** @var TpRatingPlanDto $tpRatingPlanDto */
        $tpRatingPlanDto = is_null($tpRatingPlan)
            ? TpRatingPlan::createDto()
            : $this->entityTools->entityToDto($tpRatingPlan);

        // Update/Create TpRatingPorfile for this RatingPlan
        $tpRatingPlanDto
            ->setTpid($brand->getCgrTenant())
            ->setTag($ratingPlan->getCgrTag())
            ->setDestratesTag($destinationRateGroup->getCgrTag())
            ->setTimingTag($ratingPlan->getCgrTimingTag())
            ->setWeight($ratingPlan->getWeight())
            ->setRatingPlanId($ratingPlan->getId());

        /** @var TpRatingPlanInterface $tpRatingPlan */
        $tpRatingPlan = $this->entityTools->persistDto(
            $tpRatingPlanDto,
            $tpRatingPlan,
            false
        );

        $ratingPlan
            ->setTpRatingPlan($tpRatingPlan);

        $this
            ->entityTools
            ->persist($ratingPlan, false);
    }
}
