<?php

namespace Ivoz\Provider\Domain\Model\Calendar;

use DateTime;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* CalendarInterface
*/
interface CalendarInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Check if the given day is registered as Holiday
     *
     * @param \DateTime $datetime
     * @return bool
     */
    public function isHolidayDate(DateTime $datetime);

    /**
     * Return the first HolidayDate matching the given date
     *
     * @param \DateTime $dateTime
     * @return \Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface|null
     */
    public function getHolidayDate(DateTime $dateTime);

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add holidayDate
     *
     * @param HolidayDateInterface $holidayDate
     *
     * @return static
     */
    public function addHolidayDate(HolidayDateInterface $holidayDate): CalendarInterface;

    /**
     * Remove holidayDate
     *
     * @param HolidayDateInterface $holidayDate
     *
     * @return static
     */
    public function removeHolidayDate(HolidayDateInterface $holidayDate): CalendarInterface;

    /**
     * Replace holidayDates
     *
     * @param ArrayCollection $holidayDates of HolidayDateInterface
     *
     * @return static
     */
    public function replaceHolidayDates(ArrayCollection $holidayDates): CalendarInterface;

    /**
     * Get holidayDates
     * @param Criteria | null $criteria
     * @return HolidayDateInterface[]
     */
    public function getHolidayDates(?Criteria $criteria = null): array;

    /**
     * Add calendarPeriod
     *
     * @param CalendarPeriodInterface $calendarPeriod
     *
     * @return static
     */
    public function addCalendarPeriod(CalendarPeriodInterface $calendarPeriod): CalendarInterface;

    /**
     * Remove calendarPeriod
     *
     * @param CalendarPeriodInterface $calendarPeriod
     *
     * @return static
     */
    public function removeCalendarPeriod(CalendarPeriodInterface $calendarPeriod): CalendarInterface;

    /**
     * Replace calendarPeriods
     *
     * @param ArrayCollection $calendarPeriods of CalendarPeriodInterface
     *
     * @return static
     */
    public function replaceCalendarPeriods(ArrayCollection $calendarPeriods): CalendarInterface;

    /**
     * Get calendarPeriods
     * @param Criteria | null $criteria
     * @return CalendarPeriodInterface[]
     */
    public function getCalendarPeriods(?Criteria $criteria = null): array;

}
