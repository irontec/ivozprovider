<?php

namespace Ivoz\Provider\Domain\Service\ConditionalRoutesConditionsRelCalendar;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface;

interface ConditionalRoutesConditionsRelCalendarLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(ConditionalRoutesConditionsRelCalendarInterface $entity);
}
