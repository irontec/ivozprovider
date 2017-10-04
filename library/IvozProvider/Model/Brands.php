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

    public function getLanguageCode()
    {
        $language = $this->getLanguage();
        if (!$language) {
            return "en";
        }
        return $language->getIden();
    }

    public function willUseExternallyRating($company, $destination=null)
    {
        $outgoingRoutings = $company->getOutgoingRoutings();

        foreach ($outgoingRoutings as $outgoingRouting) {
            if (! $outgoingRouting->getPeeringContract()->getExternallyRated()) {
                return false;
            }
        }

        // This call will be rated using externally rater
        return true;
    }

    /**
     * Get the size in bytes used by the recordings on this brand
     *
     */
    public function getRecordingsDiskUsage()
    {
        // Get the sum of all the companies usages
        $total = 0;
        foreach ($this->getCompanies() as $company) {
            $total += $company->getRecordingsDiskUsage();
        }
        return $total;
    }

    /**
     * Get the size in bytes for disk usage limit on this brand
     */
    public function getRecordingsLimit()
    {
        return $this->getRecordingsLimitMB() * 1024 * 1024;
    }

    public function hasFeature($featureId) {
        foreach ($this->getFeatures() as $feature) {
            if ($feature->getId() == $featureId) {
                return true;
            }
        }

        return false;
    }

    public function hasFeatureByFeatureIden($featureiden)
    {
        foreach ($this->getFeatures() as $feature) {
            if ($feature->getIden() == $featureiden) {
                return true;
            }
        }

        return false;
    }

    public function getFeatures()
    {
        $features = array();

        foreach ($this->getFeaturesRelBrands() as $relFeature) {
            array_push($features, $relFeature->getFeature());
        }

        return $features;
    }
}
