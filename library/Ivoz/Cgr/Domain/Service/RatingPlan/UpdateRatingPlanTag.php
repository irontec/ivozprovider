<?php

namespace Ivoz\Cgr\Domain\Service\RatingPlan;

use Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlanInterface;

class UpdateRatingPlanTag implements RatingPlanLifecycleEventHandlerInterface
{
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
