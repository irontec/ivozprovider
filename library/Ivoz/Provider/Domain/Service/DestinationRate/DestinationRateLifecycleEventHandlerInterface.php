<?php

namespace Ivoz\Provider\Domain\Service\DestinationRate;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface;

interface DestinationRateLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(DestinationRateInterface $entity);
}
