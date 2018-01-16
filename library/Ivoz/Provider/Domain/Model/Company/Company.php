<?php

namespace Ivoz\Provider\Domain\Model\Company;

use Assert\Assertion;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompany;

/**
 * Company
 */
class Company extends CompanyAbstract implements CompanyInterface
{
    const EMPTY_DOMAIN_EXCEPTION = 2001;

    /**
     * Available Company Types
     */
    const VPBX      = 'vpbx';

    const RETAIL    = "retail";

    use CompanyTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * {@inheritDoc}
     */
    public function setName($name)
    {
        return parent::setName(trim($name));
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    protected function sanitizeValues()
    {
        if (!$this->getDefaultTimezone()) {
            $this->setDefaultTimezone(
            // @todo create a shortcut
                $this->getBrand()->getDefaultTimezone()
            );
        }

        if (!$this->getLanguage()) {
            $this->setLanguage(
            // @todo create a shortcut
                $this->getBrand()->getLanguage()
            );
        }

        if (!$this->getIpFilter()) {
            $this->setIpFilter(0);
        }

        if (!$this->getOnDemandRecord()) {
            $this->setOnDemandRecord(0);
        }

        if (!$this->getOnDemandRecordCode()) {
            $this->setOnDemandRecordCode('');
        }
    }

    /**
     * {@inheritDoc}
     */
    public function setOnDemandRecordCode($onDemandRecordCode = null)
    {
        if (!empty($onDemandRecordCode)) {
            Assertion::regex($onDemandRecordCode, '/^[0-9]+$/');
        }
        return parent::setOnDemandRecordCode($onDemandRecordCode);
    }

    /**
     * @param string $exten
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
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

    /**
     * @param $ddieE164
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface|null
     */
    public function getDdi($ddieE164)
    {
        /**
         * @var Company $this
         */
        $criteria = Criteria::create();
        $criteria->where(
            Criteria::expr()->eq('ddie164', $ddieE164)
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
        $criteria->orderBy(['priority' => Criteria::ASC]);
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
        $brandMoH = $this->getBrand()->getMusicsOnHold();
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
        if (is_string($domainUsers)) {
            $domainUsers = trim($domainUsers);
        }

        if ($this->getType() === self::VPBX && empty($domainUsers)) {
            throw new \Exception("Domain can't be empty", self::EMPTY_DOMAIN_EXCEPTION);
        }

        return parent::setDomainUsers($domainUsers);
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
//            ->setStartTime(new \Zend_Date());
//
//        $result = $call->tarificate();
//        if (! is_null($result)) {
//            return $result->getPricingPlan();
//        }
//        return null;
    }

    public function getOutgoingRoutings()
    {
        /**
         * @var Company $this
         */
        $outgoingRoutings = $this->getBrand()->getOutgoingRoutings();
        $applicableOutgoingRoutings = array();

        foreach ($outgoingRoutings as $outgoingRouting) {
            $isForAllCompanies = is_null($outgoingRouting->getCompany());
            $isForMyCompany = !$isForAllCompanies && ($outgoingRouting->getCompany()->getId() == $this->getId());

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

