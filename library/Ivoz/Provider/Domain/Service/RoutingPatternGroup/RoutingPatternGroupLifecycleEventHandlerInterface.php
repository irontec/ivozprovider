<?php

namespace Ivoz\Provider\Domain\Service\RoutingPatternGroup;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface;

interface RoutingPatternGroupLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(RoutingPatternGroupInterface $entity, $isNew);
}