<?php

namespace Ivoz\Provider\Domain\Service\ResidentialDevice;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;

interface ResidentialDeviceLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(ResidentialDeviceInterface $entity);
}
