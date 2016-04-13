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
class Brands extends Raw\Brands
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    public function getActivePricingPlans($date = null)
    {
        $activePricingPlans = array();
        foreach ($this->getCompanies() as $company) {
            $this->_logger->log("[Brands] Company: ".$company->getName(), \Zend_Log::DEBUG);
            if (!is_null($company->getActivePricingPlan($date))) {
                $this->_logger->log("[Brands] Active Pricing Plan is NOT null.", \Zend_Log::DEBUG);
                $activePricingPlans[] = $company->getActivePricingPlan();
            }
        }
        return $activePricingPlans;
    }

    public function getActivePrincingPlansIds($date = null)
    {
        $activePricingPlansIds = array();
        foreach ($this->getActivePricingPlans($date) as $activePricingPlan) {
            $activePricingPlansIds[] = $activePricingPlan->getPrimaryKey();
        }
        return $activePricingPlansIds;
    }
}
