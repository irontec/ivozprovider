<?php

namespace Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface;
use Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface;

/**
* CalendarPeriodsRelScheduleInterface
*/
interface CalendarPeriodsRelScheduleInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function setCalendarPeriod(?CalendarPeriodInterface $calendarPeriod = null): static;

    public function getCalendarPeriod(): ?CalendarPeriodInterface;

    public function getSchedule(): ScheduleInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
