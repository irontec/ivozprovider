<?php

namespace Ivoz\Provider\Domain\Model\Company;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Language\LanguageDto;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetDto;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneDto;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Domain\DomainDto;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerDto;
use Ivoz\Provider\Domain\Model\Country\CountryDto;
use Ivoz\Provider\Domain\Model\Currency\CurrencyDto;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\Friend\FriendDto;
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
    private $nif = null;

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
     * @var string|null
     */
    private $postalAddress = null;

    /**
     * @var string|null
     */
    private $postalCode = null;

    /**
     * @var string|null
     */
    private $town = null;

    /**
     * @var string|null
     */
    private $province = null;

    /**
     * @var string|null
     */
    private $countryName = null;

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
     * @var LanguageDto | null
     */
    private $language = null;

    /**
     * @var MediaRelaySetDto | null
     */
    private $mediaRelaySets = null;

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
     * @var ApplicationServerDto | null
     */
    private $applicationServer = null;

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

    public function __construct($id = null)
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
            'nif' => 'nif',
            'distributeMethod' => 'distributeMethod',
            'maxCalls' => 'maxCalls',
            'maxDailyUsage' => 'maxDailyUsage',
            'currentDayUsage' => 'currentDayUsage',
            'maxDailyUsageEmail' => 'maxDailyUsageEmail',
            'postalAddress' => 'postalAddress',
            'postalCode' => 'postalCode',
            'town' => 'town',
            'province' => 'province',
            'countryName' => 'countryName',
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
            'callCsvNotificationTemplateId' => 'callCsvNotificationTemplate',
            'maxDailyUsageNotificationTemplateId' => 'maxDailyUsageNotificationTemplate'
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
            'nif' => $this->getNif(),
            'distributeMethod' => $this->getDistributeMethod(),
            'maxCalls' => $this->getMaxCalls(),
            'maxDailyUsage' => $this->getMaxDailyUsage(),
            'currentDayUsage' => $this->getCurrentDayUsage(),
            'maxDailyUsageEmail' => $this->getMaxDailyUsageEmail(),
            'postalAddress' => $this->getPostalAddress(),
            'postalCode' => $this->getPostalCode(),
            'town' => $this->getTown(),
            'province' => $this->getProvince(),
            'countryName' => $this->getCountryName(),
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
            'maxDailyUsageNotificationTemplate' => $this->getMaxDailyUsageNotificationTemplate(),
            'extensions' => $this->getExtensions(),
            'ddis' => $this->getDdis(),
            'friends' => $this->getFriends(),
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

    public function setNif(string $nif): static
    {
        $this->nif = $nif;

        return $this;
    }

    public function getNif(): ?string
    {
        return $this->nif;
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

    public function setPostalAddress(string $postalAddress): static
    {
        $this->postalAddress = $postalAddress;

        return $this;
    }

    public function getPostalAddress(): ?string
    {
        return $this->postalAddress;
    }

    public function setPostalCode(string $postalCode): static
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setTown(string $town): static
    {
        $this->town = $town;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setProvince(string $province): static
    {
        $this->province = $province;

        return $this;
    }

    public function getProvince(): ?string
    {
        return $this->province;
    }

    public function setCountryName(string $countryName): static
    {
        $this->countryName = $countryName;

        return $this;
    }

    public function getCountryName(): ?string
    {
        return $this->countryName;
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

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function setMediaRelaySets(?MediaRelaySetDto $mediaRelaySets): static
    {
        $this->mediaRelaySets = $mediaRelaySets;

        return $this;
    }

    public function getMediaRelaySets(): ?MediaRelaySetDto
    {
        return $this->mediaRelaySets;
    }

    public function setMediaRelaySetsId($id): static
    {
        $value = !is_null($id)
            ? new MediaRelaySetDto($id)
            : null;

        return $this->setMediaRelaySets($value);
    }

    public function getMediaRelaySetsId()
    {
        if ($dto = $this->getMediaRelaySets()) {
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

    public function setBrand(?BrandDto $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    public function setBrandId($id): static
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    public function getBrandId()
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

    public function setApplicationServer(?ApplicationServerDto $applicationServer): static
    {
        $this->applicationServer = $applicationServer;

        return $this;
    }

    public function getApplicationServer(): ?ApplicationServerDto
    {
        return $this->applicationServer;
    }

    public function setApplicationServerId($id): static
    {
        $value = !is_null($id)
            ? new ApplicationServerDto($id)
            : null;

        return $this->setApplicationServer($value);
    }

    public function getApplicationServerId()
    {
        if ($dto = $this->getApplicationServer()) {
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

    public function setCountryId($id): static
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setCountry($value);
    }

    public function getCountryId()
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

    public function setTransformationRuleSet(?TransformationRuleSetDto $transformationRuleSet): static
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    public function getTransformationRuleSet(): ?TransformationRuleSetDto
    {
        return $this->transformationRuleSet;
    }

    public function setTransformationRuleSetId($id): static
    {
        $value = !is_null($id)
            ? new TransformationRuleSetDto($id)
            : null;

        return $this->setTransformationRuleSet($value);
    }

    public function getTransformationRuleSetId()
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

    public function setOutgoingDdiId($id): static
    {
        $value = !is_null($id)
            ? new DdiDto($id)
            : null;

        return $this->setOutgoingDdi($value);
    }

    public function getOutgoingDdiId()
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

    public function setOutgoingDdiRuleId($id): static
    {
        $value = !is_null($id)
            ? new OutgoingDdiRuleDto($id)
            : null;

        return $this->setOutgoingDdiRule($value);
    }

    public function getOutgoingDdiRuleId()
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

    public function setExtensions(?array $extensions): static
    {
        $this->extensions = $extensions;

        return $this;
    }

    public function getExtensions(): ?array
    {
        return $this->extensions;
    }

    public function setDdis(?array $ddis): static
    {
        $this->ddis = $ddis;

        return $this;
    }

    public function getDdis(): ?array
    {
        return $this->ddis;
    }

    public function setFriends(?array $friends): static
    {
        $this->friends = $friends;

        return $this;
    }

    public function getFriends(): ?array
    {
        return $this->friends;
    }

    public function setCompanyServices(?array $companyServices): static
    {
        $this->companyServices = $companyServices;

        return $this;
    }

    public function getCompanyServices(): ?array
    {
        return $this->companyServices;
    }

    public function setTerminals(?array $terminals): static
    {
        $this->terminals = $terminals;

        return $this;
    }

    public function getTerminals(): ?array
    {
        return $this->terminals;
    }

    public function setRatingProfiles(?array $ratingProfiles): static
    {
        $this->ratingProfiles = $ratingProfiles;

        return $this;
    }

    public function getRatingProfiles(): ?array
    {
        return $this->ratingProfiles;
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

    public function setVoicemails(?array $voicemails): static
    {
        $this->voicemails = $voicemails;

        return $this;
    }

    public function getVoicemails(): ?array
    {
        return $this->voicemails;
    }

    public function setRecordings(?array $recordings): static
    {
        $this->recordings = $recordings;

        return $this;
    }

    public function getRecordings(): ?array
    {
        return $this->recordings;
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

    public function setRelCountries(?array $relCountries): static
    {
        $this->relCountries = $relCountries;

        return $this;
    }

    public function getRelCountries(): ?array
    {
        return $this->relCountries;
    }

    public function setRelCodecs(?array $relCodecs): static
    {
        $this->relCodecs = $relCodecs;

        return $this;
    }

    public function getRelCodecs(): ?array
    {
        return $this->relCodecs;
    }

    public function setRelRoutingTags(?array $relRoutingTags): static
    {
        $this->relRoutingTags = $relRoutingTags;

        return $this;
    }

    public function getRelRoutingTags(): ?array
    {
        return $this->relRoutingTags;
    }
}
