<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilter;

use Doctrine\Common\Collections\ArrayCollection;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Ivoz\Provider\Domain\Model\Calendar\Calendar;
use Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackList;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendar;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelSchedule;
use Ivoz\Provider\Domain\Model\MatchList\MatchList;
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
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Return string representation of this entity
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            "%s [%s]",
            $this->getName(),
            parent::__toString()
        );
    }

    protected function sanitizeValues(): void
    {
        $this->sanitizeRouteValues('Holiday');
        $this->sanitizeRouteValues('OutOfSchedule');

        // Clear holiday filtering related fields
        if (!$this->getHolidayEnabled()) {
            $this->replaceCalendars(new ArrayCollection());
            $this->setHolidayLocution(null);
            $this->setHolidayTargetType(null);
            $this->setHolidayNumberCountry(null);
            $this->setHolidayNumberValue(null);
            $this->setHolidayExtension(null);
            $this->setHolidayVoicemail(null);
        }

        // Clear outOfSchedule filtering related fields
        if (!$this->getOutOfScheduleEnabled()) {
            $this->replaceSchedules(new ArrayCollection());
            $this->setOutOfScheduleLocution(null);
            $this->setOutOfScheduleTargetType(null);
            $this->setOutOfScheduleNumberCountry(null);
            $this->setOutOfScheduleNumberValue(null);
            $this->setOutOfScheduleExtension(null);
            $this->setOutOfScheduleVoicemail(null);
        }
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
        if (!$this->getHolidayEnabled()) {
            return null;
        }

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
        if (!$this->getHolidayEnabled()) {
            return null;
        }

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
    }

    /**
     * @return bool scheduleMatched
     */
    public function isOutOfSchedule()
    {
        // Always on schedule if filtering is disabled
        if (!$this->getOutOfScheduleEnabled()) {
            return false;
        }

        $externalCallFilterRelSchedules = $this->getSchedules();

        $outOfScheduleLocution = $this->getOutOfScheduleLocution();
        $outOfScheduleTarget = $this->getOutOfScheduleTarget();

        // If there is no schedules, locutions and targets, ignore OutOfSchedule completely
        if (empty($externalCallFilterRelSchedules) && !$outOfScheduleLocution && !$outOfScheduleTarget) {
            return false;
        }

        // No Schedule == Out Of Schedule
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
    public function getHolidayTarget(): ?string
    {
        return $this->getTarget("Holiday");
    }

    /**
     * Alias for getHolidayTargetType
     *
     * @todo rename holidayTagetType field to holidayRouteType
     */
    public function getHolidayRouteType(): ?string
    {
        return $this->getHolidayTargetType();
    }

    /**
     * Get Target destination for Out of schedule
     *
     * @return null|string
     */
    public function getOutOfScheduleTarget(): ?string
    {
        return $this->getTarget("OutOfSchedule");
    }

    /**
     * Alias for getOutOfScheduleTargetType
     *
     * @todo rename outOfScheduleTargetType field to outOfScheduleRouteType
     */
    public function getOutOfScheduleRouteType(): ?string
    {
        return $this->getOutOfScheduleTargetType();
    }
}
