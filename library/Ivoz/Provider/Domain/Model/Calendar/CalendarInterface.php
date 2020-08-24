<?php

namespace Ivoz\Provider\Domain\Model\Calendar;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

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
    public function isHolidayDate(\DateTime $datetime);

    /**
     * Return the first HolidayDate matching the given date
     *
     * @param \DateTime $dateTime
     * @return \Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface|null
     */
    public function getHolidayDate(\DateTime $dateTime);

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add holidayDate
     *
     * @param \Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface $holidayDate
     *
     * @return static
     */
    public function addHolidayDate(\Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface $holidayDate);

    /**
     * Remove holidayDate
     *
     * @param \Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface $holidayDate
     */
    public function removeHolidayDate(\Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface $holidayDate);

    /**
     * Replace holidayDates
     *
     * @param ArrayCollection $holidayDates of Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface
     * @return static
     */
    public function replaceHolidayDates(ArrayCollection $holidayDates);

    /**
     * Get holidayDates
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface[]
     */
    public function getHolidayDates(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add calendarPeriod
     *
     * @param \Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface $calendarPeriod
     *
     * @return static
     */
    public function addCalendarPeriod(\Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface $calendarPeriod);

    /**
     * Remove calendarPeriod
     *
     * @param \Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface $calendarPeriod
     */
    public function removeCalendarPeriod(\Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface $calendarPeriod);

    /**
     * Replace calendarPeriods
     *
     * @param ArrayCollection $calendarPeriods of Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface
     * @return static
     */
    public function replaceCalendarPeriods(ArrayCollection $calendarPeriods);

    /**
     * Get calendarPeriods
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface[]
     */
    public function getCalendarPeriods(\Doctrine\Common\Collections\Criteria $criteria = null);
}
