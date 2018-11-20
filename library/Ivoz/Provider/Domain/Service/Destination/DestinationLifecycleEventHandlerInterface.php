<?php

namespace Ivoz\Provider\Domain\Service\Destination;

use Ivoz\Provider\Domain\Model\Destination\DestinationInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;

interface DestinationLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(DestinationInterface $destination);
}
