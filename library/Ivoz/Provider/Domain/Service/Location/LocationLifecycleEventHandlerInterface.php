<?php

namespace Ivoz\Provider\Domain\Service\Location;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\Location\LocationInterface;

interface LocationLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(LocationInterface $location): void;
}
