<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilter;

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
            "%s [ddi%d]",
            $this->getName(),
            $this->getId()
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
     * @return true if number matches, false otherwise
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
     * @return true if number matches, false otherwise
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
     * @return Null | HolidayDateInterface
     */
    public function getHolidayDateForToday()
    {
        $externalCallFilterRelCalendars = $this->getCalendars();
        if (empty($externalCallFilterRelCalendars)) {
            return null;
        }

        $company = $this->getCompany();
        $timezone = $company->getDefaultTimezone();
        $time = new \DateTime('now', $timezone);

        /**
         * @var ExternalCallFilterRelCalendar $externalCallFilterRelCalendar
         */
        foreach ($externalCallFilterRelCalendars as $externalCallFilterRelCalendar) {

            /**
             * @var Calendar $calendar
             */
            $calendar = $externalCallFilterRelCalendar->getCalendar();

            $expressionBuilder = Criteria::expr();
            $holidayDateCriteria = Criteria::create()
                ->where(
                    $expressionBuilder->eq(
                        'eventDate',
                        $time
                    )
                );

            $holidayDates = $calendar->getHolidayDates($holidayDateCriteria);
            foreach ($holidayDates as $holidayDate) {
                $eventMatched = $holidayDate
                    ->checkEventOnTime(
                        $time
                    );

                if ($eventMatched) {
                    return $holidayDate;
                }
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
        $time = new \DateTime('now');

        /**
         * @var ExternalCallFilterRelSchedule $externalCallFilterRelSchedule
         */
        foreach ($externalCallFilterRelSchedules as $externalCallFilterRelSchedule) {
            $schedule = $externalCallFilterRelSchedule->getSchedule();
            $company = $schedule->getCompany();
            $timezones = $company->getDefaultTimezone();

            $scheduleMatched = $schedule
                ->checkIsOnTimeRange(
                    $time->format('l'),
                    $time,
                    new \DateTimeZone($timezone = $timezones->getTz())
                );

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
