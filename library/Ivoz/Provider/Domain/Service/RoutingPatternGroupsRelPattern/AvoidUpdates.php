<?php

namespace Ivoz\Provider\Domain\Service\RoutingPatternGroupsRelPattern;

use Ivoz\Core\Domain\Service\AvoidEntityUpdatesAbstract;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;

class AvoidUpdates extends AvoidEntityUpdatesAbstract implements RoutingPatternGroupsRelPatternLifecycleEventHandlerInterface
{
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => AvoidEntityUpdatesAbstract::PRE_PERSIST_PRIORITY,
        ];
    }
    /**
     * @param RoutingPatternGroupsRelPatternInterface $relPattern
     *
     * @return void
     *@throws \DomainException
     *
     */
    public function execute(RoutingPatternGroupsRelPatternInterface $relPattern)
    {
        $this->assertUnchanged($relPattern);
    }
}
