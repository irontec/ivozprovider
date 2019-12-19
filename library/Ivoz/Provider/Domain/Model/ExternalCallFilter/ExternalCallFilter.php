<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilter;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Ivoz\Provider\Domain\Model\Calendar\Calendar;
use Ivoz\Provider\Domain\Model\Calendar\CalendarInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackList;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendar;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelSchedule;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchList;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Traits\RoutableTrait;

/**
 * ExternalCallFilter
 */
class ExternalCallFilter extends ExternalCallFilterAbstract implements ExternalCallFilterInterface
{
    use ExternalCallFilterTrait;
    use RoutableTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return string representation of this entity
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            "%s [%s]",
            $this->getName(),
            parent::__toString()
        );
    }

    protected function sanitizeValues()
    {
        $this->sanitizeRouteValues('Holiday');
        $this->sanitizeRouteValues('OutOfSchedule');
    }

    /**
     * Check if the given number matches External Filter black list
     * @param string $origin in E164 form
     * @return bool true if number matches, false otherwise
     */
    public function isBlackListed($origin)
    {
        $blackLists = $this->getBlackLists();

        /**
         * @var ExternalCallFilterBlackList $list
         */
        foreach ($blackLists as $list) {
            /**
             * @var MatchList $matchList
             */
            $matchList = $list->getMatchList();
            if ($matchList->numberMatches($origin)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if the given number matches External Filter white list
     * @param string $origin in E164 form
     * @return bool true if number matches, false otherwise
     */
    public function isWhitelisted($origin)
    {
        $whiteLists = $this->getWhiteLists();
        foreach ($whiteLists as $list) {
            /**
             * @var MatchList $matchList
             */
            $matchList = $list->getMatchList();
            if ($matchList->numberMatches($origin)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return null | \Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface
     */
    public function getHolidayDateForToday()
    {
        $externalCallFilterRelCalendars = $this->getCalendars();
        if (empty($externalCallFilterRelCalendars)) {
            return null;
        }

        $company = $this->getCompany();
        $timezone = $company->getDefaultTimezone();
        $now = new \DateTime('now', new \DateTimeZone($timezone->getTz()));

        foreach ($externalCallFilterRelCalendars as $externalCallFilterRelCalendar) {
            $calendar = $externalCallFilterRelCalendar->getCalendar();

            $holidayDate = $calendar->getHolidayDate($now);
            if ($holidayDate) {
                return $holidayDate;
            }
        }

        return null;
    }

    public function getCalendarPeriodForToday()
    {
        $externalCallFilterRelCalendars = $this->getCalendars();
        if (empty($externalCallFilterRelCalendars)) {
            return null;
        }

        $company = $this->getCompany();
        $timezone = $company->getDefaultTimezone();
        $now = new \DateTime('now', new \DateTimeZone($timezone->getTz()));

        /** @var ExternalCallFilterRelCalendar $externalCallFilterRelCalendar */
        foreach ($externalCallFilterRelCalendars as $externalCallFilterRelCalendar) {
            $calendar = $externalCallFilterRelCalendar->getCalendar();

            // Get calendar events for current day
            $criteria = [
                ['startDate', 'lte', $now],
                ['endDate', 'gte', $now],
            ];

            $calendarPeriods = $calendar->getCalendarPeriods(
                CriteriaHelper::fromArray($criteria)
            );

            if (!empty($calendarPeriods)) {
                // Return the first calendar period that matched
                return array_shift($calendarPeriods);
            }
        }

        return null;
    }

    /**
     * @return bool scheduleMatched
     */
    public function isOutOfSchedule()
    {
        $externalCallFilterRelSchedules = $this->getSchedules();
        if (empty($externalCallFilterRelSchedules)) {
            return true;
        }

        $scheduleMatched = false;

        /**
         * @var ExternalCallFilterRelSchedule $externalCallFilterRelSchedule
         */
        foreach ($externalCallFilterRelSchedules as $externalCallFilterRelSchedule) {
            $schedule = $externalCallFilterRelSchedule->getSchedule();
            $company = $schedule->getCompany();
            $timezone = $company->getDefaultTimezone();
            $now = new \DateTime('now', new \DateTimeZone($timezone->getTz()));

            $scheduleMatched = $schedule
                ->isOnSchedule($now);

            if ($scheduleMatched) {
                break;
            }
        }

        return !$scheduleMatched;
    }

    /**
     * Get the holiday numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getHolidayNumberValueE164()
    {
        if (!$this->getHolidayNumberCountry()) {
            return "";
        }

        return
            $this->getHolidayNumberCountry()->getCountryCode() .
            $this->getHolidayNumberValue();
    }

    /**
     * Get the out of schedule numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getOutOfScheduleNumberValueE164()
    {
        if (!$this->getOutOfScheduleNumberCountry()) {
            return "";
        }

        return
            $this->getOutOfScheduleNumberCountry()->getCountryCode() .
            $this->getOutOfScheduleNumberValue();
    }

    /**
     * Get Target destination for Holidays
     *
     * @return null|string
     */
    public function getHolidayTarget()
    {
        return $this->getTarget("Holiday");
    }

    /**
     * Alias for getHolidayTargetType
     *
     * @todo rename holidayTagetType field to holidayRouteType
     */
    public function getHolidayRouteType()
    {
        return $this->getHolidayTargetType();
    }

    /**
     * Get Target destination for Out of schedule
     *
     * @return null|string
     */
    public function getOutOfScheduleTarget()
    {
        return $this->getTarget("OutOfSchedule");
    }

    /**
     * Alias for getOutOfScheduleTargetType
     *
     * @todo rename outOfScheduleTargetType field to outOfScheduleRouteType
     */
    public function getOutOfScheduleRouteType()
    {
        return $this->getOutOfScheduleTargetType();
    }
}
