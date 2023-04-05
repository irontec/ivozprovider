<?php

namespace Ivoz\Provider\Domain\Service\ExternalCallFilterRelCalendar;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarInterface;

interface ExternalCallFilterRelCalendarLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(ExternalCallFilterRelCalendarInterface $relCalendar);
}
