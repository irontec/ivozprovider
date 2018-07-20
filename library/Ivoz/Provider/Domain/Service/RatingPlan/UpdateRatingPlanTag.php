<?php

namespace Ivoz\Provider\Domain\Service\RatingPlan;

use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;

class UpdateRatingPlanTag implements RatingPlanLifecycleEventHandlerInterface
{
    CONST POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    public function execute(RatingPlanInterface $entity)
    {
        /** Set CGRatingPlans Unique Tag */
        $entity->setTag(
            sprintf("b%drp%d",
                $entity->getBrand()->getId(),
                $entity->getId()
            )
        );
    }
}
