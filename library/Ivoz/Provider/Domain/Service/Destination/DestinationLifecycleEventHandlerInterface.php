<?php

namespace Ivoz\Provider\Domain\Service\Destination;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\Destination\DestinationInterface;

interface DestinationLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(DestinationInterface $destination);
}
