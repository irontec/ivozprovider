<?php

namespace Ivoz\Cgr\Domain\Service\RatingPlan;

use Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlanInterface;

class UpdateRatingPlanTag implements RatingPlanLifecycleEventHandlerInterface
{
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
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
