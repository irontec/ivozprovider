<?php

namespace Ivoz\Provider\Domain\Model\Company;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Language\LanguageDto;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneDto;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Domain\DomainDto;
use Ivoz\Provider\Domain\Model\Country\CountryDto;
use Ivoz\Provider\Domain\Model\Currency\CurrencyDto;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto;
use Ivoz\Provider\Domain\Model\Corporation\CorporationDto;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSetDto;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetDto;
use Ivoz\Provider\Domain\Model\Location\LocationDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\Friend\FriendDto;
use Ivoz\Provider\Domain\Model\Contact\ContactDto;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceDto;
use Ivoz\Provider\Domain\Model\Terminal\TerminalDto;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileDto;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldDto;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailDto;
use Ivoz\Provider\Domain\Model\Recording\RecordingDto;
use Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyDto;
use Ivoz\Provider\Domain\Model\CompanyRelGeoIPCountry\CompanyRelGeoIPCountryDto;
use Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecDto;
use Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagDto;

/**
* CompanyDtoAbstract
* @codeCoverageIgnore
*/
abstract class CompanyDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $type = 'vpbx';

    /**
     * @var string|null
     */
    private $name = null;

    /**
     * @var string|null
     */
    private $domainUsers = null;

    /**
     * @var string|null
     */
    private $distributeMethod = 'hash';

    /**
     * @var int|null
     */
    private $maxCalls = 0;

    /**
     * @var int|null
     */
    private $maxDailyUsage = 1000000;

    /**
     * @var float|null
     */
    private $currentDayUsage = 0;

    /**
     * @var string|null
     */
    private $maxDailyUsageEmail = null;

    /**
     * @var bool|null
     */
    private $ipfilter = true;

    /**
     * @var int|null
     */
    private $onDemandRecord = 0;

    /**
     * @var bool|null
     */
    private $allowRecordingRemoval = true;

    /**
     * @var string|null
     */
    private $onDemandRecordCode = null;

    /**
     * @var string|null
     */
    private $externallyextraopts = null;

    /**
     * @var int|null
     */
    private $recordingsLimitMB = null;

    /**
     * @var string|null
     */
    private $recordingsLimitEmail = null;

    /**
     * @var string|null
     */
    private $billingMethod = 'postpaid';

    /**
     * @var float|null
     */
    private $balance = 0;

    /**
     * @var bool|null
     */
    private $showInvoices = false;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var string|null
     */
    private $invoicingNif = '';

    /**
     * @var string|null
     */
    private $invoicingPostalAddress = '';

    /**
     * @var string|null
     */
    private $invoicingPostalCode = '';

    /**
     * @var string|null
     */
    private $invoicingTown = '';

    /**
     * @var string|null
     */
    private $invoicingProvince = '';

    /**
     * @var string|null
     */
    private $invoicingCountryName = '';

    /**
     * @var LanguageDto | null
     */
    private $language = null;

    /**
     * @var TimezoneDto | null
     */
    private $defaultTimezone = null;

    /**
     * @var BrandDto | null
     */
    private $brand = null;

    /**
     * @var DomainDto | null
     */
    private $domain = null;

    /**
     * @var CountryDto | null
     */
    private $country = null;

    /**
     * @var CurrencyDto | null
     */
    private $currency = null;

    /**
     * @var TransformationRuleSetDto | null
     */
    private $transformationRuleSet = null;

    /**
     * @var DdiDto | null
     */
    private $outgoingDdi = null;

    /**
     * @var OutgoingDdiRuleDto | null
     */
    private $outgoingDdiRule = null;

    /**
     * @var NotificationTemplateDto | null
     */
    private $voicemailNotificationTemplate = null;

    /**
     * @var NotificationTemplateDto | null
     */
    private $faxNotificationTemplate = null;

    /**
     * @var NotificationTemplateDto | null
     */
    private $invoiceNotificationTemplate = null;

    /**
     * @var NotificationTemplateDto | null
     */
    private $callCsvNotificationTemplate = null;

    /**
     * @var NotificationTemplateDto | null
     */
    private $maxDailyUsageNotificationTemplate = null;

    /**
     * @var NotificationTemplateDto | null
     */
    private $accessCredentialNotificationTemplate = null;

    /**
     * @var CorporationDto | null
     */
    private $corporation = null;

    /**
     * @var ApplicationServerSetDto | null
     */
    private $applicationServerSet = null;

    /**
     * @var MediaRelaySetDto | null
     */
    private $mediaRelaySet = null;

    /**
     * @var LocationDto | null
     */
    private $location = null;

    /**
     * @var ExtensionDto[] | null
     */
    private $extensions = null;

    /**
     * @var DdiDto[] | null
     */
    private $ddis = null;

    /**
     * @var FriendDto[] | null
     */
    private $friends = null;

    /**
     * @var ContactDto[] | null
     */
    private $contacts = null;

    /**
     * @var CompanyServiceDto[] | null
     */
    private $companyServices = null;

    /**
     * @var TerminalDto[] | null
     */
    private $terminals = null;

    /**
     * @var RatingProfileDto[] | null
     */
    private $ratingProfiles = null;

    /**
     * @var MusicOnHoldDto[] | null
     */
    private $musicsOnHold = null;

    /**
     * @var VoicemailDto[] | null
     */
    private $voicemails = null;

    /**
     * @var RecordingDto[] | null
     */
    private $recordings = null;

    /**
     * @var FeaturesRelCompanyDto[] | null
     */
    private $relFeatures = null;

    /**
     * @var CompanyRelGeoIPCountryDto[] | null
     */
    private $relCountries = null;

    /**
     * @var CompanyRelCodecDto[] | null
     */
    private $relCodecs = null;

    /**
     * @var CompanyRelRoutingTagDto[] | null
     */
    private $relRoutingTags = null;

    public function __construct(?int $id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'type' => 'type',
            'name' => 'name',
            'domainUsers' => 'domainUsers',
            'distributeMethod' => 'distributeMethod',
            'maxCalls' => 'maxCalls',
            'maxDailyUsage' => 'maxDailyUsage',
            'currentDayUsage' => 'currentDayUsage',
            'maxDailyUsageEmail' => 'maxDailyUsageEmail',
            'ipfilter' => 'ipfilter',
            'onDemandRecord' => 'onDemandRecord',
            'allowRecordingRemoval' => 'allowRecordingRemoval',
            'onDemandRecordCode' => 'onDemandRecordCode',
            'externallyextraopts' => 'externallyextraopts',
            'recordingsLimitMB' => 'recordingsLimitMB',
            'recordingsLimitEmail' => 'recordingsLimitEmail',
            'billingMethod' => 'billingMethod',
            'balance' => 'balance',
            'showInvoices' => 'showInvoices',
            'id' => 'id',
            'invoicing' => [
                'nif',
                'postalAddress',
                'postalCode',
                'town',
                'province',
                'countryName',
            ],
            'languageId' => 'language',
            'defaultTimezoneId' => 'defaultTimezone',
            'brandId' => 'brand',
            'domainId' => 'domain',
            'countryId' => 'country',
            'currencyId' => 'currency',
            'transformationRuleSetId' => 'transformationRuleSet',
            'outgoingDdiId' => 'outgoingDdi',
            'outgoingDdiRuleId' => 'outgoingDdiRule',
            'voicemailNotificationTemplateId' => 'voicemailNotificationTemplate',
            'faxNotificationTemplateId' => 'faxNotificationTemplate',
            'invoiceNotificationTemplateId' => 'invoiceNotificationTemplate',
            'callCsvNotificationTemplateId' => 'callCsvNotificationTemplate',
            'maxDailyUsageNotificationTemplateId' => 'maxDailyUsageNotificationTemplate',
            'accessCredentialNotificationTemplateId' => 'accessCredentialNotificationTemplate',
            'corporationId' => 'corporation',
            'applicationServerSetId' => 'applicationServerSet',
            'mediaRelaySetId' => 'mediaRelaySet',
            'locationId' => 'location'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'type' => $this->getType(),
            'name' => $this->getName(),
            'domainUsers' => $this->getDomainUsers(),
            'distributeMethod' => $this->getDistributeMethod(),
            'maxCalls' => $this->getMaxCalls(),
            'maxDailyUsage' => $this->getMaxDailyUsage(),
            'currentDayUsage' => $this->getCurrentDayUsage(),
            'maxDailyUsageEmail' => $this->getMaxDailyUsageEmail(),
            'ipfilter' => $this->getIpfilter(),
            'onDemandRecord' => $this->getOnDemandRecord(),
            'allowRecordingRemoval' => $this->getAllowRecordingRemoval(),
            'onDemandRecordCode' => $this->getOnDemandRecordCode(),
            'externallyextraopts' => $this->getExternallyextraopts(),
            'recordingsLimitMB' => $this->getRecordingsLimitMB(),
            'recordingsLimitEmail' => $this->getRecordingsLimitEmail(),
            'billingMethod' => $this->getBillingMethod(),
            'balance' => $this->getBalance(),
            'showInvoices' => $this->getShowInvoices(),
            'id' => $this->getId(),
            'invoicing' => [
                'nif' => $this->getInvoicingNif(),
                'postalAddress' => $this->getInvoicingPostalAddress(),
                'postalCode' => $this->getInvoicingPostalCode(),
                'town' => $this->getInvoicingTown(),
                'province' => $this->getInvoicingProvince(),
                'countryName' => $this->getInvoicingCountryName(),
            ],
            'language' => $this->getLanguage(),
            'defaultTimezone' => $this->getDefaultTimezone(),
            'brand' => $this->getBrand(),
            'domain' => $this->getDomain(),
            'country' => $this->getCountry(),
            'currency' => $this->getCurrency(),
            'transformationRuleSet' => $this->getTransformationRuleSet(),
            'outgoingDdi' => $this->getOutgoingDdi(),
            'outgoingDdiRule' => $this->getOutgoingDdiRule(),
            'voicemailNotificationTemplate' => $this->getVoicemailNotificationTemplate(),
            'faxNotificationTemplate' => $this->getFaxNotificationTemplate(),
            'invoiceNotificationTemplate' => $this->getInvoiceNotificationTemplate(),
            'callCsvNotificationTemplate' => $this->getCallCsvNotificationTemplate(),
            'maxDailyUsageNotificationTemplate' => $this->getMaxDailyUsageNotificationTemplate(),
            'accessCredentialNotificationTemplate' => $this->getAccessCredentialNotificationTemplate(),
            'corporation' => $this->getCorporation(),
            'applicationServerSet' => $this->getApplicationServerSet(),
            'mediaRelaySet' => $this->getMediaRelaySet(),
            'location' => $this->getLocation(),
            'extensions' => $this->getExtensions(),
            'ddis' => $this->getDdis(),
            'friends' => $this->getFriends(),
            'contacts' => $this->getContacts(),
            'companyServices' => $this->getCompanyServices(),
            'terminals' => $this->getTerminals(),
            'ratingProfiles' => $this->getRatingProfiles(),
            'musicsOnHold' => $this->getMusicsOnHold(),
            'voicemails' => $this->getVoicemails(),
            'recordings' => $this->getRecordings(),
            'relFeatures' => $this->getRelFeatures(),
            'relCountries' => $this->getRelCountries(),
            'relCodecs' => $this->getRelCodecs(),
            'relRoutingTags' => $this->getRelRoutingTags()
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

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
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

    public function setDistributeMethod(string $distributeMethod): static
    {
        $this->distributeMethod = $distributeMethod;

        return $this;
    }

    public function getDistributeMethod(): ?string
    {
        return $this->distributeMethod;
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

    public function setMaxDailyUsage(int $maxDailyUsage): static
    {
        $this->maxDailyUsage = $maxDailyUsage;

        return $this;
    }

    public function getMaxDailyUsage(): ?int
    {
        return $this->maxDailyUsage;
    }

    public function setCurrentDayUsage(?float $currentDayUsage): static
    {
        $this->currentDayUsage = $currentDayUsage;

        return $this;
    }

    public function getCurrentDayUsage(): ?float
    {
        return $this->currentDayUsage;
    }

    public function setMaxDailyUsageEmail(?string $maxDailyUsageEmail): static
    {
        $this->maxDailyUsageEmail = $maxDailyUsageEmail;

        return $this;
    }

    public function getMaxDailyUsageEmail(): ?string
    {
        return $this->maxDailyUsageEmail;
    }

    public function setIpfilter(?bool $ipfilter): static
    {
        $this->ipfilter = $ipfilter;

        return $this;
    }

    public function getIpfilter(): ?bool
    {
        return $this->ipfilter;
    }

    public function setOnDemandRecord(?int $onDemandRecord): static
    {
        $this->onDemandRecord = $onDemandRecord;

        return $this;
    }

    public function getOnDemandRecord(): ?int
    {
        return $this->onDemandRecord;
    }

    public function setAllowRecordingRemoval(bool $allowRecordingRemoval): static
    {
        $this->allowRecordingRemoval = $allowRecordingRemoval;

        return $this;
    }

    public function getAllowRecordingRemoval(): ?bool
    {
        return $this->allowRecordingRemoval;
    }

    public function setOnDemandRecordCode(?string $onDemandRecordCode): static
    {
        $this->onDemandRecordCode = $onDemandRecordCode;

        return $this;
    }

    public function getOnDemandRecordCode(): ?string
    {
        return $this->onDemandRecordCode;
    }

    public function setExternallyextraopts(?string $externallyextraopts): static
    {
        $this->externallyextraopts = $externallyextraopts;

        return $this;
    }

    public function getExternallyextraopts(): ?string
    {
        return $this->externallyextraopts;
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

    public function setBillingMethod(string $billingMethod): static
    {
        $this->billingMethod = $billingMethod;

        return $this;
    }

    public function getBillingMethod(): ?string
    {
        return $this->billingMethod;
    }

    public function setBalance(?float $balance): static
    {
        $this->balance = $balance;

        return $this;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    public function setShowInvoices(?bool $showInvoices): static
    {
        $this->showInvoices = $showInvoices;

        return $this;
    }

    public function getShowInvoices(): ?bool
    {
        return $this->showInvoices;
    }

    /**
     * @param int|null $id
     */
    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setInvoicingNif(string $invoicingNif): static
    {
        $this->invoicingNif = $invoicingNif;

        return $this;
    }

    public function getInvoicingNif(): ?string
    {
        return $this->invoicingNif;
    }

    public function setInvoicingPostalAddress(string $invoicingPostalAddress): static
    {
        $this->invoicingPostalAddress = $invoicingPostalAddress;

        return $this;
    }

    public function getInvoicingPostalAddress(): ?string
    {
        return $this->invoicingPostalAddress;
    }

    public function setInvoicingPostalCode(string $invoicingPostalCode): static
    {
        $this->invoicingPostalCode = $invoicingPostalCode;

        return $this;
    }

    public function getInvoicingPostalCode(): ?string
    {
        return $this->invoicingPostalCode;
    }

    public function setInvoicingTown(string $invoicingTown): static
    {
        $this->invoicingTown = $invoicingTown;

        return $this;
    }

    public function getInvoicingTown(): ?string
    {
        return $this->invoicingTown;
    }

    public function setInvoicingProvince(string $invoicingProvince): static
    {
        $this->invoicingProvince = $invoicingProvince;

        return $this;
    }

    public function getInvoicingProvince(): ?string
    {
        return $this->invoicingProvince;
    }

    public function setInvoicingCountryName(string $invoicingCountryName): static
    {
        $this->invoicingCountryName = $invoicingCountryName;

        return $this;
    }

    public function getInvoicingCountryName(): ?string
    {
        return $this->invoicingCountryName;
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

    public function setLanguageId(?int $id): static
    {
        $value = !is_null($id)
            ? new LanguageDto($id)
            : null;

        return $this->setLanguage($value);
    }

    public function getLanguageId(): ?int
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

    public function setDefaultTimezoneId(?int $id): static
    {
        $value = !is_null($id)
            ? new TimezoneDto($id)
            : null;

        return $this->setDefaultTimezone($value);
    }

    public function getDefaultTimezoneId(): ?int
    {
        if ($dto = $this->getDefaultTimezone()) {
            return $dto->getId();
        }

        return null;
    }

    public function setBrand(?BrandDto $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    public function setBrandId(?int $id): static
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    public function getBrandId(): ?int
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
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

    public function setDomainId(?int $id): static
    {
        $value = !is_null($id)
            ? new DomainDto($id)
            : null;

        return $this->setDomain($value);
    }

    public function getDomainId(): ?int
    {
        if ($dto = $this->getDomain()) {
            return $dto->getId();
        }

        return null;
    }

    public function setCountry(?CountryDto $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getCountry(): ?CountryDto
    {
        return $this->country;
    }

    public function setCountryId(?int $id): static
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setCountry($value);
    }

    public function getCountryId(): ?int
    {
        if ($dto = $this->getCountry()) {
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

    public function setCurrencyId(?int $id): static
    {
        $value = !is_null($id)
            ? new CurrencyDto($id)
            : null;

        return $this->setCurrency($value);
    }

    public function getCurrencyId(): ?int
    {
        if ($dto = $this->getCurrency()) {
            return $dto->getId();
        }

        return null;
    }

    public function setTransformationRuleSet(?TransformationRuleSetDto $transformationRuleSet): static
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    public function getTransformationRuleSet(): ?TransformationRuleSetDto
    {
        return $this->transformationRuleSet;
    }

    public function setTransformationRuleSetId(?int $id): static
    {
        $value = !is_null($id)
            ? new TransformationRuleSetDto($id)
            : null;

        return $this->setTransformationRuleSet($value);
    }

    public function getTransformationRuleSetId(): ?int
    {
        if ($dto = $this->getTransformationRuleSet()) {
            return $dto->getId();
        }

        return null;
    }

    public function setOutgoingDdi(?DdiDto $outgoingDdi): static
    {
        $this->outgoingDdi = $outgoingDdi;

        return $this;
    }

    public function getOutgoingDdi(): ?DdiDto
    {
        return $this->outgoingDdi;
    }

    public function setOutgoingDdiId(?int $id): static
    {
        $value = !is_null($id)
            ? new DdiDto($id)
            : null;

        return $this->setOutgoingDdi($value);
    }

    public function getOutgoingDdiId(): ?int
    {
        if ($dto = $this->getOutgoingDdi()) {
            return $dto->getId();
        }

        return null;
    }

    public function setOutgoingDdiRule(?OutgoingDdiRuleDto $outgoingDdiRule): static
    {
        $this->outgoingDdiRule = $outgoingDdiRule;

        return $this;
    }

    public function getOutgoingDdiRule(): ?OutgoingDdiRuleDto
    {
        return $this->outgoingDdiRule;
    }

    public function setOutgoingDdiRuleId(?int $id): static
    {
        $value = !is_null($id)
            ? new OutgoingDdiRuleDto($id)
            : null;

        return $this->setOutgoingDdiRule($value);
    }

    public function getOutgoingDdiRuleId(): ?int
    {
        if ($dto = $this->getOutgoingDdiRule()) {
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

    public function setVoicemailNotificationTemplateId(?int $id): static
    {
        $value = !is_null($id)
            ? new NotificationTemplateDto($id)
            : null;

        return $this->setVoicemailNotificationTemplate($value);
    }

    public function getVoicemailNotificationTemplateId(): ?int
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

    public function setFaxNotificationTemplateId(?int $id): static
    {
        $value = !is_null($id)
            ? new NotificationTemplateDto($id)
            : null;

        return $this->setFaxNotificationTemplate($value);
    }

    public function getFaxNotificationTemplateId(): ?int
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

    public function setInvoiceNotificationTemplateId(?int $id): static
    {
        $value = !is_null($id)
            ? new NotificationTemplateDto($id)
            : null;

        return $this->setInvoiceNotificationTemplate($value);
    }

    public function getInvoiceNotificationTemplateId(): ?int
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

    public function setCallCsvNotificationTemplateId(?int $id): static
    {
        $value = !is_null($id)
            ? new NotificationTemplateDto($id)
            : null;

        return $this->setCallCsvNotificationTemplate($value);
    }

    public function getCallCsvNotificationTemplateId(): ?int
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

    public function setMaxDailyUsageNotificationTemplateId(?int $id): static
    {
        $value = !is_null($id)
            ? new NotificationTemplateDto($id)
            : null;

        return $this->setMaxDailyUsageNotificationTemplate($value);
    }

    public function getMaxDailyUsageNotificationTemplateId(): ?int
    {
        if ($dto = $this->getMaxDailyUsageNotificationTemplate()) {
            return $dto->getId();
        }

        return null;
    }

    public function setAccessCredentialNotificationTemplate(?NotificationTemplateDto $accessCredentialNotificationTemplate): static
    {
        $this->accessCredentialNotificationTemplate = $accessCredentialNotificationTemplate;

        return $this;
    }

    public function getAccessCredentialNotificationTemplate(): ?NotificationTemplateDto
    {
        return $this->accessCredentialNotificationTemplate;
    }

    public function setAccessCredentialNotificationTemplateId(?int $id): static
    {
        $value = !is_null($id)
            ? new NotificationTemplateDto($id)
            : null;

        return $this->setAccessCredentialNotificationTemplate($value);
    }

    public function getAccessCredentialNotificationTemplateId(): ?int
    {
        if ($dto = $this->getAccessCredentialNotificationTemplate()) {
            return $dto->getId();
        }

        return null;
    }

    public function setCorporation(?CorporationDto $corporation): static
    {
        $this->corporation = $corporation;

        return $this;
    }

    public function getCorporation(): ?CorporationDto
    {
        return $this->corporation;
    }

    public function setCorporationId(?int $id): static
    {
        $value = !is_null($id)
            ? new CorporationDto($id)
            : null;

        return $this->setCorporation($value);
    }

    public function getCorporationId(): ?int
    {
        if ($dto = $this->getCorporation()) {
            return $dto->getId();
        }

        return null;
    }

    public function setApplicationServerSet(?ApplicationServerSetDto $applicationServerSet): static
    {
        $this->applicationServerSet = $applicationServerSet;

        return $this;
    }

    public function getApplicationServerSet(): ?ApplicationServerSetDto
    {
        return $this->applicationServerSet;
    }

    public function setApplicationServerSetId(?int $id): static
    {
        $value = !is_null($id)
            ? new ApplicationServerSetDto($id)
            : null;

        return $this->setApplicationServerSet($value);
    }

    public function getApplicationServerSetId(): ?int
    {
        if ($dto = $this->getApplicationServerSet()) {
            return $dto->getId();
        }

        return null;
    }

    public function setMediaRelaySet(?MediaRelaySetDto $mediaRelaySet): static
    {
        $this->mediaRelaySet = $mediaRelaySet;

        return $this;
    }

    public function getMediaRelaySet(): ?MediaRelaySetDto
    {
        return $this->mediaRelaySet;
    }

    public function setMediaRelaySetId(?int $id): static
    {
        $value = !is_null($id)
            ? new MediaRelaySetDto($id)
            : null;

        return $this->setMediaRelaySet($value);
    }

    public function getMediaRelaySetId(): ?int
    {
        if ($dto = $this->getMediaRelaySet()) {
            return $dto->getId();
        }

        return null;
    }

    public function setLocation(?LocationDto $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getLocation(): ?LocationDto
    {
        return $this->location;
    }

    public function setLocationId(?int $id): static
    {
        $value = !is_null($id)
            ? new LocationDto($id)
            : null;

        return $this->setLocation($value);
    }

    public function getLocationId(): ?int
    {
        if ($dto = $this->getLocation()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param ExtensionDto[] | null $extensions
     */
    public function setExtensions(?array $extensions): static
    {
        $this->extensions = $extensions;

        return $this;
    }

    /**
    * @return ExtensionDto[] | null
    */
    public function getExtensions(): ?array
    {
        return $this->extensions;
    }

    /**
     * @param DdiDto[] | null $ddis
     */
    public function setDdis(?array $ddis): static
    {
        $this->ddis = $ddis;

        return $this;
    }

    /**
    * @return DdiDto[] | null
    */
    public function getDdis(): ?array
    {
        return $this->ddis;
    }

    /**
     * @param FriendDto[] | null $friends
     */
    public function setFriends(?array $friends): static
    {
        $this->friends = $friends;

        return $this;
    }

    /**
    * @return FriendDto[] | null
    */
    public function getFriends(): ?array
    {
        return $this->friends;
    }

    /**
     * @param ContactDto[] | null $contacts
     */
    public function setContacts(?array $contacts): static
    {
        $this->contacts = $contacts;

        return $this;
    }

    /**
    * @return ContactDto[] | null
    */
    public function getContacts(): ?array
    {
        return $this->contacts;
    }

    /**
     * @param CompanyServiceDto[] | null $companyServices
     */
    public function setCompanyServices(?array $companyServices): static
    {
        $this->companyServices = $companyServices;

        return $this;
    }

    /**
    * @return CompanyServiceDto[] | null
    */
    public function getCompanyServices(): ?array
    {
        return $this->companyServices;
    }

    /**
     * @param TerminalDto[] | null $terminals
     */
    public function setTerminals(?array $terminals): static
    {
        $this->terminals = $terminals;

        return $this;
    }

    /**
    * @return TerminalDto[] | null
    */
    public function getTerminals(): ?array
    {
        return $this->terminals;
    }

    /**
     * @param RatingProfileDto[] | null $ratingProfiles
     */
    public function setRatingProfiles(?array $ratingProfiles): static
    {
        $this->ratingProfiles = $ratingProfiles;

        return $this;
    }

    /**
    * @return RatingProfileDto[] | null
    */
    public function getRatingProfiles(): ?array
    {
        return $this->ratingProfiles;
    }

    /**
     * @param MusicOnHoldDto[] | null $musicsOnHold
     */
    public function setMusicsOnHold(?array $musicsOnHold): static
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
     * @param VoicemailDto[] | null $voicemails
     */
    public function setVoicemails(?array $voicemails): static
    {
        $this->voicemails = $voicemails;

        return $this;
    }

    /**
    * @return VoicemailDto[] | null
    */
    public function getVoicemails(): ?array
    {
        return $this->voicemails;
    }

    /**
     * @param RecordingDto[] | null $recordings
     */
    public function setRecordings(?array $recordings): static
    {
        $this->recordings = $recordings;

        return $this;
    }

    /**
    * @return RecordingDto[] | null
    */
    public function getRecordings(): ?array
    {
        return $this->recordings;
    }

    /**
     * @param FeaturesRelCompanyDto[] | null $relFeatures
     */
    public function setRelFeatures(?array $relFeatures): static
    {
        $this->relFeatures = $relFeatures;

        return $this;
    }

    /**
    * @return FeaturesRelCompanyDto[] | null
    */
    public function getRelFeatures(): ?array
    {
        return $this->relFeatures;
    }

    /**
     * @param CompanyRelGeoIPCountryDto[] | null $relCountries
     */
    public function setRelCountries(?array $relCountries): static
    {
        $this->relCountries = $relCountries;

        return $this;
    }

    /**
    * @return CompanyRelGeoIPCountryDto[] | null
    */
    public function getRelCountries(): ?array
    {
        return $this->relCountries;
    }

    /**
     * @param CompanyRelCodecDto[] | null $relCodecs
     */
    public function setRelCodecs(?array $relCodecs): static
    {
        $this->relCodecs = $relCodecs;

        return $this;
    }

    /**
    * @return CompanyRelCodecDto[] | null
    */
    public function getRelCodecs(): ?array
    {
        return $this->relCodecs;
    }

    /**
     * @param CompanyRelRoutingTagDto[] | null $relRoutingTags
     */
    public function setRelRoutingTags(?array $relRoutingTags): static
    {
        $this->relRoutingTags = $relRoutingTags;

        return $this;
    }

    /**
    * @return CompanyRelRoutingTagDto[] | null
    */
    public function getRelRoutingTags(): ?array
    {
        return $this->relRoutingTags;
    }
}
