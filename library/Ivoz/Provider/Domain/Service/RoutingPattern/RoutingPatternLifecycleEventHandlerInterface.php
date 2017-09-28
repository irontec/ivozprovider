<?php

namespace Ivoz\Provider\Domain\Service\RoutingPattern;

use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;

interface RoutingPatternLifecycleEventHandlerInterface
{
    public function execute(RoutingPatternInterface $entity, $isNew);
}