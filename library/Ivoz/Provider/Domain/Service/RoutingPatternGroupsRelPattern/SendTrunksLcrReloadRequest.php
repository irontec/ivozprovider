<?php

namespace Ivoz\Provider\Domain\Service\RoutingPatternGroupsRelPattern;

use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;

class SendTrunksLcrReloadRequest implements RoutingPatternGroupsRelPatternLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private TrunksClientInterface $trunksClient
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY
        ];
    }

    /**
     * @return void
     */
    public function execute(RoutingPatternGroupsRelPatternInterface $routingPatternGroupsRelPattern)
    {
        // Get the routing pattern group
        $routingPatternGroup = $routingPatternGroupsRelPattern->getRoutingPatternGroup();
        
        // Check if the group is used in any OutgoingRouting
        $outgoingRoutings = $routingPatternGroup->getOutgoingRoutings();
        
        // Only reload LCR if the group is actually in use
        if (count($outgoingRoutings) > 0) {
            $this->trunksClient->reloadLcr();
        }
    }
}
