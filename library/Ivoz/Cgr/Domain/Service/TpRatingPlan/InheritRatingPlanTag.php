<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingPlan;

use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface;

class InheritRatingPlanTag implements TpRatingPlanLifecycleEventHandlerInterface
{
    public function execute(TpRatingPlanInterface $entity)
    {
        /** Get CGRates tag from parent table */
        $entity->setTag(
            $entity->getRatingPlan()->getTag()
        );

        $entity->setDestratesTag(
            $entity->getDestinationRate()->getTag()
        );
    }

}
