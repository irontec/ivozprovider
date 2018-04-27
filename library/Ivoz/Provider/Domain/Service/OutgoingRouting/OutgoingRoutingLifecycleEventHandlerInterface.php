<?php

namespace Ivoz\Provider\Domain\Service\OutgoingRouting;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;

interface OutgoingRoutingLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(OutgoingRoutingInterface $entity);
}