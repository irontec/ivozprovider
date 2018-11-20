<?php

namespace Ivoz\Provider\Domain\Service\RoutingPatternGroupsRelPattern;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;

interface RoutingPatternGroupsRelPatternLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(RoutingPatternGroupsRelPatternInterface $entity);
}
