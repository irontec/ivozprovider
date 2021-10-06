<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingProfile;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface;
use Ivoz\Provider\Domain\Service\RatingProfile\RatingProfileLifecycleEventHandlerInterface;

class CreatedByCarrierRatingProfile implements RatingProfileLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = UpdateByRatingProfile::POST_PERSIST_PRIORITY + 1;

    public function __construct(
        private EntityTools $entityTools,
        private CreatedByOutgoingRoutingRelCarrier $createByOutgoingRoutingRelCarrier
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * Update TpRatingPlan for Carrier OutgoingRoutings
     *
     * @param RatingProfileInterface $ratingProfile
     *
     * @return void
     */
    public function execute(RatingProfileInterface $ratingProfile)
    {
        $carrier = $ratingProfile->getCarrier();

        if (is_null($carrier)) {
            return;
        }

        $outgoingRoutingRelCarriers = $carrier->getOutgoingRoutingsRelCarriers();
        foreach ($outgoingRoutingRelCarriers as $outgoingRoutingRelCarrier) {
            $this->createByOutgoingRoutingRelCarrier->execute($outgoingRoutingRelCarrier);
        }
    }
}
