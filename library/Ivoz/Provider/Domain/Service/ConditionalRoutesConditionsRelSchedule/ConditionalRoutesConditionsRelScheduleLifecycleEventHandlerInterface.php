<?php

namespace Ivoz\Provider\Domain\Service\ConditionalRoutesConditionsRelSchedule;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface;

interface ConditionalRoutesConditionsRelScheduleLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(ConditionalRoutesConditionsRelScheduleInterface $relSchedule);
}
