<?php

namespace Ivoz\Provider\Domain\Model\Company;

use Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompany;

/**
 * Company
 */
class Company extends CompanyAbstract implements CompanyInterface
{
    use CompanyTrait;
    const EMPTY_DOMAIN_EXCEPTION = 2001;

    /**
     * Available Company Types
     */
    const VPBX      = 'vpbx';

    const RETAIL    = "retail";

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @param string $exten
     * @return string
     */
    public function getTypeCall($exten)
    {
        /**
         * @var Company $this
         */

        /**
         * @var Extension $extension
         */
        $extension = $this->getExtension($exten);

        if (empty($extension)) {

            return "shared-external";
        }

        return "shared-" . $extension->getRouteType();
    }

    public function getExtension($exten)
    {
        /**
         * @var Company $this
         */
        $criteria = Criteria::create();
        $criteria->where(
            Criteria::expr()->eq('number', $exten)
        );
        $extensions = $this->getExtensions($criteria);

        return array_shift($extensions);
    }

    public function getDdi($ddieE164)
    {
        /**
         * @var Company $this
         */
        $criteria = Criteria::create();
        $criteria->where(
            Criteria::expr()->eq('DdiE164', $ddieE164)
        );
        $ddis = $this->getDdis($criteria);

        return array_shift($ddis);
    }


    public function getFriend($exten)
    {
        /**
         * @var Company $this
         */
        $criteria = Criteria::create();
        $criteria->orderBy('priority', Criteria::ASC);
        $friends = $this->getFriends($criteria);
        /**
         * @var Friend $friend
         */
        foreach ($friends as $friend) {
            if ($friend->checkExtension($exten)) {

                return $friend;
            }
        }

        return null;
    }

    public function getService($exten)
    {
        /**
         * @var Company $this
         */
        $code = substr($exten, 1);

        // Get company services
        $services = $this->getCompanyServices();

        /**
         * @var CompanyService $service
         */
        // Look for an exact match in service name
        foreach ($services as $service) {
            if ($service->getService()->getExtraArgs()) {
                continue;
            }
            if (strlen($code) != strlen($service->getCode())) {
                continue;
            }
            if ($code == $service->getCode()) {
                return $service;
            }
        }

        // Look for a partial service match
        foreach ($services as $service) {
            if (!$service->getService()->getExtraArgs()) {
                continue;
            }
            if (!strncmp($code, $service->getCode(), strlen($service->getCode()))) {
                return $service;
            }
        }

        // Extension doesn't match any service
        return null;
    }

    public function getTerminal($name)
    {
        /**
         * @var Company $this
         */
        $criteria = Criteria::create();
        $criteria->where(
            Criteria::expr()->eq('name', $name)
        );
        $terminals = $this->getTerminals($criteria);

        return array_shift($terminals);
    }

    public function getCompanyActivePricingPlan($date = null)
    {
        /**
         * @var Company $this
         */
        if (is_null($date)) {
            $date = new \DateTime();
            $date->setTimezone(new \DateTimeZone('UTC'));
        }
        $dateTime = $date->format('Y-m-d H:i:s');

        $criteria = Criteria::create();
        $criteria
            ->where(
                Criteria::expr()->lte('validFrom', $dateTime)
            )
            ->andWhere(
                Criteria::expr()->gte('validTo', $dateTime)
            )
            ->orderBy('metric', Criteria::ASC)
        ;

//        $this->_logger->log("[Model][Companies] Condition: " . $where,
//            \Zend_Log::DEBUG);
//        $order = "metric asc";
        $companyPricingPlans = $this->getRelPricingPlans($criteria);

        if (empty($companyPricingPlans)) {
//            $this->_logger->log("[Model][Companies] No active Pricing Plan.",
//                \Zend_Log::WARN);
            return array();
        }
        return $companyPricingPlans;
    }

    public function getLanguageCode()
    {
        /**
         * @var Company $this
         */
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
        /**
         * @var Company $this
         */
        // Company has music on hold
        $companyMoH = $this->getMusicsOnHold();
        if (!empty($companyMoH)) {
            return $companyMoH[0]->getOwner();
        }

        // Brand has music on hold
        $brandMoH = $this->getBrand()->getGenericMusicsOnHold();
        if (!empty($brandMoH)) {
            return $brandMoH[0]->getOwner();
        }

        return "default";
    }

    /**
     * Ensures valid domain value
     * @param string $data
     * @return \Ivoz\Provider\Model\Raw\Companies
     * @throws \Exception
     */
    public function setDomainUsers($domainUsers = null)
    {
        /**
         * @var Company $this
         */
        if (is_string($domainUsers)) {
            $domainUsers = trim($domainUsers);
        }

        if ($this->getType() === self::VPBX && empty($domainUsers)) {
            throw new \Exception("Domain can't be empty", self::EMPTY_DOMAIN_EXCEPTION);
        }

        return parent::setDomainUsers($domainUsers);
    }

    /**
     * Get associated user domain for this company
     */
    public function getDomain()
    {
        /**
         * @var Company $this
         */
        if ($this->getType() === self::RETAIL) {
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
        /**
         * @todo this is not migrated yet. Called from ExternalCallAction
         * This should be a service
         * @var Company $this
         */
        throw new \Exception('Not implemented yet');
//        $call = new \Ivoz\Provider\Model\KamAccCdrs();
//
//        $call->setCallee($number)
//            ->setCompanyId($this->getId())
//            ->setBrandId($this->getBrand()->getId())
//            ->setStartTimeUtc(new \Zend_Date());
//
//        $result = $call->tarificate();
//        if (! is_null($result)) {
//            return $result->getPricingPlan();
//        }
//        return null;
    }

    /**
     * Convert a company dialed number to E164 form
     *
     * param string $number
     * return string number in E164
     */
    public function preferredToE164($prefnumber)
    {
        /**
         * @var Company $this
         */
        // Remove company outbound prefix
        $prefnumber = $this->removeOutboundPrefix($prefnumber);
        // Get user country
        $country = $this->getCountry();
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
        /**
         * @var Company $this
         */
        // Get Compnay country
        $country = $this->getCountry();
        // Convert from E164 to user country preferred format
        $prefnumber = $country->E164ToPreferred($e164number, $this->getAreaCodeValue());
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
        /**
         * @var Company $this
         */
        if (!$this->getCountry()->hasAreaCode()) {
            return "";
        }

        return $this->getAreaCode();
    }

    /**
     * @param $number
     * @return string
     */
    public function removeOutboundPrefix($number)
    {
        /**
         * @var Company $this
         */
        // Remove company outbound prefix
        $outboundPrefix = $this->getOutboundPrefix();
        return preg_replace("/^$outboundPrefix/", "", $number);
    }

    /**
     * @param $number
     * @return string
     */
    public function addOutboundPrefix($number)
    {
        /**
         * @var Company $this
         */
        // Add Company outbound prefix
        return $this->getOutboundPrefix() . $number;
    }

    public function getOutgoingRoutings()
    {
        /**
         * @var Company $this
         */
        $outgoingRoutings = $this->getBrand()->getOutgoingRouting();
        $applicableOutgoingRoutings = array();

        foreach ($outgoingRoutings as $outgoingRouting) {
            $isForMyCompany = ($outgoingRouting->getCompany()->getId() == $this->getId());
            $isForAllCompanies = is_null($outgoingRouting->getCompany()->getId());

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
        /**
         * @var Company $this
         */
        $total = 0;

        // Get company recordings
        $recordings = $this->getRecordings();

        // Sum all recording size
        /**
         * @var Recording $recording
         */
        foreach ($recordings as $recording) {
            $total += $recording->getRecordedFile()->getFileSize();
        }
        return $total;
    }

    /**
     * Get the size in bytes for disk usage limit on this company
     */
    public function getRecordingsLimit()
    {
        /**
         * @var Company $this
         */
        return $this->getRecordingsLimitMB() * 1024 * 1024;
    }

    public function hasFeature($featureId)
    {
        /**
         * @var Company $this
         * @var Feature $feature
         */
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
        /**
         * @var Company $this
         */
        return '*' . $this->getOnDemandRecordCode();
    }

    public function getFeatures()
    {
        /**
         * @var Company $this
         */
        $features = array();

        /**
         * @var FeaturesRelCompany $relFeature
         */
        foreach ($this->getRelFeatures() as $relFeature) {

            $relFeatureId = $relFeature->getFeature()->getId();
            if ($this->getBrand()->hasFeature($relFeatureId)) {
                array_push($features, $relFeature->getFeature());
            }
        }

        return $features;
    }
}

