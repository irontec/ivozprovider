<?php

namespace Ivoz\Provider\Domain\Service\RatingPlan;

use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;

class CheckDestinationRateGroupDuplicates implements RatingPlanLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * @param RatingPlanInterface $ratingPlan
     *
     * @return void
     */
    public function execute(RatingPlanInterface $ratingPlan)
    {
        $changedRatingPlanGroup = $ratingPlan->hasChanged('destinationRateGroupId');
        if (!$changedRatingPlanGroup) {
            return;
        }

        $ratingPlan
            ->getRatingPlanGroup()
            ->assertNoDuplicatedDestinationRateGroups();
    }
}
