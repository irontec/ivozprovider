<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRule;

use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Service\OutgoingRouting\OutgoingRoutingLifecycleEventHandlerInterface;

/**
 * Class UpdateByOutgoingRouting
 * @package Ivoz\Kam\Domain\Service\TrunksLcrRule
 */
class UpdateByOutgoingRoutingBinding implements OutgoingRoutingLifecycleEventHandlerInterface
{
    /**
     * @var UpdateByOutgoingRouting
     */
    protected $updateByOutgoingRouting;

    public function __construct(
        UpdateByOutgoingRouting $updateByOutgoingRouting
    ) {
        $this->updateByOutgoingRouting = $updateByOutgoingRouting;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    /**
     * @param OutgoingRoutingInterface $outgoingRouting
     * @throws \Exception
     */
    public function execute(OutgoingRoutingInterface $outgoingRouting)
    {
        $this->updateByOutgoingRouting->execute($outgoingRouting);
    }
}