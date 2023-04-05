<?php

namespace Ivoz\Provider\Domain\Service\ExternalCallFilterRelSchedule;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleInterface;

interface ExternalCallFilterRelScheduleLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(ExternalCallFilterRelScheduleInterface $relSchedule);
}
