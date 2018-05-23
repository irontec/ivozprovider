<?php

namespace Ivoz\Provider\Domain\Service\RoutingPattern;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;

interface RoutingPatternLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(RoutingPatternInterface $entity, $isNew);
}