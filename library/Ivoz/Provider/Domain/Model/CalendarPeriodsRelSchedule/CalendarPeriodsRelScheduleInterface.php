<?php

namespace Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
     * @param \Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface $calendarPeriod | null
     *
     * @return static
     */
    public function setCalendarPeriod(\Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface $calendarPeriod = null);

    /**
     * Get calendarPeriod
     *
     * @return \Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface | null
     */
    public function getCalendarPeriod();

    /**
     * Get schedule
     *
     * @return \Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface
     */
    public function getSchedule();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
