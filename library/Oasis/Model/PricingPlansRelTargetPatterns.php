<?php

/**
 * Application Model
 *
 * @package Oasis\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * [entity]
 *
 * @package Oasis\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace Oasis\Model;
class PricingPlansRelTargetPatterns extends Raw\PricingPlansRelTargetPatterns
{
    protected $_duration = null;

    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    public function getCost($duration = null)
    {
        $this->_duration = $duration;

        if (is_null($this->_duration)) {
            $this->_logger->log("Duration not setted", \Zend_Log::ERR);
            return null;
        }

        $connectionCharge = $this->getConnectionCharge();
        $periodTime = $this->getPeriodTime();
        $periodCharge = $this->getPerPeriodCharge();
        if ($periodTime != 0){
            $factor = ceil($this->_duration/$periodTime);
        } else {
            $factor = 0;
        }

        return $connectionCharge + ($factor*$periodCharge);

    }
}
