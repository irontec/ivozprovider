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
     * @var string|null
     */
    private $domainUsers;

    /**
     * @var int|null
     */
    private $recordingsLimitMB;

    /**
     * @var string|null
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
     * @var int|null
     */
    private $logoFileSize;

    /**
     * @var string|null
     */
    private $logoMimeType;

    /**
     * @var string|null
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
     * @var string|null
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

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setDomainUsers(?string $domainUsers): static
    {
        $this->domainUsers = $domainUsers;

        return $this;
    }

    public function getDomainUsers(): ?string
    {
        return $this->domainUsers;
    }

    public function setRecordingsLimitMB(?int $recordingsLimitMB): static
    {
        $this->recordingsLimitMB = $recordingsLimitMB;

        return $this;
    }

    public function getRecordingsLimitMB(): ?int
    {
        return $this->recordingsLimitMB;
    }

    public function setRecordingsLimitEmail(?string $recordingsLimitEmail): static
    {
        $this->recordingsLimitEmail = $recordingsLimitEmail;

        return $this;
    }

    public function getRecordingsLimitEmail(): ?string
    {
        return $this->recordingsLimitEmail;
    }

    public function setMaxCalls(int $maxCalls): static
    {
        $this->maxCalls = $maxCalls;

        return $this;
    }

    public function getMaxCalls(): ?int
    {
        return $this->maxCalls;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setLogoFileSize(?int $logoFileSize): static
    {
        $this->logoFileSize = $logoFileSize;

        return $this;
    }

    public function getLogoFileSize(): ?int
    {
        return $this->logoFileSize;
    }

    public function setLogoMimeType(?string $logoMimeType): static
    {
        $this->logoMimeType = $logoMimeType;

        return $this;
    }

    public function getLogoMimeType(): ?string
    {
        return $this->logoMimeType;
    }

    public function setLogoBaseName(?string $logoBaseName): static
    {
        $this->logoBaseName = $logoBaseName;

        return $this;
    }

    public function getLogoBaseName(): ?string
    {
        return $this->logoBaseName;
    }

    public function setInvoiceNif(string $invoiceNif): static
    {
        $this->invoiceNif = $invoiceNif;

        return $this;
    }

    public function getInvoiceNif(): ?string
    {
        return $this->invoiceNif;
    }

    public function setInvoicePostalAddress(string $invoicePostalAddress): static
    {
        $this->invoicePostalAddress = $invoicePostalAddress;

        return $this;
    }

    public function getInvoicePostalAddress(): ?string
    {
        return $this->invoicePostalAddress;
    }

    public function setInvoicePostalCode(string $invoicePostalCode): static
    {
        $this->invoicePostalCode = $invoicePostalCode;

        return $this;
    }

    public function getInvoicePostalCode(): ?string
    {
        return $this->invoicePostalCode;
    }

    public function setInvoiceTown(string $invoiceTown): static
    {
        $this->invoiceTown = $invoiceTown;

        return $this;
    }

    public function getInvoiceTown(): ?string
    {
        return $this->invoiceTown;
    }

    public function setInvoiceProvince(string $invoiceProvince): static
    {
        $this->invoiceProvince = $invoiceProvince;

        return $this;
    }

    public function getInvoiceProvince(): ?string
    {
        return $this->invoiceProvince;
    }

    public function setInvoiceCountry(string $invoiceCountry): static
    {
        $this->invoiceCountry = $invoiceCountry;

        return $this;
    }

    public function getInvoiceCountry(): ?string
    {
        return $this->invoiceCountry;
    }

    public function setInvoiceRegistryData(?string $invoiceRegistryData): static
    {
        $this->invoiceRegistryData = $invoiceRegistryData;

        return $this;
    }

    public function getInvoiceRegistryData(): ?string
    {
        return $this->invoiceRegistryData;
    }

    public function setDomain(?DomainDto $domain): static
    {
        $this->domain = $domain;

        return $this;
    }

    public function getDomain(): ?DomainDto
    {
        return $this->domain;
    }

    public function setDomainId($id): static
    {
        $value = !is_null($id)
            ? new DomainDto($id)
            : null;

        return $this->setDomain($value);
    }

    public function getDomainId()
    {
        if ($dto = $this->getDomain()) {
            return $dto->getId();
        }

        return null;
    }

    public function setLanguage(?LanguageDto $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getLanguage(): ?LanguageDto
    {
        return $this->language;
    }

    public function setLanguageId($id): static
    {
        $value = !is_null($id)
            ? new LanguageDto($id)
            : null;

        return $this->setLanguage($value);
    }

    public function getLanguageId()
    {
        if ($dto = $this->getLanguage()) {
            return $dto->getId();
        }

        return null;
    }

    public function setDefaultTimezone(?TimezoneDto $defaultTimezone): static
    {
        $this->defaultTimezone = $defaultTimezone;

        return $this;
    }

    public function getDefaultTimezone(): ?TimezoneDto
    {
        return $this->defaultTimezone;
    }

    public function setDefaultTimezoneId($id): static
    {
        $value = !is_null($id)
            ? new TimezoneDto($id)
            : null;

        return $this->setDefaultTimezone($value);
    }

    public function getDefaultTimezoneId()
    {
        if ($dto = $this->getDefaultTimezone()) {
            return $dto->getId();
        }

        return null;
    }

    public function setCurrency(?CurrencyDto $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getCurrency(): ?CurrencyDto
    {
        return $this->currency;
    }

    public function setCurrencyId($id): static
    {
        $value = !is_null($id)
            ? new CurrencyDto($id)
            : null;

        return $this->setCurrency($value);
    }

    public function getCurrencyId()
    {
        if ($dto = $this->getCurrency()) {
            return $dto->getId();
        }

        return null;
    }

    public function setVoicemailNotificationTemplate(?NotificationTemplateDto $voicemailNotificationTemplate): static
    {
        $this->voicemailNotificationTemplate = $voicemailNotificationTemplate;

        return $this;
    }

    public function getVoicemailNotificationTemplate(): ?NotificationTemplateDto
    {
        return $this->voicemailNotificationTemplate;
    }

    public function setVoicemailNotificationTemplateId($id): static
    {
        $value = !is_null($id)
            ? new NotificationTemplateDto($id)
            : null;

        return $this->setVoicemailNotificationTemplate($value);
    }

    public function getVoicemailNotificationTemplateId()
    {
        if ($dto = $this->getVoicemailNotificationTemplate()) {
            return $dto->getId();
        }

        return null;
    }

    public function setFaxNotificationTemplate(?NotificationTemplateDto $faxNotificationTemplate): static
    {
        $this->faxNotificationTemplate = $faxNotificationTemplate;

        return $this;
    }

    public function getFaxNotificationTemplate(): ?NotificationTemplateDto
    {
        return $this->faxNotificationTemplate;
    }

    public function setFaxNotificationTemplateId($id): static
    {
        $value = !is_null($id)
            ? new NotificationTemplateDto($id)
            : null;

        return $this->setFaxNotificationTemplate($value);
    }

    public function getFaxNotificationTemplateId()
    {
        if ($dto = $this->getFaxNotificationTemplate()) {
            return $dto->getId();
        }

        return null;
    }

    public function setInvoiceNotificationTemplate(?NotificationTemplateDto $invoiceNotificationTemplate): static
    {
        $this->invoiceNotificationTemplate = $invoiceNotificationTemplate;

        return $this;
    }

    public function getInvoiceNotificationTemplate(): ?NotificationTemplateDto
    {
        return $this->invoiceNotificationTemplate;
    }

    public function setInvoiceNotificationTemplateId($id): static
    {
        $value = !is_null($id)
            ? new NotificationTemplateDto($id)
            : null;

        return $this->setInvoiceNotificationTemplate($value);
    }

    public function getInvoiceNotificationTemplateId()
    {
        if ($dto = $this->getInvoiceNotificationTemplate()) {
            return $dto->getId();
        }

        return null;
    }

    public function setCallCsvNotificationTemplate(?NotificationTemplateDto $callCsvNotificationTemplate): static
    {
        $this->callCsvNotificationTemplate = $callCsvNotificationTemplate;

        return $this;
    }

    public function getCallCsvNotificationTemplate(): ?NotificationTemplateDto
    {
        return $this->callCsvNotificationTemplate;
    }

    public function setCallCsvNotificationTemplateId($id): static
    {
        $value = !is_null($id)
            ? new NotificationTemplateDto($id)
            : null;

        return $this->setCallCsvNotificationTemplate($value);
    }

    public function getCallCsvNotificationTemplateId()
    {
        if ($dto = $this->getCallCsvNotificationTemplate()) {
            return $dto->getId();
        }

        return null;
    }

    public function setMaxDailyUsageNotificationTemplate(?NotificationTemplateDto $maxDailyUsageNotificationTemplate): static
    {
        $this->maxDailyUsageNotificationTemplate = $maxDailyUsageNotificationTemplate;

        return $this;
    }

    public function getMaxDailyUsageNotificationTemplate(): ?NotificationTemplateDto
    {
        return $this->maxDailyUsageNotificationTemplate;
    }

    public function setMaxDailyUsageNotificationTemplateId($id): static
    {
        $value = !is_null($id)
            ? new NotificationTemplateDto($id)
            : null;

        return $this->setMaxDailyUsageNotificationTemplate($value);
    }

    public function getMaxDailyUsageNotificationTemplateId()
    {
        if ($dto = $this->getMaxDailyUsageNotificationTemplate()) {
            return $dto->getId();
        }

        return null;
    }

    public function setCompanies(?array $companies): static
    {
        $this->companies = $companies;

        return $this;
    }

    public function getCompanies(): ?array
    {
        return $this->companies;
    }

    public function setServices(?array $services): static
    {
        $this->services = $services;

        return $this;
    }

    public function getServices(): ?array
    {
        return $this->services;
    }

    public function setUrls(?array $urls): static
    {
        $this->urls = $urls;

        return $this;
    }

    public function getUrls(): ?array
    {
        return $this->urls;
    }

    public function setRelFeatures(?array $relFeatures): static
    {
        $this->relFeatures = $relFeatures;

        return $this;
    }

    public function getRelFeatures(): ?array
    {
        return $this->relFeatures;
    }

    public function setRelProxyTrunks(?array $relProxyTrunks): static
    {
        $this->relProxyTrunks = $relProxyTrunks;

        return $this;
    }

    public function getRelProxyTrunks(): ?array
    {
        return $this->relProxyTrunks;
    }

    public function setResidentialDevices(?array $residentialDevices): static
    {
        $this->residentialDevices = $residentialDevices;

        return $this;
    }

    public function getResidentialDevices(): ?array
    {
        return $this->residentialDevices;
    }

    public function setMusicsOnHold(?array $musicsOnHold): static
    {
        $this->musicsOnHold = $musicsOnHold;

        return $this;
    }

    public function getMusicsOnHold(): ?array
    {
        return $this->musicsOnHold;
    }

    public function setMatchLists(?array $matchLists): static
    {
        $this->matchLists = $matchLists;

        return $this;
    }

    public function getMatchLists(): ?array
    {
        return $this->matchLists;
    }

    public function setOutgoingRoutings(?array $outgoingRoutings): static
    {
        $this->outgoingRoutings = $outgoingRoutings;

        return $this;
    }

    public function getOutgoingRoutings(): ?array
    {
        return $this->outgoingRoutings;
    }
}
