<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesCondition;

use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface;
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
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNumberValueE164()
    {
        return
            $this->getNumberCountry()->getCountryCode() .
            $this->getNumberValue();
    }

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
        $date = $datetime->format('Y-m-d');
        foreach ($calendars as $calendar) {
            if ($calendar->isHolidayDate($date)) {
                return true;
            }
        }
        return false;
    }

}

