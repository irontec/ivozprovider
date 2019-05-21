<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingProfile;

use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface;
use Ivoz\Provider\Domain\Service\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierLifecycleEventHandlerInterface;

/**
 * Class CreatedByOutgoingRoutingRelCarrierBinding
 *
 * @package Ivoz\Cgr\Domain\Service\TpRatingPlan
 */
class CreatedByOutgoingRoutingRelCarrierBinding implements OutgoingRoutingRelCarrierLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var CreatedByOutgoingRoutingRelCarrier
     */
    protected $createByOutgoingRoutingRelCarrier;

    /**
     * CreatedByOutgoingRoutingRelCarrierBinding constructor.
     *
     * @param CreatedByOutgoingRoutingRelCarrier $createByOutgoingRouting
     */
    public function __construct(
        CreatedByOutgoingRoutingRelCarrier $createByOutgoingRouting
    ) {
        $this->createByOutgoingRoutingRelCarrier = $createByOutgoingRouting;
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
    public function execute(OutgoingRoutingRelCarrierInterface $outgoingRoutingRelCarrier)
    {
        $this->createByOutgoingRoutingRelCarrier->execute($outgoingRoutingRelCarrier);
    }
}
