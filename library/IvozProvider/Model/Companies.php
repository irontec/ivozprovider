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

class Companies extends Raw\Companies
{
    const EMPTY_DOMAIN_EXCEPTION = 2001;

    /**
     * Available Company Types
     */
    const VPBX      = 'vpbx';
    const RETAIL    = "retail";

    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {}

    /**
     *
     * @param string $exten
     * @return string
     */
    public function getTypeCall($exten)
    {
        $extensions = $this->getExtensions("number='" . $exten . "'");
        $extension = array_shift($extensions);

        if (empty($extension)) {
            return "shared-external";
        }
        return "shared-" . $extension->getRouteType();
    }

    public function getExtension($exten)
    {
        $extensions = $this->getExtensions("number='" . $exten . "'");
        return array_shift($extensions);
    }

    public function getDDI($ddieE164)
    {
        $ddis = $this->getDDIs("DDIE164='" . $ddieE164 . "'");
        return array_shift($ddis);
    }


    public function getFriend($exten)
    {
        $friends = $this->getFriends(null, "priority ASC");
        foreach ($friends as $friend) {
            if ($friend->checkExtension($exten)) {
                return $friend;
            }
        }
        return null;
    }

    public function getService($exten)
    {
        $code = substr($exten, 1);

        // Get company services
        $services = $this->getCompanyServices();

        // Look for an exact match in service name
        foreach ($services as $service) {
            if ($service->getService()->getExtraArgs())
                continue;
            if (strlen($code) != strlen($service->getCode()))
                continue;
            if ($code == $service->getCode())
                return $service;
        }

        // Look for a partial service match
        foreach ($services as $service) {
            if (!$service->getService()->getExtraArgs())
                continue;
            if (!strncmp($code, $service->getCode(), strlen($service->getCode())))
                return $service;
        }

        // Extension doesn't match any service
        return null;
    }

    public function getTerminal($name)
    {
        $terminals = $this->getTerminals("name='" . $name . "'");
        return array_shift($terminals);
    }

    public function getCompanyActivePricingPlan($date = null)
    {
        if (is_null($date)) {
            $date = new \Zend_Date();
            $date->setTimezone("UTC");
        }

        $dateTime = $date->toString('yyyy-MM-dd HH:mm:ss');

        $where = "validFrom <= '" . $dateTime . "' AND validTo >= '" . $dateTime .
                         "' AND metric > 0";
        $this->_logger->log("[Model][Companies] Condition: " . $where,
                        \Zend_Log::DEBUG);
        $order = "metric asc";
        $companyPricingPlans = $this->getPricingPlansRelCompanies($where,
                        $order);
        if (empty($companyPricingPlans)) {
            $this->_logger->log("[Model][Companies] No active Pricing Plan.",
                            \Zend_Log::WARN);
            return array();
        }
        return $companyPricingPlans;
    }

    public function getLanguageCode()
    {
        $language = $this->getLanguage();
        if (! $language) {
            return $this->getBrand()->getLanguageCode();
        }
        return $language->getIden();
    }

    /**
     * @brief Get musicclass for given company
     *
     * If no specific company music on hold is found, brand music will be used.
     * If no specific brand music  on hold is found, dafault music will be sued.
     *
     */
    public function getMusicClass()
    {
        // Company has music on hold
        $companyMoH = $this->getMusicOnHold();
        if (!empty($companyMoH)) {
            return $companyMoH[0]->getOwner();
        }

        // Brand has music on hold
        $brandMoH = $this->getBrand()->getGenericMusicOnHold();
        if (!empty($brandMoH)) {
            return $brandMoH[0]->getOwner();
        }

        return "default";
    }

    /**
     * Ensures valid domain value
     * @param string $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setDomainUsers($data)
    {
        if (is_string($data)) {
            $data = trim($data);
        }

        if ($this->getType() === Companies::VPBX && empty($data)) {
            throw new \Exception("Domain can't be empty", self::EMPTY_DOMAIN_EXCEPTION);
        }

        return parent::setDomainUsers($data);
    }

    /**
     * Get associated user domain for this company
     */
    public function getDomain()
    {
        if ($this->getType() === Companies::RETAIL) {
            // Retail Companies use Brand's Domain
            return $this->getBrand()->getDomainUsers();
        } else {
            // Virtual PBX Companies use Company's Domain
            return $this->getDomainUsers();
        }
    }

    /**
     *
     * @param string $number
     * @return bool tarificable
     */
    public function isDstTarificable($number)
    {
        $call = new \IvozProvider\Model\KamAccCdrs();

        $call->setCallee($number)
            ->setCompanyId($this->getId())
            ->setBrandId($this->getBrandId())
            ->setStartTimeUtc(new \Zend_Date());

        $result = $call->tarificate();
        if (! is_null($result)) {
            return $result->getPricingPlan();
        }
        return null;
    }

    /**
     * Convert a company dialed number to E164 form
     *
     * param string $number
     * return string number in E164
     */
    public function preferredToE164($prefnumber)
    {
        // Remove company outbound prefix
        $prefnumber = $this->removeOutboundPrefix($prefnumber);
        // Remove company anonymous prefix
        $prefnumber = $this->removeAnonymousPrefix($prefnumber);
        // Get user country
        $country = $this->getCountries();
        // Return e164 number dialed by this user
        return $country->preferredToE164($prefnumber, $this->getAreaCodeValue());
    }

    /**
     * Convert a received number to Company prefered format
     *
     * @param unknown $number
     */
    public function E164ToPreferred($e164number)
    {
        // Get Compnay country
        $country = $this->getCountries();
        // Convert from E164 to user country preferred format
        $prefnumber = $country->E164ToPreferred($e164number, $this->getAreaCodeValue());
        // Add Company anonymous prefix
        $prefnumber = $this->addAnonymousPrefix($prefnumber);
        // Add Company outbound prefix
        return $this->addOutboundPrefix($prefnumber);
    }

    /**
     * Gets company area code if company country uses area code
     *
     * @return string
     */
    public function getAreaCodeValue()
    {
        if (!$this->getCountries()->hasAreaCode())
            return "";

        return $this->getAreaCode();
    }

    public function removeOutboundPrefix($number)
    {
        // Remove company outbound prefix
        $outboundPrefix = $this->getOutboundPrefix();
        return preg_replace("/^$outboundPrefix/", "", $number);
    }

    public function addOutboundPrefix($number)
    {
        // Add Company outbound prefix
        return $this->getOutboundPrefix() . $number;
    }

    public function removeAnonymousPrefix($number)
    {
        // Remove company anonymous prefix
        $anonymousPrefix = $this->getAnonymousPrefix();
        return preg_replace("/^$anonymousPrefix/", "", $number);
    }

    public function addAnonymousPrefix($number)
    {
        // Add company anonymous prefix
        return $this->getAnonymousPrefix() . $number;
    }

    public function getOutgoingRoutings() {
        $outgoingRoutings = $this->getBrand()->getOutgoingRouting();

        $applicableOutgoingRoutings = array();

        foreach ($outgoingRoutings as $outgoingRouting) {
            $isForMyCompany = $outgoingRouting->getCompanyId() == $this->getPrimaryKey();
            $isForAllCompanies = is_null($outgoingRouting->getCompanyId());

            if ($isForMyCompany or $isForAllCompanies) {
                array_push($applicableOutgoingRoutings, $outgoingRouting);
            }
        }

        return $applicableOutgoingRoutings;
    }

    /**
     * Get the size in bytes used by the recordings on this company
     */
    public function getRecordingsDiskUsage()
    {
        $total = 0;

        // Get company recordings
        $recordings = $this->getRecordings();

        // Sum all recording size
        foreach ($recordings as $recording) {
            $total += $recording->getRecordedFileFileSize();
        }
        return $total;
    }

    /**
     * Get the size in bytes for disk usage limit on this company
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

    /**
     * Get On demand recording code DTMFs
     */
    public function getOnDemandRecordDTMFs()
    {
        return '*' . $this->getOnDemandRecordCode();
    }

    public function getFeatures()
    {
        $features = array();

        foreach ($this->getFeaturesRelCompanies() as $relFeature) {
            if ($this->getBrand()->hasFeature($relFeature->getFeatureId())) {
                array_push($features, $relFeature->getFeature());
            }
        }

        return $features;
    }

    public function getServiceCode($name)
    {
        // Get company services
        $services = $this->getCompanyServices();

        // Look for an exact match in service name
        foreach ($services as $service) {
            if ($service->getService()->getIden() == $name)
                return $service->getCode();
        }

        return '';
    }
}
