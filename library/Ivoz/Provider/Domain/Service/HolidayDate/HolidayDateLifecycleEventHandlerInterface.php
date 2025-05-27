<?php

namespace Ivoz\Provider\Domain\Service\HolidayDate;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface;

interface HolidayDateLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(HolidayDateInterface $holidayDate);
}
