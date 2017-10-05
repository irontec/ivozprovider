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
class Calendars extends Raw\Calendars
{
    public function isHolidayDate($date)
    {
        $holidayDates = $this->getHolidayDates("eventDate='" . $date . "'");
        if (!empty($holidayDates)) {
            return true;
        }
        return false;
    }
}
