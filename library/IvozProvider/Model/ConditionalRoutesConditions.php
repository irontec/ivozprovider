<?php

/**
 * Application Model
 *
 * @package IvozProvider\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * [entity][rest]
 *
 * @package IvozProvider\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Model;
class ConditionalRoutesConditions extends Raw\ConditionalRoutesConditions
{
    public function getMatchLists()
    {
        $rels = $this->getConditionalRoutesConditionsRelMatchLists();
        $matchLists = [];
        foreach ($rels as $rel) {
            $matchLists[] = $rel->getMatchList();
        }
        return $matchLists;
    }

    public function getSchedules()
    {
        $rels = $this->getConditionalRoutesConditionsRelSchedules();
        $schedules = [];
        foreach ($rels as $rel) {
            $schedules[] = $rel->getSchedule();
        }
        return $schedules;
    }

    public function getCalendars()
    {
        $rels = $this->getConditionalRoutesConditionsRelCalendars();
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
        $datetime = new \DateTimeZone($timezone->getTz());
        $date = $datetime->format('Y-m-d');

        foreach ($calendars as $calendar) {
            if ($calendar->isHolidayDate($date)) {
                return true;
            }
        }

        return false;
    }
}
