<?php

namespace Ivoz\Provider\Domain\Service\DestinationRateGroup;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface;

interface DestinationRateGroupLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(DestinationRateGroupInterface $destinationRateGroup);
}
