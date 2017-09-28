<?php

namespace Ivoz\Provider\Domain\Service\OutgoingRouting;

use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;

interface OutgoingRoutingLifecycleEventHandlerInterface
{
    public function execute(OutgoingRoutingInterface $entity);
}