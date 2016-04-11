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
 *
 *
 * @package Oasis\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace Oasis\Model;
class ParsedCDRs extends Raw\ParsedCDRs
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    public function tarificate($plan = null)
    {
        $callDate = $this->getCalldate(true);
        $dst = $this->getDst();
        $duration = $this->getDstDuration();

        $company = $this->getCompany();
        $this->_log("[tarificate] Company: ".$company->getName(), \Zend_Log::INFO);

        $companyActivePricingPlans = $company->getCompanyActivePricingPlan($callDate);
        if (is_null($companyActivePricingPlans)) {
            $this->_log("[tarificate] No Pricing Plan found ", \Zend_Log::INFO);
            return null;
        }

        $companyPricingPlanToApply = $companyActivePricingPlans[0];
        $this->_log("[tarificate] CompanyPricingPlanToApply: ".$companyPricingPlanToApply->getPrimaryKey(), \Zend_Log::INFO);

        $planToApply = $companyPricingPlanToApply->getPricingPlan();
        $this->_log("[tarificate] PlanToApply: ".$planToApply->getPrimaryKey(), \Zend_Log::INFO);

        $matchedPrices = $planToApply->getMatchedPrices($dst);
        if (is_null($matchedPrices)) {
            $this->_log("[tarificate] No matched Price found ", \Zend_Log::INFO);
            return null;
        }

        $priceToApply = $matchedPrices[0];
        $this->_log("[tarificate] PriceToApply: ".$priceToApply->getPrimaryKey(), \Zend_Log::INFO);

        $matchedPattern = $priceToApply->getTargetPattern();
        $this->_log("[tarificate] MatchedPattern: ".$matchedPattern->getName(), \Zend_Log::INFO);

        $cost = $priceToApply->getCost($duration);
        $this->_log("[tarificate] Cost: ".$cost, \Zend_Log::INFO);

        $data = array(
            "Company" => $company->toArray(),
            "Plan" => $planToApply->toArray(),
            "CompanyPlan" => $companyPricingPlanToApply->toArray(),
            "Price" => $priceToApply->toArray(),
            "Pattern" => $matchedPattern->toArray(),
            "Cost" => $cost
        );

        $now = new \Zend_Date();
        $now->setTimezone("UTC");

        $this
            ->setPricingPlanDetails(json_encode($data))
            ->setMetered(1)
            ->setMeteringDate($now)
            ->setPricingPlanId($planToApply->getPrimaryKey())
            ->setTargetPatternId($matchedPattern->getPrimaryKey())
            ->setPrice($cost);

        return $this;
    }

    protected function _log($message, $priority)
    {
        $this->_logger->log("[Model][ParsedCDRs]".$message, $priority);
    }

}
