<?php

namespace Ivoz\Provider\Domain\Service\RoutingPatternGroup;

use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface;

interface RoutingPatternGroupLifecycleEventHandlerInterface
{
    public function execute(RoutingPatternGroupInterface $entity, $isNew);
}