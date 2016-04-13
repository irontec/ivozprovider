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
 * [entity]
 *
 * @package IvozProvider\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Model;
class ExternalCallFilters extends Raw\ExternalCallFilters
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    /**
     * @return \IvozProvider\Model\Raw\holidayDates or false
     */
    public function getHolidayDateForToday()
    {
        $externalCallFilterRelCalendars = $this->getExternalCallFilterRelCalendars();
        if(is_null($externalCallFilterRelCalendars)) {
            return null;
        }
        $datetime = new \DateTime("now");
        $date = $datetime->format('Y-m-d');
        foreach($externalCallFilterRelCalendars as $externalCallFilterRelCalendar) {
            $calendar = $externalCallFilterRelCalendar->getCalendar();
            $holidayDates = $calendar->getHolidayDates("eventDate='".$date."'");
            if(!empty($holidayDates)) {
                return $holidayDates[0];
            }
        }
        return null;
    }

    /**
     * @return bool scheduleMatched
     */
    public function isOutOfSchedule()
    {
        $externalCallFilterRelSchedules = $this->getExternalCallFilterRelSchedules();
        if(is_null($externalCallFilterRelSchedules)) {
            return true;
        }
        $scheduleMatched = false;
        $time = new \DateTime("now");
        foreach($externalCallFilterRelSchedules as $externalCallFilterRelSchedule) {
            $schedule = $externalCallFilterRelSchedule->getSchedule();
            $company = $schedule->getCompany();
            $timezones = $company->getDefaultTimezone();

            $scheduleMatched = $schedule->checkIsOnTimeRange($time->format('l'), $time, new \DateTimeZone($timezone = $timezones->getTz()));
            if($scheduleMatched) {
                break;
            }
        }
        return $scheduleMatched;
    }

}
