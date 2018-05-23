<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingPlan;

use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface;

class InheritRatingPlanTag implements TpRatingPlanLifecycleEventHandlerInterface
{
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    public function execute(TpRatingPlanInterface $entity)
    {
        /** Get CGRates tag from parent table */
        $entity->setTag(
            $entity->getRatingPlan()->getTag()
        );

        $entity->setDestratesTag(
            $entity->getDestinationRate()->getTag()
        );

        $timing = $entity->getTiming();
        if (!is_null($timing)) {
            $entity->setTimingTag(
                $entity->getTiming()->getTag()
            );
        }
    }

}
