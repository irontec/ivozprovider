<?php

namespace Ivoz\Provider\Domain\Model\Brand;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class BrandDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $domainUsers;

    /**
     * @var integer
     */
    private $recordingsLimitMB;

    /**
     * @var string
     */
    private $recordingsLimitEmail;

    /**
     * @var integer
     */
    private $maxCalls = 0;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $logoFileSize;

    /**
     * @var string
     */
    private $logoMimeType;

    /**
     * @var string
     */
    private $logoBaseName;

    /**
     * @var string
     */
    private $invoiceNif;

    /**
     * @var string
     */
    private $invoicePostalAddress;

    /**
     * @var string
     */
    private $invoicePostalCode;

    /**
     * @var string
     */
    private $invoiceTown;

    /**
     * @var string
     */
    private $invoiceProvince;

    /**
     * @var string
     */
    private $invoiceCountry;

    /**
     * @var string
     */
    private $invoiceRegistryData;

    /**
     * @var \Ivoz\Provider\Domain\Model\Domain\DomainDto | null
     */
    private $domain;

    /**
     * @var \Ivoz\Provider\Domain\Model\Language\LanguageDto | null
     */
    private $language;

    /**
     * @var \Ivoz\Provider\Domain\Model\Timezone\TimezoneDto | null
     */
    private $defaultTimezone;

    /**
     * @var \Ivoz\Provider\Domain\Model\Currency\CurrencyDto | null
     */
    private $currency;

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
     * @var \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto | null
     */
    private $maxDailyUsageNotificationTemplate;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto[] | null
     */
    private $companies = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\BrandService\BrandServiceDto[] | null
     */
    private $services = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\WebPortal\WebPortalDto[] | null
     */
    private $urls = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandDto[] | null
     */
    private $relFeatures = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrandDto[] | null
     */
    private $relProxyTrunks = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto[] | null
     */
    private $residentialDevices = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldDto[] | null
     */
    private $musicsOnHold = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\MatchList\MatchListDto[] | null
     */
    private $matchLists = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto[] | null
     */
    private $outgoingRoutings = null;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'name' => 'name',
            'domainUsers' => 'domainUsers',
            'recordingsLimitMB' => 'recordingsLimitMB',
            'recordingsLimitEmail' => 'recordingsLimitEmail',
            'maxCalls' => 'maxCalls',
            'id' => 'id',
            'logo' => ['fileSize','mimeType','baseName'],
            'invoice' => ['nif','postalAddress','postalCode','town','province','country','registryData'],
            'domainId' => 'domain',
            'languageId' => 'language',
            'defaultTimezoneId' => 'defaultTimezone',
            'currencyId' => 'currency',
            'voicemailNotificationTemplateId' => 'voicemailNotificationTemplate',
            'faxNotificationTemplateId' => 'faxNotificationTemplate',
            'invoiceNotificationTemplateId' => 'invoiceNotificationTemplate',
            'callCsvNotificationTemplateId' => 'callCsvNotificationTemplate',
            'maxDailyUsageNotificationTemplateId' => 'maxDailyUsageNotificationTemplate'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'name' => $this->getName(),
            'domainUsers' => $this->getDomainUsers(),
            'recordingsLimitMB' => $this->getRecordingsLimitMB(),
            'recordingsLimitEmail' => $this->getRecordingsLimitEmail(),
            'maxCalls' => $this->getMaxCalls(),
            'id' => $this->getId(),
            'logo' => [
                'fileSize' => $this->getLogoFileSize(),
                'mimeType' => $this->getLogoMimeType(),
                'baseName' => $this->getLogoBaseName()
            ],
            'invoice' => [
                'nif' => $this->getInvoiceNif(),
                'postalAddress' => $this->getInvoicePostalAddress(),
                'postalCode' => $this->getInvoicePostalCode(),
                'town' => $this->getInvoiceTown(),
                'province' => $this->getInvoiceProvince(),
                'country' => $this->getInvoiceCountry(),
                'registryData' => $this->getInvoiceRegistryData()
            ],
            'domain' => $this->getDomain(),
            'language' => $this->getLanguage(),
            'defaultTimezone' => $this->getDefaultTimezone(),
            'currency' => $this->getCurrency(),
            'voicemailNotificationTemplate' => $this->getVoicemailNotificationTemplate(),
            'faxNotificationTemplate' => $this->getFaxNotificationTemplate(),
            'invoiceNotificationTemplate' => $this->getInvoiceNotificationTemplate(),
            'callCsvNotificationTemplate' => $this->getCallCsvNotificationTemplate(),
            'maxDailyUsageNotificationTemplate' => $this->getMaxDailyUsageNotificationTemplate(),
            'companies' => $this->getCompanies(),
            'services' => $this->getServices(),
            'urls' => $this->getUrls(),
            'relFeatures' => $this->getRelFeatures(),
            'relProxyTrunks' => $this->getRelProxyTrunks(),
            'residentialDevices' => $this->getResidentialDevices(),
            'musicsOnHold' => $this->getMusicsOnHold(),
            'matchLists' => $this->getMatchLists(),
            'outgoingRoutings' => $this->getOutgoingRoutings()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
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
     * @return string | null
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
     * @return string | null
     */
    public function getDomainUsers()
    {
        return $this->domainUsers;
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
     * @return integer | null
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
     * @return string | null
     */
    public function getRecordingsLimitEmail()
    {
        return $this->recordingsLimitEmail;
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
     * @return integer | null
     */
    public function getMaxCalls()
    {
        return $this->maxCalls;
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
     * @return integer | null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $logoFileSize
     *
     * @return static
     */
    public function setLogoFileSize($logoFileSize = null)
    {
        $this->logoFileSize = $logoFileSize;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getLogoFileSize()
    {
        return $this->logoFileSize;
    }

    /**
     * @param string $logoMimeType
     *
     * @return static
     */
    public function setLogoMimeType($logoMimeType = null)
    {
        $this->logoMimeType = $logoMimeType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLogoMimeType()
    {
        return $this->logoMimeType;
    }

    /**
     * @param string $logoBaseName
     *
     * @return static
     */
    public function setLogoBaseName($logoBaseName = null)
    {
        $this->logoBaseName = $logoBaseName;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLogoBaseName()
    {
        return $this->logoBaseName;
    }

    /**
     * @param string $invoiceNif
     *
     * @return static
     */
    public function setInvoiceNif($invoiceNif = null)
    {
        $this->invoiceNif = $invoiceNif;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getInvoiceNif()
    {
        return $this->invoiceNif;
    }

    /**
     * @param string $invoicePostalAddress
     *
     * @return static
     */
    public function setInvoicePostalAddress($invoicePostalAddress = null)
    {
        $this->invoicePostalAddress = $invoicePostalAddress;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getInvoicePostalAddress()
    {
        return $this->invoicePostalAddress;
    }

    /**
     * @param string $invoicePostalCode
     *
     * @return static
     */
    public function setInvoicePostalCode($invoicePostalCode = null)
    {
        $this->invoicePostalCode = $invoicePostalCode;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getInvoicePostalCode()
    {
        return $this->invoicePostalCode;
    }

    /**
     * @param string $invoiceTown
     *
     * @return static
     */
    public function setInvoiceTown($invoiceTown = null)
    {
        $this->invoiceTown = $invoiceTown;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getInvoiceTown()
    {
        return $this->invoiceTown;
    }

    /**
     * @param string $invoiceProvince
     *
     * @return static
     */
    public function setInvoiceProvince($invoiceProvince = null)
    {
        $this->invoiceProvince = $invoiceProvince;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getInvoiceProvince()
    {
        return $this->invoiceProvince;
    }

    /**
     * @param string $invoiceCountry
     *
     * @return static
     */
    public function setInvoiceCountry($invoiceCountry = null)
    {
        $this->invoiceCountry = $invoiceCountry;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getInvoiceCountry()
    {
        return $this->invoiceCountry;
    }

    /**
     * @param string $invoiceRegistryData
     *
     * @return static
     */
    public function setInvoiceRegistryData($invoiceRegistryData = null)
    {
        $this->invoiceRegistryData = $invoiceRegistryData;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getInvoiceRegistryData()
    {
        return $this->invoiceRegistryData;
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
     * @return \Ivoz\Provider\Domain\Model\Domain\DomainDto | null
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param mixed | null $id
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
     * @return mixed | null
     */
    public function getDomainId()
    {
        if ($dto = $this->getDomain()) {
            return $dto->getId();
        }

        return null;
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
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageDto | null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed | null $id
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
     * @return mixed | null
     */
    public function getLanguageId()
    {
        if ($dto = $this->getLanguage()) {
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
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneDto | null
     */
    public function getDefaultTimezone()
    {
        return $this->defaultTimezone;
    }

    /**
     * @param mixed | null $id
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
     * @return mixed | null
     */
    public function getDefaultTimezoneId()
    {
        if ($dto = $this->getDefaultTimezone()) {
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
     * @return \Ivoz\Provider\Domain\Model\Currency\CurrencyDto | null
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed | null $id
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
     * @return mixed | null
     */
    public function getCurrencyId()
    {
        if ($dto = $this->getCurrency()) {
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
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto | null
     */
    public function getVoicemailNotificationTemplate()
    {
        return $this->voicemailNotificationTemplate;
    }

    /**
     * @param mixed | null $id
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
     * @return mixed | null
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
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto | null
     */
    public function getFaxNotificationTemplate()
    {
        return $this->faxNotificationTemplate;
    }

    /**
     * @param mixed | null $id
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
     * @return mixed | null
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
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto | null
     */
    public function getInvoiceNotificationTemplate()
    {
        return $this->invoiceNotificationTemplate;
    }

    /**
     * @param mixed | null $id
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
     * @return mixed | null
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
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto | null
     */
    public function getCallCsvNotificationTemplate()
    {
        return $this->callCsvNotificationTemplate;
    }

    /**
     * @param mixed | null $id
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
     * @return mixed | null
     */
    public function getCallCsvNotificationTemplateId()
    {
        if ($dto = $this->getCallCsvNotificationTemplate()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto $maxDailyUsageNotificationTemplate
     *
     * @return static
     */
    public function setMaxDailyUsageNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto $maxDailyUsageNotificationTemplate = null)
    {
        $this->maxDailyUsageNotificationTemplate = $maxDailyUsageNotificationTemplate;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto | null
     */
    public function getMaxDailyUsageNotificationTemplate()
    {
        return $this->maxDailyUsageNotificationTemplate;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setMaxDailyUsageNotificationTemplateId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto($id)
            : null;

        return $this->setMaxDailyUsageNotificationTemplate($value);
    }

    /**
     * @return mixed | null
     */
    public function getMaxDailyUsageNotificationTemplateId()
    {
        if ($dto = $this->getMaxDailyUsageNotificationTemplate()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param array $companies
     *
     * @return static
     */
    public function setCompanies($companies = null)
    {
        $this->companies = $companies;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getCompanies()
    {
        return $this->companies;
    }

    /**
     * @param array $services
     *
     * @return static
     */
    public function setServices($services = null)
    {
        $this->services = $services;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @param array $urls
     *
     * @return static
     */
    public function setUrls($urls = null)
    {
        $this->urls = $urls;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getUrls()
    {
        return $this->urls;
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
     * @return array | null
     */
    public function getRelFeatures()
    {
        return $this->relFeatures;
    }

    /**
     * @param array $relProxyTrunks
     *
     * @return static
     */
    public function setRelProxyTrunks($relProxyTrunks = null)
    {
        $this->relProxyTrunks = $relProxyTrunks;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getRelProxyTrunks()
    {
        return $this->relProxyTrunks;
    }

    /**
     * @param array $residentialDevices
     *
     * @return static
     */
    public function setResidentialDevices($residentialDevices = null)
    {
        $this->residentialDevices = $residentialDevices;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getResidentialDevices()
    {
        return $this->residentialDevices;
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
     * @return array | null
     */
    public function getMusicsOnHold()
    {
        return $this->musicsOnHold;
    }

    /**
     * @param array $matchLists
     *
     * @return static
     */
    public function setMatchLists($matchLists = null)
    {
        $this->matchLists = $matchLists;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getMatchLists()
    {
        return $this->matchLists;
    }

    /**
     * @param array $outgoingRoutings
     *
     * @return static
     */
    public function setOutgoingRoutings($outgoingRoutings = null)
    {
        $this->outgoingRoutings = $outgoingRoutings;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getOutgoingRoutings()
    {
        return $this->outgoingRoutings;
    }
}
