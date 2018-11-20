<?php
namespace Ivoz\Provider\Domain\Service\RoutingPatternGroupsRelPattern;

use Ivoz\Core\Domain\Service\AvoidEntityUpdatesAbstract;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;

class AvoidUpdates extends AvoidEntityUpdatesAbstract implements RoutingPatternGroupsRelPatternLifecycleEventHandlerInterface
{
    public function __construct()
    {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => AvoidEntityUpdatesAbstract::PRE_PERSIST_PRIORITY,
        ];
    }

    /**
     * @param RoutingPatternGroupsRelPatternInterface $entity
     * @throws \DomainException
     */
    public function execute(RoutingPatternGroupsRelPatternInterface $entity)
    {
        $this->assertUnchanged($entity);
    }
}
