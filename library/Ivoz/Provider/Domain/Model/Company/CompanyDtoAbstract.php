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
use Ivoz\Provider\Domain\Model\Recording\RecordingDto;
use Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyDto;
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
     * @var string
     */
    private $type = 'vpbx';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string | null
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
     * @var int
     */
    private $maxCalls = 0;

    /**
     * @var int
     */
    private $maxDailyUsage = 1000000;

    /**
     * @var float | null
     */
    private $currentDayUsage = 0;

    /**
     * @var string | null
     */
    private $maxDailyUsageEmail;

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
     * @var bool | null
     */
    private $ipfilter = true;

    /**
     * @var int | null
     */
    private $onDemandRecord = 0;

    /**
     * @var bool
     */
    private $allowRecordingRemoval = true;

    /**
     * @var string | null
     */
    private $onDemandRecordCode;

    /**
     * @var string | null
     */
    private $externallyextraopts;

    /**
     * @var int | null
     */
    private $recordingsLimitMB;

    /**
     * @var string | null
     */
    private $recordingsLimitEmail;

    /**
     * @var string
     */
    private $billingMethod = 'postpaid';

    /**
     * @var float | null
     */
    private $balance = 0;

    /**
     * @var bool | null
     */
    private $showInvoices = false;

    /**
     * @var int
     */
    private $id;

    /**
     * @var LanguageDto | null
     */
    private $language;

    /**
     * @var MediaRelaySetDto | null
     */
    private $mediaRelaySets;

    /**
     * @var TimezoneDto | null
     */
    private $defaultTimezone;

    /**
     * @var BrandDto | null
     */
    private $brand;

    /**
     * @var DomainDto | null
     */
    private $domain;

    /**
     * @var ApplicationServerDto | null
     */
    private $applicationServer;

    /**
     * @var CountryDto | null
     */
    private $country;

    /**
     * @var CurrencyDto | null
     */
    private $currency;

    /**
     * @var TransformationRuleSetDto | null
     */
    private $transformationRuleSet;

    /**
     * @var DdiDto | null
     */
    private $outgoingDdi;

    /**
     * @var OutgoingDdiRuleDto | null
     */
    private $outgoingDdiRule;

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
     * @var ExtensionDto[] | null
     */
    private $extensions;

    /**
     * @var DdiDto[] | null
     */
    private $ddis;

    /**
     * @var FriendDto[] | null
     */
    private $friends;

    /**
     * @var CompanyServiceDto[] | null
     */
    private $companyServices;

    /**
     * @var TerminalDto[] | null
     */
    private $terminals;

    /**
     * @var RatingProfileDto[] | null
     */
    private $ratingProfiles;

    /**
     * @var MusicOnHoldDto[] | null
     */
    private $musicsOnHold;

    /**
     * @var RecordingDto[] | null
     */
    private $recordings;

    /**
     * @var FeaturesRelCompanyDto[] | null
     */
    private $relFeatures;

    /**
     * @var CompanyRelCodecDto[] | null
     */
    private $relCodecs;

    /**
     * @var CompanyRelRoutingTagDto[] | null
     */
    private $relRoutingTags;

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
    * @return array
    */
    public function toArray($hideSensitiveData = false)
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
            'recordings' => $this->getRecordings(),
            'relFeatures' => $this->getRelFeatures(),
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

    /**
     * @param string $type | null
     *
     * @return static
     */
    public function setType(?string $type = null): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getType(): ?string
    {
        return $this->type;
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
     * @param string $nif | null
     *
     * @return static
     */
    public function setNif(?string $nif = null): self
    {
        $this->nif = $nif;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNif(): ?string
    {
        return $this->nif;
    }

    /**
     * @param string $distributeMethod | null
     *
     * @return static
     */
    public function setDistributeMethod(?string $distributeMethod = null): self
    {
        $this->distributeMethod = $distributeMethod;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDistributeMethod(): ?string
    {
        return $this->distributeMethod;
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
     * @param int $maxDailyUsage | null
     *
     * @return static
     */
    public function setMaxDailyUsage(?int $maxDailyUsage = null): self
    {
        $this->maxDailyUsage = $maxDailyUsage;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getMaxDailyUsage(): ?int
    {
        return $this->maxDailyUsage;
    }

    /**
     * @param float $currentDayUsage | null
     *
     * @return static
     */
    public function setCurrentDayUsage(?float $currentDayUsage = null): self
    {
        $this->currentDayUsage = $currentDayUsage;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getCurrentDayUsage(): ?float
    {
        return $this->currentDayUsage;
    }

    /**
     * @param string $maxDailyUsageEmail | null
     *
     * @return static
     */
    public function setMaxDailyUsageEmail(?string $maxDailyUsageEmail = null): self
    {
        $this->maxDailyUsageEmail = $maxDailyUsageEmail;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getMaxDailyUsageEmail(): ?string
    {
        return $this->maxDailyUsageEmail;
    }

    /**
     * @param string $postalAddress | null
     *
     * @return static
     */
    public function setPostalAddress(?string $postalAddress = null): self
    {
        $this->postalAddress = $postalAddress;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPostalAddress(): ?string
    {
        return $this->postalAddress;
    }

    /**
     * @param string $postalCode | null
     *
     * @return static
     */
    public function setPostalCode(?string $postalCode = null): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * @param string $town | null
     *
     * @return static
     */
    public function setTown(?string $town = null): self
    {
        $this->town = $town;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTown(): ?string
    {
        return $this->town;
    }

    /**
     * @param string $province | null
     *
     * @return static
     */
    public function setProvince(?string $province = null): self
    {
        $this->province = $province;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getProvince(): ?string
    {
        return $this->province;
    }

    /**
     * @param string $countryName | null
     *
     * @return static
     */
    public function setCountryName(?string $countryName = null): self
    {
        $this->countryName = $countryName;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCountryName(): ?string
    {
        return $this->countryName;
    }

    /**
     * @param bool $ipfilter | null
     *
     * @return static
     */
    public function setIpfilter(?bool $ipfilter = null): self
    {
        $this->ipfilter = $ipfilter;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getIpfilter(): ?bool
    {
        return $this->ipfilter;
    }

    /**
     * @param int $onDemandRecord | null
     *
     * @return static
     */
    public function setOnDemandRecord(?int $onDemandRecord = null): self
    {
        $this->onDemandRecord = $onDemandRecord;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getOnDemandRecord(): ?int
    {
        return $this->onDemandRecord;
    }

    /**
     * @param bool $allowRecordingRemoval | null
     *
     * @return static
     */
    public function setAllowRecordingRemoval(?bool $allowRecordingRemoval = null): self
    {
        $this->allowRecordingRemoval = $allowRecordingRemoval;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getAllowRecordingRemoval(): ?bool
    {
        return $this->allowRecordingRemoval;
    }

    /**
     * @param string $onDemandRecordCode | null
     *
     * @return static
     */
    public function setOnDemandRecordCode(?string $onDemandRecordCode = null): self
    {
        $this->onDemandRecordCode = $onDemandRecordCode;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getOnDemandRecordCode(): ?string
    {
        return $this->onDemandRecordCode;
    }

    /**
     * @param string $externallyextraopts | null
     *
     * @return static
     */
    public function setExternallyextraopts(?string $externallyextraopts = null): self
    {
        $this->externallyextraopts = $externallyextraopts;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getExternallyextraopts(): ?string
    {
        return $this->externallyextraopts;
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
     * @param string $billingMethod | null
     *
     * @return static
     */
    public function setBillingMethod(?string $billingMethod = null): self
    {
        $this->billingMethod = $billingMethod;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getBillingMethod(): ?string
    {
        return $this->billingMethod;
    }

    /**
     * @param float $balance | null
     *
     * @return static
     */
    public function setBalance(?float $balance = null): self
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getBalance(): ?float
    {
        return $this->balance;
    }

    /**
     * @param bool $showInvoices | null
     *
     * @return static
     */
    public function setShowInvoices(?bool $showInvoices = null): self
    {
        $this->showInvoices = $showInvoices;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getShowInvoices(): ?bool
    {
        return $this->showInvoices;
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
     * @param MediaRelaySetDto | null
     *
     * @return static
     */
    public function setMediaRelaySets(?MediaRelaySetDto $mediaRelaySets = null): self
    {
        $this->mediaRelaySets = $mediaRelaySets;

        return $this;
    }

    /**
     * @return MediaRelaySetDto | null
     */
    public function getMediaRelaySets(): ?MediaRelaySetDto
    {
        return $this->mediaRelaySets;
    }

    /**
     * @return static
     */
    public function setMediaRelaySetsId($id): self
    {
        $value = !is_null($id)
            ? new MediaRelaySetDto($id)
            : null;

        return $this->setMediaRelaySets($value);
    }

    /**
     * @return mixed | null
     */
    public function getMediaRelaySetsId()
    {
        if ($dto = $this->getMediaRelaySets()) {
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
     * @param BrandDto | null
     *
     * @return static
     */
    public function setBrand(?BrandDto $brand = null): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return BrandDto | null
     */
    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    /**
     * @return static
     */
    public function setBrandId($id): self
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    /**
     * @return mixed | null
     */
    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
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
     * @param ApplicationServerDto | null
     *
     * @return static
     */
    public function setApplicationServer(?ApplicationServerDto $applicationServer = null): self
    {
        $this->applicationServer = $applicationServer;

        return $this;
    }

    /**
     * @return ApplicationServerDto | null
     */
    public function getApplicationServer(): ?ApplicationServerDto
    {
        return $this->applicationServer;
    }

    /**
     * @return static
     */
    public function setApplicationServerId($id): self
    {
        $value = !is_null($id)
            ? new ApplicationServerDto($id)
            : null;

        return $this->setApplicationServer($value);
    }

    /**
     * @return mixed | null
     */
    public function getApplicationServerId()
    {
        if ($dto = $this->getApplicationServer()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CountryDto | null
     *
     * @return static
     */
    public function setCountry(?CountryDto $country = null): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return CountryDto | null
     */
    public function getCountry(): ?CountryDto
    {
        return $this->country;
    }

    /**
     * @return static
     */
    public function setCountryId($id): self
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setCountry($value);
    }

    /**
     * @return mixed | null
     */
    public function getCountryId()
    {
        if ($dto = $this->getCountry()) {
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
     * @param TransformationRuleSetDto | null
     *
     * @return static
     */
    public function setTransformationRuleSet(?TransformationRuleSetDto $transformationRuleSet = null): self
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    /**
     * @return TransformationRuleSetDto | null
     */
    public function getTransformationRuleSet(): ?TransformationRuleSetDto
    {
        return $this->transformationRuleSet;
    }

    /**
     * @return static
     */
    public function setTransformationRuleSetId($id): self
    {
        $value = !is_null($id)
            ? new TransformationRuleSetDto($id)
            : null;

        return $this->setTransformationRuleSet($value);
    }

    /**
     * @return mixed | null
     */
    public function getTransformationRuleSetId()
    {
        if ($dto = $this->getTransformationRuleSet()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param DdiDto | null
     *
     * @return static
     */
    public function setOutgoingDdi(?DdiDto $outgoingDdi = null): self
    {
        $this->outgoingDdi = $outgoingDdi;

        return $this;
    }

    /**
     * @return DdiDto | null
     */
    public function getOutgoingDdi(): ?DdiDto
    {
        return $this->outgoingDdi;
    }

    /**
     * @return static
     */
    public function setOutgoingDdiId($id): self
    {
        $value = !is_null($id)
            ? new DdiDto($id)
            : null;

        return $this->setOutgoingDdi($value);
    }

    /**
     * @return mixed | null
     */
    public function getOutgoingDdiId()
    {
        if ($dto = $this->getOutgoingDdi()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param OutgoingDdiRuleDto | null
     *
     * @return static
     */
    public function setOutgoingDdiRule(?OutgoingDdiRuleDto $outgoingDdiRule = null): self
    {
        $this->outgoingDdiRule = $outgoingDdiRule;

        return $this;
    }

    /**
     * @return OutgoingDdiRuleDto | null
     */
    public function getOutgoingDdiRule(): ?OutgoingDdiRuleDto
    {
        return $this->outgoingDdiRule;
    }

    /**
     * @return static
     */
    public function setOutgoingDdiRuleId($id): self
    {
        $value = !is_null($id)
            ? new OutgoingDdiRuleDto($id)
            : null;

        return $this->setOutgoingDdiRule($value);
    }

    /**
     * @return mixed | null
     */
    public function getOutgoingDdiRuleId()
    {
        if ($dto = $this->getOutgoingDdiRule()) {
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
     * @param ExtensionDto[] | null
     *
     * @return static
     */
    public function setExtensions(?array $extensions = null): self
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
     * @param DdiDto[] | null
     *
     * @return static
     */
    public function setDdis(?array $ddis = null): self
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
     * @param FriendDto[] | null
     *
     * @return static
     */
    public function setFriends(?array $friends = null): self
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
     * @param CompanyServiceDto[] | null
     *
     * @return static
     */
    public function setCompanyServices(?array $companyServices = null): self
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
     * @param TerminalDto[] | null
     *
     * @return static
     */
    public function setTerminals(?array $terminals = null): self
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
     * @param RatingProfileDto[] | null
     *
     * @return static
     */
    public function setRatingProfiles(?array $ratingProfiles = null): self
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
     * @param RecordingDto[] | null
     *
     * @return static
     */
    public function setRecordings(?array $recordings = null): self
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
     * @param FeaturesRelCompanyDto[] | null
     *
     * @return static
     */
    public function setRelFeatures(?array $relFeatures = null): self
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
     * @param CompanyRelCodecDto[] | null
     *
     * @return static
     */
    public function setRelCodecs(?array $relCodecs = null): self
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
     * @param CompanyRelRoutingTagDto[] | null
     *
     * @return static
     */
    public function setRelRoutingTags(?array $relRoutingTags = null): self
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
