<?php

namespace Ivoz\Provider\Domain\Model\Company;

use Assert\Assertion;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Feature\FeatureInterface;
use Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompany;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\Recording\Recording;

/**
 * Company
 */
class Company extends CompanyAbstract implements CompanyInterface
{
    const EMPTY_DOMAIN_EXCEPTION = 2001;

    /** @deprecated */
    const VPBX          = self::TYPE_VPBX;

    /** @deprecated */
    const RETAIL        = self::TYPE_RETAIL;

    /** @deprecated */
    const WHOLESALE     = self::TYPE_WHOLESALE;

    /** @deprecated */
    const RESIDENTIAL   = self::TYPE_RESIDENTIAL;

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

        if ($this->getType() == Company::RETAIL) {
            if (!$this->getDomain()) {
                $this->setDomain(
                    $this->getBrand()->getDomain()
                );
            }
        }

        if ($this->getType() == Company::RESIDENTIAL) {
            if (!$this->getDomain()) {
                $this->setDomain(
                    $this->getBrand()->getDomain()
                );
            }
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
     * @return string
     */
    public function getCurrencySymbol()
    {
        $currency = $this->getCurrency();
        if (!$currency) {
            return $this->getBrand()->getCurrencySymbol();
        }
        return $currency->getSymbol();
    }

    /**
     * @return string
     */
    public function getCurrencyIden()
    {
        $currency = $this->getCurrency();
        if (!$currency) {
            return $this->getBrand()->getCurrencyIden();
        }
        return $currency->getIden();
    }

    /**
     * brief: Get musicclass for given company
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
     * @inheritdoc
     */
    public function setDomainUsers($domainUsers = null)
    {
        if (is_string($domainUsers)) {
            $domainUsers = trim($domainUsers);
        }

        if ($this->getType() === self::VPBX && empty($domainUsers)) {
            throw new \DomainException("Domain can't be empty", self::EMPTY_DOMAIN_EXCEPTION);
        }

        return parent::setDomainUsers($domainUsers);
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

    /**
     * Check if a Company has a given Feature by id
     *
     * @param $featureId
     * @return bool
     */
    public function hasFeature($featureId)
    {
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

    /**
     * @return FeatureInterface[]
     */
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

    /**
     * @param string $name
     * @return string
     */
    public function getServiceCode($name)
    {
        // Get company services
        $services = $this->getCompanyServices();
        // Look for an exact match in service name
        foreach ($services as $service) {
            if ($service->getService()->getIden() == $name) {
                return $service->getCode();
            }
        }

        return '';
    }


    /**
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    public function getDefaultTimezone()
    {
        $timeZone = parent::getDefaultTimezone();
        if (!empty($timeZone)) {
            return $timeZone;
        }

        return $this->getBrand()->getDefaultTimezone();
    }

    /**
     * @return string
     */
    public function getCgrSubject()
    {
        return sprintf("c%d", $this->getId());
    }
}
