<?php

namespace Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule;

use Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface;
use Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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

    /**
     * Set calendarPeriod
     *
     * @param CalendarPeriodInterface | null
     *
     * @return static
     */
    public function setCalendarPeriod(?CalendarPeriodInterface $calendarPeriod = null): CalendarPeriodsRelScheduleInterface;

    /**
     * Get calendarPeriod
     *
     * @return CalendarPeriodInterface | null
     */
    public function getCalendarPeriod(): ?CalendarPeriodInterface;

    /**
     * Get schedule
     *
     * @return ScheduleInterface
     */
    public function getSchedule(): ScheduleInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
