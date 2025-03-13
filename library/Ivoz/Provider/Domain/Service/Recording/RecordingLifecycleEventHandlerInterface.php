<?php

namespace Ivoz\Provider\Domain\Service\Recording;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\Recording\RecordingInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;

interface RecordingLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(RecordingInterface $recording): void;
}
