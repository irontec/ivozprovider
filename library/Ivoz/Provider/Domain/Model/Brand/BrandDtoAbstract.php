<?php

namespace Ivoz\Provider\Domain\Model\Brand;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Domain\DomainDto;
use Ivoz\Provider\Domain\Model\Language\LanguageDto;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneDto;
use Ivoz\Provider\Domain\Model\Currency\CurrencyDto;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceDto;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalDto;
use Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandDto;
use Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrandDto;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldDto;
use Ivoz\Provider\Domain\Model\MatchList\MatchListDto;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto;

/**
* BrandDtoAbstract
* @codeCoverageIgnore
*/
abstract class BrandDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string | null
     */
    private $domainUsers;

    /**
     * @var int | null
     */
    private $recordingsLimitMB;

    /**
     * @var string | null
     */
    private $recordingsLimitEmail;

    /**
     * @var int
     */
    private $maxCalls = 0;

    /**
     * @var int
     */
    private $id;

    /**
     * @var int | null
     */
    private $logoFileSize;

    /**
     * @var string | null
     */
    private $logoMimeType;

    /**
     * @var string | null
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
     * @var string | null
     */
    private $invoiceRegistryData;

    /**
     * @var DomainDto | null
     */
    private $domain;

    /**
     * @var LanguageDto | null
     */
    private $language;

    /**
     * @var TimezoneDto | null
     */
    private $defaultTimezone;

    /**
     * @var CurrencyDto | null
     */
    private $currency;

    /**
     * @var NotificationTemplateDto | null
     */
    private $voicemailNotificationTemplate;

    /**
     * @var NotificationTemplateDto | null
     */
    private $faxNotificationTemplate;

    /**
     * @var NotificationTemplateDto | null
     */
    private $invoiceNotificationTemplate;

    /**
     * @var NotificationTemplateDto | null
     */
    private $callCsvNotificationTemplate;

    /**
     * @var NotificationTemplateDto | null
     */
    private $maxDailyUsageNotificationTemplate;

    /**
     * @var CompanyDto[] | null
     */
    private $companies;

    /**
     * @var BrandServiceDto[] | null
     */
    private $services;

    /**
     * @var WebPortalDto[] | null
     */
    private $urls;

    /**
     * @var FeaturesRelBrandDto[] | null
     */
    private $relFeatures;

    /**
     * @var ProxyTrunksRelBrandDto[] | null
     */
    private $relProxyTrunks;

    /**
     * @var ResidentialDeviceDto[] | null
     */
    private $residentialDevices;

    /**
     * @var MusicOnHoldDto[] | null
     */
    private $musicsOnHold;

    /**
     * @var MatchListDto[] | null
     */
    private $matchLists;

    /**
     * @var OutgoingRoutingDto[] | null
     */
    private $outgoingRoutings;

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
            'logo' => [
                'fileSize',
                'mimeType',
                'baseName',
            ],
            'invoice' => [
                'nif',
                'postalAddress',
                'postalCode',
                'town',
                'province',
                'country',
                'registryData',
            ],
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
                'baseName' => $this->getLogoBaseName(),
            ],
            'invoice' => [
                'nif' => $this->getInvoiceNif(),
                'postalAddress' => $this->getInvoicePostalAddress(),
                'postalCode' => $this->getInvoicePostalCode(),
                'town' => $this->getInvoiceTown(),
                'province' => $this->getInvoiceProvince(),
                'country' => $this->getInvoiceCountry(),
                'registryData' => $this->getInvoiceRegistryData(),
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
     * @param string $name | null
     *
     * @return static
     */
    public function setName(?string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $domainUsers | null
     *
     * @return static
     */
    public function setDomainUsers(?string $domainUsers = null): self
    {
        $this->domainUsers = $domainUsers;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDomainUsers(): ?string
    {
        return $this->domainUsers;
    }

    /**
     * @param int $recordingsLimitMB | null
     *
     * @return static
     */
    public function setRecordingsLimitMB(?int $recordingsLimitMB = null): self
    {
        $this->recordingsLimitMB = $recordingsLimitMB;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getRecordingsLimitMB(): ?int
    {
        return $this->recordingsLimitMB;
    }

    /**
     * @param string $recordingsLimitEmail | null
     *
     * @return static
     */
    public function setRecordingsLimitEmail(?string $recordingsLimitEmail = null): self
    {
        $this->recordingsLimitEmail = $recordingsLimitEmail;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRecordingsLimitEmail(): ?string
    {
        return $this->recordingsLimitEmail;
    }

    /**
     * @param int $maxCalls | null
     *
     * @return static
     */
    public function setMaxCalls(?int $maxCalls = null): self
    {
        $this->maxCalls = $maxCalls;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getMaxCalls(): ?int
    {
        return $this->maxCalls;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $logoFileSize | null
     *
     * @return static
     */
    public function setLogoFileSize(?int $logoFileSize = null): self
    {
        $this->logoFileSize = $logoFileSize;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getLogoFileSize(): ?int
    {
        return $this->logoFileSize;
    }

    /**
     * @param string $logoMimeType | null
     *
     * @return static
     */
    public function setLogoMimeType(?string $logoMimeType = null): self
    {
        $this->logoMimeType = $logoMimeType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLogoMimeType(): ?string
    {
        return $this->logoMimeType;
    }

    /**
     * @param string $logoBaseName | null
     *
     * @return static
     */
    public function setLogoBaseName(?string $logoBaseName = null): self
    {
        $this->logoBaseName = $logoBaseName;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLogoBaseName(): ?string
    {
        return $this->logoBaseName;
    }

    /**
     * @param string $invoiceNif | null
     *
     * @return static
     */
    public function setInvoiceNif(?string $invoiceNif = null): self
    {
        $this->invoiceNif = $invoiceNif;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getInvoiceNif(): ?string
    {
        return $this->invoiceNif;
    }

    /**
     * @param string $invoicePostalAddress | null
     *
     * @return static
     */
    public function setInvoicePostalAddress(?string $invoicePostalAddress = null): self
    {
        $this->invoicePostalAddress = $invoicePostalAddress;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getInvoicePostalAddress(): ?string
    {
        return $this->invoicePostalAddress;
    }

    /**
     * @param string $invoicePostalCode | null
     *
     * @return static
     */
    public function setInvoicePostalCode(?string $invoicePostalCode = null): self
    {
        $this->invoicePostalCode = $invoicePostalCode;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getInvoicePostalCode(): ?string
    {
        return $this->invoicePostalCode;
    }

    /**
     * @param string $invoiceTown | null
     *
     * @return static
     */
    public function setInvoiceTown(?string $invoiceTown = null): self
    {
        $this->invoiceTown = $invoiceTown;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getInvoiceTown(): ?string
    {
        return $this->invoiceTown;
    }

    /**
     * @param string $invoiceProvince | null
     *
     * @return static
     */
    public function setInvoiceProvince(?string $invoiceProvince = null): self
    {
        $this->invoiceProvince = $invoiceProvince;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getInvoiceProvince(): ?string
    {
        return $this->invoiceProvince;
    }

    /**
     * @param string $invoiceCountry | null
     *
     * @return static
     */
    public function setInvoiceCountry(?string $invoiceCountry = null): self
    {
        $this->invoiceCountry = $invoiceCountry;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getInvoiceCountry(): ?string
    {
        return $this->invoiceCountry;
    }

    /**
     * @param string $invoiceRegistryData | null
     *
     * @return static
     */
    public function setInvoiceRegistryData(?string $invoiceRegistryData = null): self
    {
        $this->invoiceRegistryData = $invoiceRegistryData;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getInvoiceRegistryData(): ?string
    {
        return $this->invoiceRegistryData;
    }

    /**
     * @param DomainDto | null
     *
     * @return static
     */
    public function setDomain(?DomainDto $domain = null): self
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return DomainDto | null
     */
    public function getDomain(): ?DomainDto
    {
        return $this->domain;
    }

    /**
     * @return static
     */
    public function setDomainId($id): self
    {
        $value = !is_null($id)
            ? new DomainDto($id)
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
     * @param LanguageDto | null
     *
     * @return static
     */
    public function setLanguage(?LanguageDto $language = null): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return LanguageDto | null
     */
    public function getLanguage(): ?LanguageDto
    {
        return $this->language;
    }

    /**
     * @return static
     */
    public function setLanguageId($id): self
    {
        $value = !is_null($id)
            ? new LanguageDto($id)
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
     * @param TimezoneDto | null
     *
     * @return static
     */
    public function setDefaultTimezone(?TimezoneDto $defaultTimezone = null): self
    {
        $this->defaultTimezone = $defaultTimezone;

        return $this;
    }

    /**
     * @return TimezoneDto | null
     */
    public function getDefaultTimezone(): ?TimezoneDto
    {
        return $this->defaultTimezone;
    }

    /**
     * @return static
     */
    public function setDefaultTimezoneId($id): self
    {
        $value = !is_null($id)
            ? new TimezoneDto($id)
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
     * @param CurrencyDto | null
     *
     * @return static
     */
    public function setCurrency(?CurrencyDto $currency = null): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return CurrencyDto | null
     */
    public function getCurrency(): ?CurrencyDto
    {
        return $this->currency;
    }

    /**
     * @return static
     */
    public function setCurrencyId($id): self
    {
        $value = !is_null($id)
            ? new CurrencyDto($id)
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
     * @param NotificationTemplateDto | null
     *
     * @return static
     */
    public function setVoicemailNotificationTemplate(?NotificationTemplateDto $voicemailNotificationTemplate = null): self
    {
        $this->voicemailNotificationTemplate = $voicemailNotificationTemplate;

        return $this;
    }

    /**
     * @return NotificationTemplateDto | null
     */
    public function getVoicemailNotificationTemplate(): ?NotificationTemplateDto
    {
        return $this->voicemailNotificationTemplate;
    }

    /**
     * @return static
     */
    public function setVoicemailNotificationTemplateId($id): self
    {
        $value = !is_null($id)
            ? new NotificationTemplateDto($id)
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
     * @param NotificationTemplateDto | null
     *
     * @return static
     */
    public function setFaxNotificationTemplate(?NotificationTemplateDto $faxNotificationTemplate = null): self
    {
        $this->faxNotificationTemplate = $faxNotificationTemplate;

        return $this;
    }

    /**
     * @return NotificationTemplateDto | null
     */
    public function getFaxNotificationTemplate(): ?NotificationTemplateDto
    {
        return $this->faxNotificationTemplate;
    }

    /**
     * @return static
     */
    public function setFaxNotificationTemplateId($id): self
    {
        $value = !is_null($id)
            ? new NotificationTemplateDto($id)
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
     * @param NotificationTemplateDto | null
     *
     * @return static
     */
    public function setInvoiceNotificationTemplate(?NotificationTemplateDto $invoiceNotificationTemplate = null): self
    {
        $this->invoiceNotificationTemplate = $invoiceNotificationTemplate;

        return $this;
    }

    /**
     * @return NotificationTemplateDto | null
     */
    public function getInvoiceNotificationTemplate(): ?NotificationTemplateDto
    {
        return $this->invoiceNotificationTemplate;
    }

    /**
     * @return static
     */
    public function setInvoiceNotificationTemplateId($id): self
    {
        $value = !is_null($id)
            ? new NotificationTemplateDto($id)
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
     * @param NotificationTemplateDto | null
     *
     * @return static
     */
    public function setCallCsvNotificationTemplate(?NotificationTemplateDto $callCsvNotificationTemplate = null): self
    {
        $this->callCsvNotificationTemplate = $callCsvNotificationTemplate;

        return $this;
    }

    /**
     * @return NotificationTemplateDto | null
     */
    public function getCallCsvNotificationTemplate(): ?NotificationTemplateDto
    {
        return $this->callCsvNotificationTemplate;
    }

    /**
     * @return static
     */
    public function setCallCsvNotificationTemplateId($id): self
    {
        $value = !is_null($id)
            ? new NotificationTemplateDto($id)
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
     * @param NotificationTemplateDto | null
     *
     * @return static
     */
    public function setMaxDailyUsageNotificationTemplate(?NotificationTemplateDto $maxDailyUsageNotificationTemplate = null): self
    {
        $this->maxDailyUsageNotificationTemplate = $maxDailyUsageNotificationTemplate;

        return $this;
    }

    /**
     * @return NotificationTemplateDto | null
     */
    public function getMaxDailyUsageNotificationTemplate(): ?NotificationTemplateDto
    {
        return $this->maxDailyUsageNotificationTemplate;
    }

    /**
     * @return static
     */
    public function setMaxDailyUsageNotificationTemplateId($id): self
    {
        $value = !is_null($id)
            ? new NotificationTemplateDto($id)
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
     * @param CompanyDto[] | null
     *
     * @return static
     */
    public function setCompanies(?array $companies = null): self
    {
        $this->companies = $companies;

        return $this;
    }

    /**
     * @return CompanyDto[] | null
     */
    public function getCompanies(): ?array
    {
        return $this->companies;
    }

    /**
     * @param BrandServiceDto[] | null
     *
     * @return static
     */
    public function setServices(?array $services = null): self
    {
        $this->services = $services;

        return $this;
    }

    /**
     * @return BrandServiceDto[] | null
     */
    public function getServices(): ?array
    {
        return $this->services;
    }

    /**
     * @param WebPortalDto[] | null
     *
     * @return static
     */
    public function setUrls(?array $urls = null): self
    {
        $this->urls = $urls;

        return $this;
    }

    /**
     * @return WebPortalDto[] | null
     */
    public function getUrls(): ?array
    {
        return $this->urls;
    }

    /**
     * @param FeaturesRelBrandDto[] | null
     *
     * @return static
     */
    public function setRelFeatures(?array $relFeatures = null): self
    {
        $this->relFeatures = $relFeatures;

        return $this;
    }

    /**
     * @return FeaturesRelBrandDto[] | null
     */
    public function getRelFeatures(): ?array
    {
        return $this->relFeatures;
    }

    /**
     * @param ProxyTrunksRelBrandDto[] | null
     *
     * @return static
     */
    public function setRelProxyTrunks(?array $relProxyTrunks = null): self
    {
        $this->relProxyTrunks = $relProxyTrunks;

        return $this;
    }

    /**
     * @return ProxyTrunksRelBrandDto[] | null
     */
    public function getRelProxyTrunks(): ?array
    {
        return $this->relProxyTrunks;
    }

    /**
     * @param ResidentialDeviceDto[] | null
     *
     * @return static
     */
    public function setResidentialDevices(?array $residentialDevices = null): self
    {
        $this->residentialDevices = $residentialDevices;

        return $this;
    }

    /**
     * @return ResidentialDeviceDto[] | null
     */
    public function getResidentialDevices(): ?array
    {
        return $this->residentialDevices;
    }

    /**
     * @param MusicOnHoldDto[] | null
     *
     * @return static
     */
    public function setMusicsOnHold(?array $musicsOnHold = null): self
    {
        $this->musicsOnHold = $musicsOnHold;

        return $this;
    }

    /**
     * @return MusicOnHoldDto[] | null
     */
    public function getMusicsOnHold(): ?array
    {
        return $this->musicsOnHold;
    }

    /**
     * @param MatchListDto[] | null
     *
     * @return static
     */
    public function setMatchLists(?array $matchLists = null): self
    {
        $this->matchLists = $matchLists;

        return $this;
    }

    /**
     * @return MatchListDto[] | null
     */
    public function getMatchLists(): ?array
    {
        return $this->matchLists;
    }

    /**
     * @param OutgoingRoutingDto[] | null
     *
     * @return static
     */
    public function setOutgoingRoutings(?array $outgoingRoutings = null): self
    {
        $this->outgoingRoutings = $outgoingRoutings;

        return $this;
    }

    /**
     * @return OutgoingRoutingDto[] | null
     */
    public function getOutgoingRoutings(): ?array
    {
        return $this->outgoingRoutings;
    }

}
