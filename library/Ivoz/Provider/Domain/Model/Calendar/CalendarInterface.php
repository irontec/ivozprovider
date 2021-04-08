<?php

namespace Ivoz\Provider\Domain\Model\Calendar;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use DateTime;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface;

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

    public function getName(): string;

    public function getCompany(): CompanyInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    public function addHolidayDate(HolidayDateInterface $holidayDate): CalendarInterface;

    public function removeHolidayDate(HolidayDateInterface $holidayDate): CalendarInterface;

    public function replaceHolidayDates(ArrayCollection $holidayDates): CalendarInterface;

    public function getHolidayDates(?Criteria $criteria = null): array;

    public function addCalendarPeriod(CalendarPeriodInterface $calendarPeriod): CalendarInterface;

    public function removeCalendarPeriod(CalendarPeriodInterface $calendarPeriod): CalendarInterface;

    public function replaceCalendarPeriods(ArrayCollection $calendarPeriods): CalendarInterface;

    public function getCalendarPeriods(?Criteria $criteria = null): array;
}
