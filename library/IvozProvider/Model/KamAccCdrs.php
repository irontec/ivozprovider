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
class KamAccCdrs extends Raw\KamAccCdrs
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
        // Dont save changelog on this entities
        $this->_saveChanges = false;
    }

    public function tarificate($plan = null)
    {

        $peeringContractId = $this->getPeeringContractId();
        $peeringContractMapper = new \IvozProvider\Mapper\Sql\PeeringContracts();
        $peeringContract = $peeringContractMapper->find($peeringContractId);

        $this->_resetCall();
        if (!is_null($peeringContract)) {
            $this->setExternallyRated($peeringContract->getExternallyRated());
            if ($this->getExternallyRated()) {
                $this->setMetered(0);
                return null;
            }
        }
        // If the peeringContract has been deleted, treat as a normal call (not externally rater)

        $callDate = $this->getStartTimeUtc(true);

        $dst = $this->getCallee();
        if ($this->getDirection() == "inbound") {
            $dst = $this->getCaller();
        }
        $duration = $this->getDuration();

        $company = $this->getCompany();
        $this->_log("[tarificate] Company: ".$company->getName(), \Zend_Log::INFO);

        $companyActivePricingPlans = $company->getCompanyActivePricingPlan($callDate);
        $priceToApply = null;
        foreach ($companyActivePricingPlans as $companyActivePricingPlan) {
            $this->_log("[tarificate] CompanyPricingPlanToApply: ".$companyActivePricingPlan->getPrimaryKey(), \Zend_Log::INFO);

            $pricingPlan = $companyActivePricingPlan->getPricingPlan();
            $matchedPrices = $pricingPlan->getMatchedPrices($dst);

            if (!is_null($matchedPrices)) {
                $companyPricingPlanToApply = $companyActivePricingPlan;
                $planToApply = $pricingPlan;
                $priceToApply = $matchedPrices[0];
                break;
            }
        }

        // Check if any of the pricing plans matches the given dst
        if ($priceToApply) {
            $this->_log("[tarificate] PriceToApply: ".$priceToApply->getPrimaryKey(), \Zend_Log::INFO);
        } else {
            $this->_log("[tarificate] No matched Price found ", \Zend_Log::INFO);
            return null;
        }

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
            ->setMeteringDate($now)
            ->setPricingPlanDetails($data)
            ->setPricingPlanId($planToApply->getPrimaryKey())
            ->setTargetPatternId($matchedPattern->getPrimaryKey())
            ->setMetered(1)
            ->setPrice($cost);

        return $this;
    }

    public function isBounced() {
        if ($this->getBounced() == 'yes') {
            return true;
        }

        return false;
    }

    public function setPricingPlanDetails($data)
    {
        if (is_array($data)) {
            $pricingPlanDetails = array();

            if ($this->getPricingPlanDetails() && (strpos($this->getPricingPlanDetails(), '[') !== false)) {
                $pricingPlanDetails = \Zend_Json::decode($this->getPricingPlanDetails());
            } else if ($this->getPricingPlanDetails()) {
                $pricingPlanDetails = array(\Zend_Json::decode($this->getPricingPlanDetails()));
            }

            $data['meteringDate'] = $this->getMeteringDate();

            $pricingPlanDetails[count($pricingPlanDetails)] = $data;

            $data = \Zend_Json::encode($pricingPlanDetails);
        }

        return parent::setPricingPlanDetails($data);
    }

    protected function _log($message, $priority)
    {
        $this->_logger->log("[Model][ParsedCDRs]".$message, $priority);
    }

    protected function _resetCall ()
    {
        $this
            ->setMetered(0)
            ->setMeteringDate(null)
            ->setPricingPlanId(null)
            ->setTargetPatternId(null)
            ->setPrice(null)
            ->setExternallyRated(null);

        return $this;
    }

}
