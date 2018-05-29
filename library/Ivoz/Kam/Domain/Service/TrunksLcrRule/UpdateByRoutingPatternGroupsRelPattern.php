<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRule;

use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;
use Ivoz\Provider\Domain\Service\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternLifecycleEventHandlerInterface;

/**
 * Class UpdateByRoutingPatternGroupsRelPattern
 * @package Ivoz\Kam\Domain\Service\TrunksLcrRule
 * @lifecycle
 */
class UpdateByRoutingPatternGroupsRelPattern implements RoutingPatternGroupsRelPatternLifecycleEventHandlerInterface
{
    /**
     * @var UpdateByOutgoingRouting
     */
    protected $updateByOutgoingRouting;

    /**
     * UpdateByRoutingPatternGroupsRelPattern constructor.
     * @param UpdateByOutgoingRouting $updateByOutgoingRouting
     */
    public function __construct(
        UpdateByOutgoingRouting $updateByOutgoingRouting
    ) {
        $this->updateByOutgoingRouting = $updateByOutgoingRouting;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10,
            self::EVENT_POST_REMOVE => 10,
        ];
    }

    public function execute(RoutingPatternGroupsRelPatternInterface $entity, $isNew)
    {
        // Get all OutgointRoutings that use this routingPattern
        $outgoingRoutings = $entity->getRoutingPatternGroup()->getOutgoingRoutings();

        // Update all outgoing routes if required
        foreach ($outgoingRoutings as $outgoingRouting) {
            $this->updateByOutgoingRouting->execute($outgoingRouting);
        }
    }
}