<?php

namespace Ivoz\Provider\Domain\Service\OutgoingRoutingRelCarrier;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface;

interface OutgoingRoutingRelCarrierLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(OutgoingRoutingRelCarrierInterface $relCarrier);
}
