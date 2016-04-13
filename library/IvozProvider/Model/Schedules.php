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
class Schedules extends Raw\Schedules
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    public function checkIsOnTimeRange($dayOfTheWeek, \DateTime $time, \DateTimeZone $timeZone)
    {
        if(!call_user_func(array($this, "get".$dayOfTheWeek))) {
            return false;
        }

        $time = strtotime($time->setTimezone($timeZone)->format('H:i:s'));
        $isInTimeRange = ($time> strtotime($this->getTimeIn())) && ($time< strtotime($this->getTimeout()));
        return $isInTimeRange;
    }

}
