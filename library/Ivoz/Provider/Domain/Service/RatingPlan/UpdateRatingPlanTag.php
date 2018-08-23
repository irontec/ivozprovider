<?php

namespace Ivoz\Provider\Domain\Service\RatingPlan;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;

class UpdateRatingPlanTag implements RatingPlanLifecycleEventHandlerInterface
{
    CONST POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    public function __construct(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    public function execute(RatingPlanInterface $ratingPlan)
    {
        $ratingPlanDto = $this->entityTools->entityToDto($ratingPlan);

        /** Set CGRatingPlans Unique Tag */
        $ratingPlanDto->setTag(
            sprintf("b%drp%d",
                $ratingPlan->getBrand()->getId(),
                $ratingPlan->getId()
            )
        );

        $this->entityTools->persistDto(
            $ratingPlanDto,
            $ratingPlan,
            false
        );
    }
}
