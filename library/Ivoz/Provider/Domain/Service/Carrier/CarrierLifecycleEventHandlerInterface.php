<?php

namespace Ivoz\Provider\Domain\Service\Carrier;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;

interface CarrierLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(CarrierInterface $entity);
}
