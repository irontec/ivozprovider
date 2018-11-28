<?php

namespace Ivoz\Provider\Domain\Service\DestinationRate;

use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;

interface DestinationRateLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(DestinationRateInterface $entity);
}
