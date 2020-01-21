<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesCondition;

use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLockInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface;
use Ivoz\Provider\Domain\Traits\RoutableTrait;

class ConditionalRoutesCondition extends ConditionalRoutesConditionAbstract implements ConditionalRoutesConditionInterface
{
    use ConditionalRoutesConditionTrait;
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
     * {@inheritDoc}
     */
    protected function sanitizeValues()
    {
        // Set Routable options to avoid naming collision
        $this->routeTypes = [
            'ivr',
            'huntGroup',
            'user',
            'conferenceRoom',
            'number',
            'friend',
            'queue',
            'voicemail',
            'extension',
        ];

        $this->sanitizeRouteValues();
    }

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNumberValueE164()
    {
        if (!$this->getNumberCountry()) {
            return "";
        }

        return
            $this->getNumberCountry()->getCountryCode() .
            $this->getNumberValue();
    }

    /**
     * Return MatchLists associated with this condition
     *
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface[]
     */
    public function getMatchLists()
    {
        /** @var ConditionalRoutesConditionsRelMatchlistInterface[] $rels */
        $rels = $this->getRelMatchLists();
        $matchLists = [];
        foreach ($rels as $rel) {
            $matchLists[] = $rel->getMatchList();
        }
        return $matchLists;
    }

    /**
     * Return Schedules associated with this condition
     *
     * @return \Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface[]
     */
    public function getSchedules()
    {
        /** @var ConditionalRoutesConditionsRelScheduleInterface[] $rels */
        $rels = $this->getRelSchedules();
        $schedules = [];
        foreach ($rels as $rel) {
            $schedules[] = $rel->getSchedule();
        }
        return $schedules;
    }

    /**
     * Return Calendars associated with this condition
     *
     * @return \Ivoz\Provider\Domain\Model\Calendar\CalendarInterface[]
     */
    public function getCalendars()
    {
        /** @var ConditionalRoutesConditionsRelCalendarInterface[] $rels */
        $rels = $this->getRelCalendars();
        $calendars = [];
        foreach ($rels as $rel) {
            $calendars[] = $rel->getCalendar();
        }
        return $calendars;
    }

    /**
     * Return Route Locks associated with this condition
     *
     * @return \Ivoz\Provider\Domain\Model\RouteLock\RouteLockInterface[]
     */
    public function getRouteLocks()
    {
        /** @var ConditionalRoutesConditionsRelRouteLockInterface[] $rels */
        $rels = $this->getRelRouteLocks();
        $routeLocks = [];
        foreach ($rels as $rel) {
            $routeLocks[] = $rel->getRouteLock();
        }
        return $routeLocks;
    }

    /**
     * Checks if this condition mathes the given origin
     *
     * @param string $number in E.164 format
     * @return bool true if condition matches
     */
    public function matchesOrigin($number)
    {
        $matchLists = $this->getMatchLists();
        if (empty($matchLists)) {
            return true;
        }
        foreach ($matchLists as $matchList) {
            if ($matchList->numberMatches($number)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks if current time in Company's timezone matches condition schedules
     *
     * @return bool true if condition matches
     */
    public function matchesSchedule()
    {
        $schedules = $this->getSchedules();
        if (empty($schedules)) {
            return true;
        }
        $conditionalRoute = $this->getConditionalRoute();
        $company = $conditionalRoute->getCompany();

        // Current time in company timezone
        $timezone = $company->getDefaultTimezone();
        $time =  new \DateTime("now", new \DateTimeZone($timezone->getTz()));
        foreach ($schedules as $schedule) {
            if ($schedule->isOnSchedule($time)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks if today is holiday in condition calendars
     *
     * @return bool true if condition matches
     */
    public function matchesCalendar()
    {
        $calendars = $this->getCalendars();
        if (empty($calendars)) {
            return true;
        }

        // Current day in company timezone
        $conditionalRoute = $this->getConditionalRoute();
        $company = $conditionalRoute->getCompany();

        // Current time in company timezone
        $timezone = $company->getDefaultTimezone();
        $datetime = new \DateTime("now", new \DateTimeZone($timezone->getTz()));

        foreach ($calendars as $calendar) {
            if ($calendar->isHolidayDate($datetime)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks if any of the Locks is open
     *
     * @return bool true if condition matches
     */
    public function matchesRouteLock()
    {
        $routeLocks = $this->getRouteLocks();

        if (empty($routeLocks)) {
            return true;
        }

        foreach ($routeLocks as $routeLock) {
            if ($routeLock->isOpen()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Return a string representation of matching conditions
     *
     * @return string
     */
    public function getMatchData()
    {
        $matchData = [];

        $matchLists = $this->getMatchLists();
        foreach ($matchLists as $matchList) {
            $matchData[] = $matchList->getName();
        }

        $schedules = $this->getSchedules();
        foreach ($schedules as $schedule) {
            $matchData[] = $schedule->getName();
        }

        $calendars = $this->getCalendars();
        foreach ($calendars as $calendar) {
            $matchData[] = $calendar->getName();
        }

        $routeLocks = $this->getRouteLocks();
        foreach ($routeLocks as $routeLock) {
            $matchData[] = $routeLock->getName();
        }

        return implode(",", $matchData);
    }
}
