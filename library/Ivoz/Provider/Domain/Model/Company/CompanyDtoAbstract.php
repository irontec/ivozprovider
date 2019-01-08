<?php

namespace Ivoz\Provider\Domain\Model\Company;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class CompanyDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $type = 'vpbx';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $domainUsers;

    /**
     * @var string
     */
    private $nif;

    /**
     * @var string
     */
    private $distributeMethod = 'hash';

    /**
     * @var integer
     */
    private $maxCalls = '0';

    /**
     * @var string
     */
    private $postalAddress;

    /**
     * @var string
     */
    private $postalCode;

    /**
     * @var string
     */
    private $town;

    /**
     * @var string
     */
    private $province;

    /**
     * @var string
     */
    private $countryName;

    /**
     * @var boolean
     */
    private $ipfilter = '1';

    /**
     * @var integer
     */
    private $onDemandRecord = '0';

    /**
     * @var string
     */
    private $onDemandRecordCode;

    /**
     * @var string
     */
    private $externallyextraopts;

    /**
     * @var integer
     */
    private $recordingsLimitMB;

    /**
     * @var string
     */
    private $recordingsLimitEmail;

    /**
     * @var string
     */
    private $billingMethod = 'postpaid';

    /**
     * @var string
     */
    private $balance = 0;

    /**
     * @var boolean
     */
    private $showInvoices = '0';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Language\LanguageDto | null
     */
    private $language;

    /**
     * @var \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetDto | null
     */
    private $mediaRelaySets;

    /**
     * @var \Ivoz\Provider\Domain\Model\Timezone\TimezoneDto | null
     */
    private $defaultTimezone;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Domain\DomainDto | null
     */
    private $domain;

    /**
     * @var \Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerDto | null
     */
    private $applicationServer;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    private $country;

    /**
     * @var \Ivoz\Provider\Domain\Model\Currency\CurrencyDto | null
     */
    private $currency;

    /**
     * @var \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto | null
     */
    private $transformationRuleSet;

    /**
     * @var \Ivoz\Provider\Domain\Model\Ddi\DdiDto | null
     */
    private $outgoingDdi;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto | null
     */
    private $outgoingDdiRule;

    /**
     * @var \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto | null
     */
    private $voicemailNotificationTemplate;

    /**
     * @var \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto | null
     */
    private $faxNotificationTemplate;

    /**
     * @var \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto | null
     */
    private $invoiceNotificationTemplate;

    /**
     * @var \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto | null
     */
    private $callCsvNotificationTemplate;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionDto[] | null
     */
    private $extensions = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\Ddi\DdiDto[] | null
     */
    private $ddis = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\Friend\FriendDto[] | null
     */
    private $friends = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceDto[] | null
     */
    private $companyServices = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\Terminal\TerminalDto[] | null
     */
    private $terminals = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileDto[] | null
     */
    private $ratingProfiles = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldDto[] | null
     */
    private $musicsOnHold = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\Recording\RecordingDto[] | null
     */
    private $recordings = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyDto[] | null
     */
    private $relFeatures = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecDto[] | null
     */
    private $relCodecs = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagDto[] | null
     */
    private $relRoutingTags = null;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'type' => 'type',
            'name' => 'name',
            'domainUsers' => 'domainUsers',
            'nif' => 'nif',
            'distributeMethod' => 'distributeMethod',
            'maxCalls' => 'maxCalls',
            'postalAddress' => 'postalAddress',
            'postalCode' => 'postalCode',
            'town' => 'town',
            'province' => 'province',
            'countryName' => 'countryName',
            'ipfilter' => 'ipfilter',
            'onDemandRecord' => 'onDemandRecord',
            'onDemandRecordCode' => 'onDemandRecordCode',
            'externallyextraopts' => 'externallyextraopts',
            'recordingsLimitMB' => 'recordingsLimitMB',
            'recordingsLimitEmail' => 'recordingsLimitEmail',
            'billingMethod' => 'billingMethod',
            'balance' => 'balance',
            'showInvoices' => 'showInvoices',
            'id' => 'id',
            'languageId' => 'language',
            'mediaRelaySetsId' => 'mediaRelaySets',
            'defaultTimezoneId' => 'defaultTimezone',
            'brandId' => 'brand',
            'domainId' => 'domain',
            'applicationServerId' => 'applicationServer',
            'countryId' => 'country',
            'currencyId' => 'currency',
            'transformationRuleSetId' => 'transformationRuleSet',
            'outgoingDdiId' => 'outgoingDdi',
            'outgoingDdiRuleId' => 'outgoingDdiRule',
            'voicemailNotificationTemplateId' => 'voicemailNotificationTemplate',
            'faxNotificationTemplateId' => 'faxNotificationTemplate',
            'invoiceNotificationTemplateId' => 'invoiceNotificationTemplate',
            'callCsvNotificationTemplateId' => 'callCsvNotificationTemplate'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'type' => $this->getType(),
            'name' => $this->getName(),
            'domainUsers' => $this->getDomainUsers(),
            'nif' => $this->getNif(),
            'distributeMethod' => $this->getDistributeMethod(),
            'maxCalls' => $this->getMaxCalls(),
            'postalAddress' => $this->getPostalAddress(),
            'postalCode' => $this->getPostalCode(),
            'town' => $this->getTown(),
            'province' => $this->getProvince(),
            'countryName' => $this->getCountryName(),
            'ipfilter' => $this->getIpfilter(),
            'onDemandRecord' => $this->getOnDemandRecord(),
            'onDemandRecordCode' => $this->getOnDemandRecordCode(),
            'externallyextraopts' => $this->getExternallyextraopts(),
            'recordingsLimitMB' => $this->getRecordingsLimitMB(),
            'recordingsLimitEmail' => $this->getRecordingsLimitEmail(),
            'billingMethod' => $this->getBillingMethod(),
            'balance' => $this->getBalance(),
            'showInvoices' => $this->getShowInvoices(),
            'id' => $this->getId(),
            'language' => $this->getLanguage(),
            'mediaRelaySets' => $this->getMediaRelaySets(),
            'defaultTimezone' => $this->getDefaultTimezone(),
            'brand' => $this->getBrand(),
            'domain' => $this->getDomain(),
            'applicationServer' => $this->getApplicationServer(),
            'country' => $this->getCountry(),
            'currency' => $this->getCurrency(),
            'transformationRuleSet' => $this->getTransformationRuleSet(),
            'outgoingDdi' => $this->getOutgoingDdi(),
            'outgoingDdiRule' => $this->getOutgoingDdiRule(),
            'voicemailNotificationTemplate' => $this->getVoicemailNotificationTemplate(),
            'faxNotificationTemplate' => $this->getFaxNotificationTemplate(),
            'invoiceNotificationTemplate' => $this->getInvoiceNotificationTemplate(),
            'callCsvNotificationTemplate' => $this->getCallCsvNotificationTemplate(),
            'extensions' => $this->getExtensions(),
            'ddis' => $this->getDdis(),
            'friends' => $this->getFriends(),
            'companyServices' => $this->getCompanyServices(),
            'terminals' => $this->getTerminals(),
            'ratingProfiles' => $this->getRatingProfiles(),
            'musicsOnHold' => $this->getMusicsOnHold(),
            'recordings' => $this->getRecordings(),
            'relFeatures' => $this->getRelFeatures(),
            'relCodecs' => $this->getRelCodecs(),
            'relRoutingTags' => $this->getRelRoutingTags()
        ];
    }

    /**
     * @param string $type
     *
     * @return static
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $name
     *
     * @return static
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $domainUsers
     *
     * @return static
     */
    public function setDomainUsers($domainUsers = null)
    {
        $this->domainUsers = $domainUsers;

        return $this;
    }

    /**
     * @return string
     */
    public function getDomainUsers()
    {
        return $this->domainUsers;
    }

    /**
     * @param string $nif
     *
     * @return static
     */
    public function setNif($nif = null)
    {
        $this->nif = $nif;

        return $this;
    }

    /**
     * @return string
     */
    public function getNif()
    {
        return $this->nif;
    }

    /**
     * @param string $distributeMethod
     *
     * @return static
     */
    public function setDistributeMethod($distributeMethod = null)
    {
        $this->distributeMethod = $distributeMethod;

        return $this;
    }

    /**
     * @return string
     */
    public function getDistributeMethod()
    {
        return $this->distributeMethod;
    }

    /**
     * @param integer $maxCalls
     *
     * @return static
     */
    public function setMaxCalls($maxCalls = null)
    {
        $this->maxCalls = $maxCalls;

        return $this;
    }

    /**
     * @return integer
     */
    public function getMaxCalls()
    {
        return $this->maxCalls;
    }

    /**
     * @param string $postalAddress
     *
     * @return static
     */
    public function setPostalAddress($postalAddress = null)
    {
        $this->postalAddress = $postalAddress;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostalAddress()
    {
        return $this->postalAddress;
    }

    /**
     * @param string $postalCode
     *
     * @return static
     */
    public function setPostalCode($postalCode = null)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $town
     *
     * @return static
     */
    public function setTown($town = null)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * @param string $province
     *
     * @return static
     */
    public function setProvince($province = null)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * @return string
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @param string $countryName
     *
     * @return static
     */
    public function setCountryName($countryName = null)
    {
        $this->countryName = $countryName;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * @param boolean $ipfilter
     *
     * @return static
     */
    public function setIpfilter($ipfilter = null)
    {
        $this->ipfilter = $ipfilter;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getIpfilter()
    {
        return $this->ipfilter;
    }

    /**
     * @param integer $onDemandRecord
     *
     * @return static
     */
    public function setOnDemandRecord($onDemandRecord = null)
    {
        $this->onDemandRecord = $onDemandRecord;

        return $this;
    }

    /**
     * @return integer
     */
    public function getOnDemandRecord()
    {
        return $this->onDemandRecord;
    }

    /**
     * @param string $onDemandRecordCode
     *
     * @return static
     */
    public function setOnDemandRecordCode($onDemandRecordCode = null)
    {
        $this->onDemandRecordCode = $onDemandRecordCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getOnDemandRecordCode()
    {
        return $this->onDemandRecordCode;
    }

    /**
     * @param string $externallyextraopts
     *
     * @return static
     */
    public function setExternallyextraopts($externallyextraopts = null)
    {
        $this->externallyextraopts = $externallyextraopts;

        return $this;
    }

    /**
     * @return string
     */
    public function getExternallyextraopts()
    {
        return $this->externallyextraopts;
    }

    /**
     * @param integer $recordingsLimitMB
     *
     * @return static
     */
    public function setRecordingsLimitMB($recordingsLimitMB = null)
    {
        $this->recordingsLimitMB = $recordingsLimitMB;

        return $this;
    }

    /**
     * @return integer
     */
    public function getRecordingsLimitMB()
    {
        return $this->recordingsLimitMB;
    }

    /**
     * @param string $recordingsLimitEmail
     *
     * @return static
     */
    public function setRecordingsLimitEmail($recordingsLimitEmail = null)
    {
        $this->recordingsLimitEmail = $recordingsLimitEmail;

        return $this;
    }

    /**
     * @return string
     */
    public function getRecordingsLimitEmail()
    {
        return $this->recordingsLimitEmail;
    }

    /**
     * @param string $billingMethod
     *
     * @return static
     */
    public function setBillingMethod($billingMethod = null)
    {
        $this->billingMethod = $billingMethod;

        return $this;
    }

    /**
     * @return string
     */
    public function getBillingMethod()
    {
        return $this->billingMethod;
    }

    /**
     * @param string $balance
     *
     * @return static
     */
    public function setBalance($balance = null)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * @return string
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param boolean $showInvoices
     *
     * @return static
     */
    public function setShowInvoices($showInvoices = null)
    {
        $this->showInvoices = $showInvoices;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getShowInvoices()
    {
        return $this->showInvoices;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageDto $language
     *
     * @return static
     */
    public function setLanguage(\Ivoz\Provider\Domain\Model\Language\LanguageDto $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageDto
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setLanguageId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Language\LanguageDto($id)
            : null;

        return $this->setLanguage($value);
    }

    /**
     * @return integer | null
     */
    public function getLanguageId()
    {
        if ($dto = $this->getLanguage()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetDto $mediaRelaySets
     *
     * @return static
     */
    public function setMediaRelaySets(\Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetDto $mediaRelaySets = null)
    {
        $this->mediaRelaySets = $mediaRelaySets;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetDto
     */
    public function getMediaRelaySets()
    {
        return $this->mediaRelaySets;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setMediaRelaySetsId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetDto($id)
            : null;

        return $this->setMediaRelaySets($value);
    }

    /**
     * @return integer | null
     */
    public function getMediaRelaySetsId()
    {
        if ($dto = $this->getMediaRelaySets()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Timezone\TimezoneDto $defaultTimezone
     *
     * @return static
     */
    public function setDefaultTimezone(\Ivoz\Provider\Domain\Model\Timezone\TimezoneDto $defaultTimezone = null)
    {
        $this->defaultTimezone = $defaultTimezone;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneDto
     */
    public function getDefaultTimezone()
    {
        return $this->defaultTimezone;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setDefaultTimezoneId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Timezone\TimezoneDto($id)
            : null;

        return $this->setDefaultTimezone($value);
    }

    /**
     * @return integer | null
     */
    public function getDefaultTimezoneId()
    {
        if ($dto = $this->getDefaultTimezone()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandDto $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandDto $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandDto
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setBrandId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Brand\BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    /**
     * @return integer | null
     */
    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Domain\DomainDto $domain
     *
     * @return static
     */
    public function setDomain(\Ivoz\Provider\Domain\Model\Domain\DomainDto $domain = null)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Domain\DomainDto
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setDomainId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Domain\DomainDto($id)
            : null;

        return $this->setDomain($value);
    }

    /**
     * @return integer | null
     */
    public function getDomainId()
    {
        if ($dto = $this->getDomain()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerDto $applicationServer
     *
     * @return static
     */
    public function setApplicationServer(\Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerDto $applicationServer = null)
    {
        $this->applicationServer = $applicationServer;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerDto
     */
    public function getApplicationServer()
    {
        return $this->applicationServer;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setApplicationServerId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerDto($id)
            : null;

        return $this->setApplicationServer($value);
    }

    /**
     * @return integer | null
     */
    public function getApplicationServerId()
    {
        if ($dto = $this->getApplicationServer()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Country\CountryDto $country
     *
     * @return static
     */
    public function setCountry(\Ivoz\Provider\Domain\Model\Country\CountryDto $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Country\CountryDto
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCountryId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Country\CountryDto($id)
            : null;

        return $this->setCountry($value);
    }

    /**
     * @return integer | null
     */
    public function getCountryId()
    {
        if ($dto = $this->getCountry()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Currency\CurrencyDto $currency
     *
     * @return static
     */
    public function setCurrency(\Ivoz\Provider\Domain\Model\Currency\CurrencyDto $currency = null)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Currency\CurrencyDto
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCurrencyId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Currency\CurrencyDto($id)
            : null;

        return $this->setCurrency($value);
    }

    /**
     * @return integer | null
     */
    public function getCurrencyId()
    {
        if ($dto = $this->getCurrency()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto $transformationRuleSet
     *
     * @return static
     */
    public function setTransformationRuleSet(\Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto $transformationRuleSet = null)
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto
     */
    public function getTransformationRuleSet()
    {
        return $this->transformationRuleSet;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setTransformationRuleSetId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto($id)
            : null;

        return $this->setTransformationRuleSet($value);
    }

    /**
     * @return integer | null
     */
    public function getTransformationRuleSetId()
    {
        if ($dto = $this->getTransformationRuleSet()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiDto $outgoingDdi
     *
     * @return static
     */
    public function setOutgoingDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiDto $outgoingDdi = null)
    {
        $this->outgoingDdi = $outgoingDdi;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiDto
     */
    public function getOutgoingDdi()
    {
        return $this->outgoingDdi;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setOutgoingDdiId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Ddi\DdiDto($id)
            : null;

        return $this->setOutgoingDdi($value);
    }

    /**
     * @return integer | null
     */
    public function getOutgoingDdiId()
    {
        if ($dto = $this->getOutgoingDdi()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto $outgoingDdiRule
     *
     * @return static
     */
    public function setOutgoingDdiRule(\Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto $outgoingDdiRule = null)
    {
        $this->outgoingDdiRule = $outgoingDdiRule;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto
     */
    public function getOutgoingDdiRule()
    {
        return $this->outgoingDdiRule;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setOutgoingDdiRuleId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto($id)
            : null;

        return $this->setOutgoingDdiRule($value);
    }

    /**
     * @return integer | null
     */
    public function getOutgoingDdiRuleId()
    {
        if ($dto = $this->getOutgoingDdiRule()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto $voicemailNotificationTemplate
     *
     * @return static
     */
    public function setVoicemailNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto $voicemailNotificationTemplate = null)
    {
        $this->voicemailNotificationTemplate = $voicemailNotificationTemplate;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto
     */
    public function getVoicemailNotificationTemplate()
    {
        return $this->voicemailNotificationTemplate;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setVoicemailNotificationTemplateId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto($id)
            : null;

        return $this->setVoicemailNotificationTemplate($value);
    }

    /**
     * @return integer | null
     */
    public function getVoicemailNotificationTemplateId()
    {
        if ($dto = $this->getVoicemailNotificationTemplate()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto $faxNotificationTemplate
     *
     * @return static
     */
    public function setFaxNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto $faxNotificationTemplate = null)
    {
        $this->faxNotificationTemplate = $faxNotificationTemplate;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto
     */
    public function getFaxNotificationTemplate()
    {
        return $this->faxNotificationTemplate;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setFaxNotificationTemplateId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto($id)
            : null;

        return $this->setFaxNotificationTemplate($value);
    }

    /**
     * @return integer | null
     */
    public function getFaxNotificationTemplateId()
    {
        if ($dto = $this->getFaxNotificationTemplate()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto $invoiceNotificationTemplate
     *
     * @return static
     */
    public function setInvoiceNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto $invoiceNotificationTemplate = null)
    {
        $this->invoiceNotificationTemplate = $invoiceNotificationTemplate;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto
     */
    public function getInvoiceNotificationTemplate()
    {
        return $this->invoiceNotificationTemplate;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setInvoiceNotificationTemplateId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto($id)
            : null;

        return $this->setInvoiceNotificationTemplate($value);
    }

    /**
     * @return integer | null
     */
    public function getInvoiceNotificationTemplateId()
    {
        if ($dto = $this->getInvoiceNotificationTemplate()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto $callCsvNotificationTemplate
     *
     * @return static
     */
    public function setCallCsvNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto $callCsvNotificationTemplate = null)
    {
        $this->callCsvNotificationTemplate = $callCsvNotificationTemplate;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto
     */
    public function getCallCsvNotificationTemplate()
    {
        return $this->callCsvNotificationTemplate;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCallCsvNotificationTemplateId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto($id)
            : null;

        return $this->setCallCsvNotificationTemplate($value);
    }

    /**
     * @return integer | null
     */
    public function getCallCsvNotificationTemplateId()
    {
        if ($dto = $this->getCallCsvNotificationTemplate()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param array $extensions
     *
     * @return static
     */
    public function setExtensions($extensions = null)
    {
        $this->extensions = $extensions;

        return $this;
    }

    /**
     * @return array
     */
    public function getExtensions()
    {
        return $this->extensions;
    }

    /**
     * @param array $ddis
     *
     * @return static
     */
    public function setDdis($ddis = null)
    {
        $this->ddis = $ddis;

        return $this;
    }

    /**
     * @return array
     */
    public function getDdis()
    {
        return $this->ddis;
    }

    /**
     * @param array $friends
     *
     * @return static
     */
    public function setFriends($friends = null)
    {
        $this->friends = $friends;

        return $this;
    }

    /**
     * @return array
     */
    public function getFriends()
    {
        return $this->friends;
    }

    /**
     * @param array $companyServices
     *
     * @return static
     */
    public function setCompanyServices($companyServices = null)
    {
        $this->companyServices = $companyServices;

        return $this;
    }

    /**
     * @return array
     */
    public function getCompanyServices()
    {
        return $this->companyServices;
    }

    /**
     * @param array $terminals
     *
     * @return static
     */
    public function setTerminals($terminals = null)
    {
        $this->terminals = $terminals;

        return $this;
    }

    /**
     * @return array
     */
    public function getTerminals()
    {
        return $this->terminals;
    }

    /**
     * @param array $ratingProfiles
     *
     * @return static
     */
    public function setRatingProfiles($ratingProfiles = null)
    {
        $this->ratingProfiles = $ratingProfiles;

        return $this;
    }

    /**
     * @return array
     */
    public function getRatingProfiles()
    {
        return $this->ratingProfiles;
    }

    /**
     * @param array $musicsOnHold
     *
     * @return static
     */
    public function setMusicsOnHold($musicsOnHold = null)
    {
        $this->musicsOnHold = $musicsOnHold;

        return $this;
    }

    /**
     * @return array
     */
    public function getMusicsOnHold()
    {
        return $this->musicsOnHold;
    }

    /**
     * @param array $recordings
     *
     * @return static
     */
    public function setRecordings($recordings = null)
    {
        $this->recordings = $recordings;

        return $this;
    }

    /**
     * @return array
     */
    public function getRecordings()
    {
        return $this->recordings;
    }

    /**
     * @param array $relFeatures
     *
     * @return static
     */
    public function setRelFeatures($relFeatures = null)
    {
        $this->relFeatures = $relFeatures;

        return $this;
    }

    /**
     * @return array
     */
    public function getRelFeatures()
    {
        return $this->relFeatures;
    }

    /**
     * @param array $relCodecs
     *
     * @return static
     */
    public function setRelCodecs($relCodecs = null)
    {
        $this->relCodecs = $relCodecs;

        return $this;
    }

    /**
     * @return array
     */
    public function getRelCodecs()
    {
        return $this->relCodecs;
    }

    /**
     * @param array $relRoutingTags
     *
     * @return static
     */
    public function setRelRoutingTags($relRoutingTags = null)
    {
        $this->relRoutingTags = $relRoutingTags;

        return $this;
    }

    /**
     * @return array
     */
    public function getRelRoutingTags()
    {
        return $this->relRoutingTags;
    }
}
