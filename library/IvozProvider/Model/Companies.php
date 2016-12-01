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
        $services = array();

        // Get company services
        $companyServices = $this->getCompanyServices();
        foreach ($companyServices as $companyService) {
            $services[$companyService->getServiceId()] = $companyService;
        }

        // Look for the Service Code in the extension
        $code = substr($exten, 1);
        foreach ($services as $service) {
            if ($code == $service->getCode()) {
                return $service;
            }
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
                         "'";
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
     * Get associated user domain for this company
     */
    public function getDomain()
    {
        $domains = $this->getDomains();
        if (!empty($domains)) {
            $domain = array_shift($domains);
            return $domain->getDomain();
        } else {
            return "";
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
        // Get user country
        $country = $this->getCountries();
        // Return e164 number dialed by this user
        return $country->preferredToE164($prefnumber, $this->getAreaCode());
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
        $prefnumber = $country->E164ToPreferred($e164number, $this->getAreaCode());
        // Add Company outbound prefix
        return $this->addOutboundPrefix($prefnumber);
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
}
