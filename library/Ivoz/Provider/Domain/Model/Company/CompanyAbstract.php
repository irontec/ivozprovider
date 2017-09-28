<?php

namespace Ivoz\Provider\Domain\Model\Company;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * CompanyAbstract
 * @codeCoverageIgnore
 */
abstract class CompanyAbstract
{
    /**
     * @comment enum:vpbx|retail
     * @var string
     */
    protected $type = 'vpbx';

    /**
     * @var string
     */
    protected $name;

    /**
     * @column domain_users
     * @var string
     */
    protected $domainUsers;

    /**
     * @var string
     */
    protected $nif;

    /**
     * @var integer
     */
    protected $externalMaxCalls = '0';

    /**
     * @var string
     */
    protected $postalAddress;

    /**
     * @var string
     */
    protected $postalCode;

    /**
     * @var string
     */
    protected $town;

    /**
     * @var string
     */
    protected $province;

    /**
     * @column country
     * @var string
     */
    protected $countryName;

    /**
     * @column outbound_prefix
     * @var string
     */
    protected $outboundPrefix;

    /**
     * @var boolean
     */
    protected $ipfilter = '1';

    /**
     * @var boolean
     */
    protected $onDemandRecord = '0';

    /**
     * @var string
     */
    protected $onDemandRecordCode;

    /**
     * @var string
     */
    protected $areaCode;

    /**
     * @var string
     */
    protected $externallyextraopts;

    /**
     * @var integer
     */
    protected $recordingsLimitMB;

    /**
     * @var string
     */
    protected $recordingsLimitEmail;

    /**
     * @var \Ivoz\Provider\Domain\Model\Language\LanguageInterface
     */
    protected $language;

    /**
     * @var \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface
     */
    protected $mediaRelaySets;

    /**
     * @var \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    protected $defaultTimezone;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface
     */
    protected $applicationServer;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    protected $country;

    /**
     * @var \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    protected $outgoingDdi;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface
     */
    protected $outgoingDdiRule;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct(
        $type,
        $name,
        $nif,
        $externalMaxCalls,
        $postalAddress,
        $postalCode,
        $town,
        $province,
        $countryName
    ) {
        $this->setType($type);
        $this->setName($name);
        $this->setNif($nif);
        $this->setExternalMaxCalls($externalMaxCalls);
        $this->setPostalAddress($postalAddress);
        $this->setPostalCode($postalCode);
        $this->setTown($town);
        $this->setProvince($province);
        $this->setCountryName($countryName);

        $this->initChangelog();
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $values = $this->__toArray();
        if (!$this->getId()) {
            // Empty values for entities with no Id
            foreach ($values as $key => $val) {
                $values[$key] = null;
            }
        }

        $this->_initialValues = $values;
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function hasChanged($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$fieldName] != $this->_initialValues[$fieldName];
    }

    public function getInitialValue($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }

        return $this->_initialValues[$fieldName];
    }

    /**
     * @return CompanyDTO
     */
    public static function createDTO()
    {
        return new CompanyDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CompanyDTO
         */
        Assertion::isInstanceOf($dto, CompanyDTO::class);

        $self = new static(
            $dto->getType(),
            $dto->getName(),
            $dto->getNif(),
            $dto->getExternalMaxCalls(),
            $dto->getPostalAddress(),
            $dto->getPostalCode(),
            $dto->getTown(),
            $dto->getProvince(),
            $dto->getCountryName());

        return $self
            ->setDomainUsers($dto->getDomainUsers())
            ->setOutboundPrefix($dto->getOutboundPrefix())
            ->setIpfilter($dto->getIpfilter())
            ->setOnDemandRecord($dto->getOnDemandRecord())
            ->setOnDemandRecordCode($dto->getOnDemandRecordCode())
            ->setAreaCode($dto->getAreaCode())
            ->setExternallyextraopts($dto->getExternallyextraopts())
            ->setRecordingsLimitMB($dto->getRecordingsLimitMB())
            ->setRecordingsLimitEmail($dto->getRecordingsLimitEmail())
            ->setLanguage($dto->getLanguage())
            ->setMediaRelaySets($dto->getMediaRelaySets())
            ->setDefaultTimezone($dto->getDefaultTimezone())
            ->setBrand($dto->getBrand())
            ->setApplicationServer($dto->getApplicationServer())
            ->setCountry($dto->getCountry())
            ->setOutgoingDdi($dto->getOutgoingDdi())
            ->setOutgoingDdiRule($dto->getOutgoingDdiRule())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CompanyDTO
         */
        Assertion::isInstanceOf($dto, CompanyDTO::class);

        $this
            ->setType($dto->getType())
            ->setName($dto->getName())
            ->setDomainUsers($dto->getDomainUsers())
            ->setNif($dto->getNif())
            ->setExternalMaxCalls($dto->getExternalMaxCalls())
            ->setPostalAddress($dto->getPostalAddress())
            ->setPostalCode($dto->getPostalCode())
            ->setTown($dto->getTown())
            ->setProvince($dto->getProvince())
            ->setCountryName($dto->getCountryName())
            ->setOutboundPrefix($dto->getOutboundPrefix())
            ->setIpfilter($dto->getIpfilter())
            ->setOnDemandRecord($dto->getOnDemandRecord())
            ->setOnDemandRecordCode($dto->getOnDemandRecordCode())
            ->setAreaCode($dto->getAreaCode())
            ->setExternallyextraopts($dto->getExternallyextraopts())
            ->setRecordingsLimitMB($dto->getRecordingsLimitMB())
            ->setRecordingsLimitEmail($dto->getRecordingsLimitEmail())
            ->setLanguage($dto->getLanguage())
            ->setMediaRelaySets($dto->getMediaRelaySets())
            ->setDefaultTimezone($dto->getDefaultTimezone())
            ->setBrand($dto->getBrand())
            ->setApplicationServer($dto->getApplicationServer())
            ->setCountry($dto->getCountry())
            ->setOutgoingDdi($dto->getOutgoingDdi())
            ->setOutgoingDdiRule($dto->getOutgoingDdiRule());


        return $this;
    }

    /**
     * @return CompanyDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setType($this->getType())
            ->setName($this->getName())
            ->setDomainUsers($this->getDomainUsers())
            ->setNif($this->getNif())
            ->setExternalMaxCalls($this->getExternalMaxCalls())
            ->setPostalAddress($this->getPostalAddress())
            ->setPostalCode($this->getPostalCode())
            ->setTown($this->getTown())
            ->setProvince($this->getProvince())
            ->setCountryName($this->getCountryName())
            ->setOutboundPrefix($this->getOutboundPrefix())
            ->setIpfilter($this->getIpfilter())
            ->setOnDemandRecord($this->getOnDemandRecord())
            ->setOnDemandRecordCode($this->getOnDemandRecordCode())
            ->setAreaCode($this->getAreaCode())
            ->setExternallyextraopts($this->getExternallyextraopts())
            ->setRecordingsLimitMB($this->getRecordingsLimitMB())
            ->setRecordingsLimitEmail($this->getRecordingsLimitEmail())
            ->setLanguageId($this->getLanguage() ? $this->getLanguage()->getId() : null)
            ->setMediaRelaySetsId($this->getMediaRelaySets() ? $this->getMediaRelaySets()->getId() : null)
            ->setDefaultTimezoneId($this->getDefaultTimezone() ? $this->getDefaultTimezone()->getId() : null)
            ->setBrandId($this->getBrand() ? $this->getBrand()->getId() : null)
            ->setApplicationServerId($this->getApplicationServer() ? $this->getApplicationServer()->getId() : null)
            ->setCountryId($this->getCountry() ? $this->getCountry()->getId() : null)
            ->setOutgoingDdiId($this->getOutgoingDdi() ? $this->getOutgoingDdi()->getId() : null)
            ->setOutgoingDdiRuleId($this->getOutgoingDdiRule() ? $this->getOutgoingDdiRule()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'type' => $this->getType(),
            'name' => $this->getName(),
            'domainUsers' => $this->getDomainUsers(),
            'nif' => $this->getNif(),
            'externalMaxCalls' => $this->getExternalMaxCalls(),
            'postalAddress' => $this->getPostalAddress(),
            'postalCode' => $this->getPostalCode(),
            'town' => $this->getTown(),
            'province' => $this->getProvince(),
            'countryName' => $this->getCountryName(),
            'outboundPrefix' => $this->getOutboundPrefix(),
            'ipfilter' => $this->getIpfilter(),
            'onDemandRecord' => $this->getOnDemandRecord(),
            'onDemandRecordCode' => $this->getOnDemandRecordCode(),
            'areaCode' => $this->getAreaCode(),
            'externallyextraopts' => $this->getExternallyextraopts(),
            'recordingsLimitMB' => $this->getRecordingsLimitMB(),
            'recordingsLimitEmail' => $this->getRecordingsLimitEmail(),
            'languageId' => $this->getLanguage() ? $this->getLanguage()->getId() : null,
            'mediaRelaySetsId' => $this->getMediaRelaySets() ? $this->getMediaRelaySets()->getId() : null,
            'defaultTimezoneId' => $this->getDefaultTimezone() ? $this->getDefaultTimezone()->getId() : null,
            'brandId' => $this->getBrand() ? $this->getBrand()->getId() : null,
            'applicationServerId' => $this->getApplicationServer() ? $this->getApplicationServer()->getId() : null,
            'countryId' => $this->getCountry() ? $this->getCountry()->getId() : null,
            'outgoingDdiId' => $this->getOutgoingDdi() ? $this->getOutgoingDdi()->getId() : null,
            'outgoingDdiRuleId' => $this->getOutgoingDdiRule() ? $this->getOutgoingDdiRule()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set type
     *
     * @param string $type
     *
     * @return self
     */
    public function setType($type)
    {
        Assertion::notNull($type);
        Assertion::maxLength($type, 25);
        Assertion::choice($type, array (
          0 => 'vpbx',
          1 => 'retail',
        ));

        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        Assertion::notNull($name);
        Assertion::maxLength($name, 80);

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set domainUsers
     *
     * @param string $domainUsers
     *
     * @return self
     */
    public function setDomainUsers($domainUsers = null)
    {
        if (!is_null($domainUsers)) {
            Assertion::maxLength($domainUsers, 190);
        }

        $this->domainUsers = $domainUsers;

        return $this;
    }

    /**
     * Get domainUsers
     *
     * @return string
     */
    public function getDomainUsers()
    {
        return $this->domainUsers;
    }

    /**
     * Set nif
     *
     * @param string $nif
     *
     * @return self
     */
    public function setNif($nif)
    {
        Assertion::notNull($nif);
        Assertion::maxLength($nif, 25);

        $this->nif = $nif;

        return $this;
    }

    /**
     * Get nif
     *
     * @return string
     */
    public function getNif()
    {
        return $this->nif;
    }

    /**
     * Set externalMaxCalls
     *
     * @param integer $externalMaxCalls
     *
     * @return self
     */
    public function setExternalMaxCalls($externalMaxCalls)
    {
        Assertion::notNull($externalMaxCalls);
        Assertion::integerish($externalMaxCalls);
        Assertion::greaterOrEqualThan($externalMaxCalls, 0);

        $this->externalMaxCalls = $externalMaxCalls;

        return $this;
    }

    /**
     * Get externalMaxCalls
     *
     * @return integer
     */
    public function getExternalMaxCalls()
    {
        return $this->externalMaxCalls;
    }

    /**
     * Set postalAddress
     *
     * @param string $postalAddress
     *
     * @return self
     */
    public function setPostalAddress($postalAddress)
    {
        Assertion::notNull($postalAddress);
        Assertion::maxLength($postalAddress, 255);

        $this->postalAddress = $postalAddress;

        return $this;
    }

    /**
     * Get postalAddress
     *
     * @return string
     */
    public function getPostalAddress()
    {
        return $this->postalAddress;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     *
     * @return self
     */
    public function setPostalCode($postalCode)
    {
        Assertion::notNull($postalCode);
        Assertion::maxLength($postalCode, 10);

        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set town
     *
     * @param string $town
     *
     * @return self
     */
    public function setTown($town)
    {
        Assertion::notNull($town);
        Assertion::maxLength($town, 255);

        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set province
     *
     * @param string $province
     *
     * @return self
     */
    public function setProvince($province)
    {
        Assertion::notNull($province);
        Assertion::maxLength($province, 255);

        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return string
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set countryName
     *
     * @param string $countryName
     *
     * @return self
     */
    public function setCountryName($countryName)
    {
        Assertion::notNull($countryName);
        Assertion::maxLength($countryName, 255);

        $this->countryName = $countryName;

        return $this;
    }

    /**
     * Get countryName
     *
     * @return string
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * Set outboundPrefix
     *
     * @param string $outboundPrefix
     *
     * @return self
     */
    public function setOutboundPrefix($outboundPrefix = null)
    {
        if (!is_null($outboundPrefix)) {
            Assertion::maxLength($outboundPrefix, 255);
        }

        $this->outboundPrefix = $outboundPrefix;

        return $this;
    }

    /**
     * Get outboundPrefix
     *
     * @return string
     */
    public function getOutboundPrefix()
    {
        return $this->outboundPrefix;
    }

    /**
     * Set ipfilter
     *
     * @param boolean $ipfilter
     *
     * @return self
     */
    public function setIpfilter($ipfilter = null)
    {
        if (!is_null($ipfilter)) {
            Assertion::between(intval($ipfilter), 0, 1);
        }

        $this->ipfilter = $ipfilter;

        return $this;
    }

    /**
     * Get ipfilter
     *
     * @return boolean
     */
    public function getIpfilter()
    {
        return $this->ipfilter;
    }

    /**
     * Set onDemandRecord
     *
     * @param boolean $onDemandRecord
     *
     * @return self
     */
    public function setOnDemandRecord($onDemandRecord = null)
    {
        if (!is_null($onDemandRecord)) {
            Assertion::between(intval($onDemandRecord), 0, 1);
        }

        $this->onDemandRecord = $onDemandRecord;

        return $this;
    }

    /**
     * Get onDemandRecord
     *
     * @return boolean
     */
    public function getOnDemandRecord()
    {
        return $this->onDemandRecord;
    }

    /**
     * Set onDemandRecordCode
     *
     * @param string $onDemandRecordCode
     *
     * @return self
     */
    public function setOnDemandRecordCode($onDemandRecordCode = null)
    {
        if (!is_null($onDemandRecordCode)) {
            Assertion::maxLength($onDemandRecordCode, 3);
        }

        $this->onDemandRecordCode = $onDemandRecordCode;

        return $this;
    }

    /**
     * Get onDemandRecordCode
     *
     * @return string
     */
    public function getOnDemandRecordCode()
    {
        return $this->onDemandRecordCode;
    }

    /**
     * Set areaCode
     *
     * @param string $areaCode
     *
     * @return self
     */
    public function setAreaCode($areaCode = null)
    {
        if (!is_null($areaCode)) {
            Assertion::maxLength($areaCode, 10);
        }

        $this->areaCode = $areaCode;

        return $this;
    }

    /**
     * Get areaCode
     *
     * @return string
     */
    public function getAreaCode()
    {
        return $this->areaCode;
    }

    /**
     * Set externallyextraopts
     *
     * @param string $externallyextraopts
     *
     * @return self
     */
    public function setExternallyextraopts($externallyextraopts = null)
    {
        if (!is_null($externallyextraopts)) {
            Assertion::maxLength($externallyextraopts, 65535);
        }

        $this->externallyextraopts = $externallyextraopts;

        return $this;
    }

    /**
     * Get externallyextraopts
     *
     * @return string
     */
    public function getExternallyextraopts()
    {
        return $this->externallyextraopts;
    }

    /**
     * Set recordingsLimitMB
     *
     * @param integer $recordingsLimitMB
     *
     * @return self
     */
    public function setRecordingsLimitMB($recordingsLimitMB = null)
    {
        if (!is_null($recordingsLimitMB)) {
            if (!is_null($recordingsLimitMB)) {
                Assertion::integerish($recordingsLimitMB);
            }
        }

        $this->recordingsLimitMB = $recordingsLimitMB;

        return $this;
    }

    /**
     * Get recordingsLimitMB
     *
     * @return integer
     */
    public function getRecordingsLimitMB()
    {
        return $this->recordingsLimitMB;
    }

    /**
     * Set recordingsLimitEmail
     *
     * @param string $recordingsLimitEmail
     *
     * @return self
     */
    public function setRecordingsLimitEmail($recordingsLimitEmail = null)
    {
        if (!is_null($recordingsLimitEmail)) {
            Assertion::maxLength($recordingsLimitEmail, 250);
        }

        $this->recordingsLimitEmail = $recordingsLimitEmail;

        return $this;
    }

    /**
     * Get recordingsLimitEmail
     *
     * @return string
     */
    public function getRecordingsLimitEmail()
    {
        return $this->recordingsLimitEmail;
    }

    /**
     * Set language
     *
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageInterface $language
     *
     * @return self
     */
    public function setLanguage(\Ivoz\Provider\Domain\Model\Language\LanguageInterface $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageInterface
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set mediaRelaySets
     *
     * @param \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface $mediaRelaySets
     *
     * @return self
     */
    public function setMediaRelaySets(\Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface $mediaRelaySets = null)
    {
        $this->mediaRelaySets = $mediaRelaySets;

        return $this;
    }

    /**
     * Get mediaRelaySets
     *
     * @return \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface
     */
    public function getMediaRelaySets()
    {
        return $this->mediaRelaySets;
    }

    /**
     * Set defaultTimezone
     *
     * @param \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface $defaultTimezone
     *
     * @return self
     */
    public function setDefaultTimezone(\Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface $defaultTimezone = null)
    {
        $this->defaultTimezone = $defaultTimezone;

        return $this;
    }

    /**
     * Get defaultTimezone
     *
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    public function getDefaultTimezone()
    {
        return $this->defaultTimezone;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set applicationServer
     *
     * @param \Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface $applicationServer
     *
     * @return self
     */
    public function setApplicationServer(\Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface $applicationServer = null)
    {
        $this->applicationServer = $applicationServer;

        return $this;
    }

    /**
     * Get applicationServer
     *
     * @return \Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface
     */
    public function getApplicationServer()
    {
        return $this->applicationServer;
    }

    /**
     * Set country
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $country
     *
     * @return self
     */
    public function setCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set outgoingDdi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi
     *
     * @return self
     */
    public function setOutgoingDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi = null)
    {
        $this->outgoingDdi = $outgoingDdi;

        return $this;
    }

    /**
     * Get outgoingDdi
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    public function getOutgoingDdi()
    {
        return $this->outgoingDdi;
    }

    /**
     * Set outgoingDdiRule
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface $outgoingDdiRule
     *
     * @return self
     */
    public function setOutgoingDdiRule(\Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface $outgoingDdiRule = null)
    {
        $this->outgoingDdiRule = $outgoingDdiRule;

        return $this;
    }

    /**
     * Get outgoingDdiRule
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface
     */
    public function getOutgoingDdiRule()
    {
        return $this->outgoingDdiRule;
    }



    // @codeCoverageIgnoreEnd
}

