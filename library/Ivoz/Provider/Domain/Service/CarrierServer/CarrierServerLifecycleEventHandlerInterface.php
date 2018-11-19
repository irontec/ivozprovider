<?php

namespace Ivoz\Provider\Domain\Service\CarrierServer;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface;

interface CarrierServerLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(CarrierServerInterface $carrierServer);
}
