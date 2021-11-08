<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Company;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Currency\CurrencyInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\Language\Language;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySet;
use Ivoz\Provider\Domain\Model\Timezone\Timezone;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServer;
use Ivoz\Provider\Domain\Model\Country\Country;
use Ivoz\Provider\Domain\Model\Currency\Currency;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSet;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRule;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate;

/**
* CompanyAbstract
* @codeCoverageIgnore
*/
abstract class CompanyAbstract
{
    use ChangelogTrait;

    /**
     * comment: enum:vpbx|retail|wholesale|residential
     */
    protected $type = 'vpbx';

    protected $name;

    /**
     * column: domain_users
     */
    protected $domainUsers;

    protected $nif;

    /**
     * comment: enum:static|rr|hash
     */
    protected $distributeMethod = 'hash';

    protected $maxCalls = 0;

    protected $maxDailyUsage = 1000000;

    protected $currentDayUsage = 0;

    protected $maxDailyUsageEmail;

    protected $postalAddress;

    protected $postalCode;

    protected $town;

    protected $province;

    /**
     * column: country
     */
    protected $countryName;

    /**
     * column: ipFilter
     */
    protected $ipfilter = true;

    protected $onDemandRecord = 0;

    protected $allowRecordingRemoval = true;

    protected $onDemandRecordCode;

    /**
     * column: externallyExtraOpts
     */
    protected $externallyextraopts;

    protected $recordingsLimitMB;

    protected $recordingsLimitEmail;

    /**
     * comment: enum:postpaid|prepaid|pseudoprepaid
     */
    protected $billingMethod = 'postpaid';

    protected $balance = 0;

    protected $showInvoices = false;

    /**
     * @var LanguageInterface | null
     */
    protected $language;

    /**
     * @var MediaRelaySetInterface | null
     */
    protected $mediaRelaySets;

    /**
     * @var TimezoneInterface | null
     */
    protected $defaultTimezone;

    /**
     * @var BrandInterface
     * inversedBy companies
     */
    protected $brand;

    /**
     * @var DomainInterface | null
     */
    protected $domain;

    /**
     * @var ApplicationServerInterface | null
     */
    protected $applicationServer;

    /**
     * @var CountryInterface
     */
    protected $country;

    /**
     * @var CurrencyInterface | null
     */
    protected $currency;

    /**
     * @var TransformationRuleSetInterface | null
     */
    protected $transformationRuleSet;

    /**
     * @var DdiInterface | null
     */
    protected $outgoingDdi;

    /**
     * @var OutgoingDdiRuleInterface | null
     */
    protected $outgoingDdiRule;

    /**
     * @var NotificationTemplateInterface | null
     */
    protected $voicemailNotificationTemplate;

    /**
     * @var NotificationTemplateInterface | null
     */
    protected $faxNotificationTemplate;

    /**
     * @var NotificationTemplateInterface | null
     */
    protected $invoiceNotificationTemplate;

    /**
     * @var NotificationTemplateInterface | null
     */
    protected $callCsvNotificationTemplate;

    /**
     * @var NotificationTemplateInterface | null
     */
    protected $maxDailyUsageNotificationTemplate;

    /**
     * Constructor
     */
    protected function __construct(
        string $type,
        string $name,
        string $nif,
        string $distributeMethod,
        int $maxCalls,
        int $maxDailyUsage,
        string $postalAddress,
        string $postalCode,
        string $town,
        string $province,
        string $countryName,
        bool $allowRecordingRemoval,
        string $billingMethod
    ) {
        $this->setType($type);
        $this->setName($name);
        $this->setNif($nif);
        $this->setDistributeMethod($distributeMethod);
        $this->setMaxCalls($maxCalls);
        $this->setMaxDailyUsage($maxDailyUsage);
        $this->setPostalAddress($postalAddress);
        $this->setPostalCode($postalCode);
        $this->setTown($town);
        $this->setProvince($province);
        $this->setCountryName($countryName);
        $this->setAllowRecordingRemoval($allowRecordingRemoval);
        $this->setBillingMethod($billingMethod);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Company",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param mixed $id
     */
    public static function createDto($id = null): CompanyDto
    {
        return new CompanyDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param CompanyInterface|null $entity
     * @param int $depth
     * @return CompanyDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CompanyInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var CompanyDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CompanyDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CompanyDto::class);

        $self = new static(
            $dto->getType(),
            $dto->getName(),
            $dto->getNif(),
            $dto->getDistributeMethod(),
            $dto->getMaxCalls(),
            $dto->getMaxDailyUsage(),
            $dto->getPostalAddress(),
            $dto->getPostalCode(),
            $dto->getTown(),
            $dto->getProvince(),
            $dto->getCountryName(),
            $dto->getAllowRecordingRemoval(),
            $dto->getBillingMethod()
        );

        $self
            ->setDomainUsers($dto->getDomainUsers())
            ->setCurrentDayUsage($dto->getCurrentDayUsage())
            ->setMaxDailyUsageEmail($dto->getMaxDailyUsageEmail())
            ->setIpfilter($dto->getIpfilter())
            ->setOnDemandRecord($dto->getOnDemandRecord())
            ->setOnDemandRecordCode($dto->getOnDemandRecordCode())
            ->setExternallyextraopts($dto->getExternallyextraopts())
            ->setRecordingsLimitMB($dto->getRecordingsLimitMB())
            ->setRecordingsLimitEmail($dto->getRecordingsLimitEmail())
            ->setBalance($dto->getBalance())
            ->setShowInvoices($dto->getShowInvoices())
            ->setLanguage($fkTransformer->transform($dto->getLanguage()))
            ->setMediaRelaySets($fkTransformer->transform($dto->getMediaRelaySets()))
            ->setDefaultTimezone($fkTransformer->transform($dto->getDefaultTimezone()))
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setApplicationServer($fkTransformer->transform($dto->getApplicationServer()))
            ->setCountry($fkTransformer->transform($dto->getCountry()))
            ->setCurrency($fkTransformer->transform($dto->getCurrency()))
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
            ->setOutgoingDdi($fkTransformer->transform($dto->getOutgoingDdi()))
            ->setOutgoingDdiRule($fkTransformer->transform($dto->getOutgoingDdiRule()))
            ->setVoicemailNotificationTemplate($fkTransformer->transform($dto->getVoicemailNotificationTemplate()))
            ->setFaxNotificationTemplate($fkTransformer->transform($dto->getFaxNotificationTemplate()))
            ->setInvoiceNotificationTemplate($fkTransformer->transform($dto->getInvoiceNotificationTemplate()))
            ->setCallCsvNotificationTemplate($fkTransformer->transform($dto->getCallCsvNotificationTemplate()))
            ->setMaxDailyUsageNotificationTemplate($fkTransformer->transform($dto->getMaxDailyUsageNotificationTemplate()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CompanyDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CompanyDto::class);

        $this
            ->setType($dto->getType())
            ->setName($dto->getName())
            ->setDomainUsers($dto->getDomainUsers())
            ->setNif($dto->getNif())
            ->setDistributeMethod($dto->getDistributeMethod())
            ->setMaxCalls($dto->getMaxCalls())
            ->setMaxDailyUsage($dto->getMaxDailyUsage())
            ->setCurrentDayUsage($dto->getCurrentDayUsage())
            ->setMaxDailyUsageEmail($dto->getMaxDailyUsageEmail())
            ->setPostalAddress($dto->getPostalAddress())
            ->setPostalCode($dto->getPostalCode())
            ->setTown($dto->getTown())
            ->setProvince($dto->getProvince())
            ->setCountryName($dto->getCountryName())
            ->setIpfilter($dto->getIpfilter())
            ->setOnDemandRecord($dto->getOnDemandRecord())
            ->setAllowRecordingRemoval($dto->getAllowRecordingRemoval())
            ->setOnDemandRecordCode($dto->getOnDemandRecordCode())
            ->setExternallyextraopts($dto->getExternallyextraopts())
            ->setRecordingsLimitMB($dto->getRecordingsLimitMB())
            ->setRecordingsLimitEmail($dto->getRecordingsLimitEmail())
            ->setBillingMethod($dto->getBillingMethod())
            ->setBalance($dto->getBalance())
            ->setShowInvoices($dto->getShowInvoices())
            ->setLanguage($fkTransformer->transform($dto->getLanguage()))
            ->setMediaRelaySets($fkTransformer->transform($dto->getMediaRelaySets()))
            ->setDefaultTimezone($fkTransformer->transform($dto->getDefaultTimezone()))
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setApplicationServer($fkTransformer->transform($dto->getApplicationServer()))
            ->setCountry($fkTransformer->transform($dto->getCountry()))
            ->setCurrency($fkTransformer->transform($dto->getCurrency()))
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
            ->setOutgoingDdi($fkTransformer->transform($dto->getOutgoingDdi()))
            ->setOutgoingDdiRule($fkTransformer->transform($dto->getOutgoingDdiRule()))
            ->setVoicemailNotificationTemplate($fkTransformer->transform($dto->getVoicemailNotificationTemplate()))
            ->setFaxNotificationTemplate($fkTransformer->transform($dto->getFaxNotificationTemplate()))
            ->setInvoiceNotificationTemplate($fkTransformer->transform($dto->getInvoiceNotificationTemplate()))
            ->setCallCsvNotificationTemplate($fkTransformer->transform($dto->getCallCsvNotificationTemplate()))
            ->setMaxDailyUsageNotificationTemplate($fkTransformer->transform($dto->getMaxDailyUsageNotificationTemplate()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     */
    public function toDto($depth = 0): CompanyDto
    {
        return self::createDto()
            ->setType(self::getType())
            ->setName(self::getName())
            ->setDomainUsers(self::getDomainUsers())
            ->setNif(self::getNif())
            ->setDistributeMethod(self::getDistributeMethod())
            ->setMaxCalls(self::getMaxCalls())
            ->setMaxDailyUsage(self::getMaxDailyUsage())
            ->setCurrentDayUsage(self::getCurrentDayUsage())
            ->setMaxDailyUsageEmail(self::getMaxDailyUsageEmail())
            ->setPostalAddress(self::getPostalAddress())
            ->setPostalCode(self::getPostalCode())
            ->setTown(self::getTown())
            ->setProvince(self::getProvince())
            ->setCountryName(self::getCountryName())
            ->setIpfilter(self::getIpfilter())
            ->setOnDemandRecord(self::getOnDemandRecord())
            ->setAllowRecordingRemoval(self::getAllowRecordingRemoval())
            ->setOnDemandRecordCode(self::getOnDemandRecordCode())
            ->setExternallyextraopts(self::getExternallyextraopts())
            ->setRecordingsLimitMB(self::getRecordingsLimitMB())
            ->setRecordingsLimitEmail(self::getRecordingsLimitEmail())
            ->setBillingMethod(self::getBillingMethod())
            ->setBalance(self::getBalance())
            ->setShowInvoices(self::getShowInvoices())
            ->setLanguage(Language::entityToDto(self::getLanguage(), $depth))
            ->setMediaRelaySets(MediaRelaySet::entityToDto(self::getMediaRelaySets(), $depth))
            ->setDefaultTimezone(Timezone::entityToDto(self::getDefaultTimezone(), $depth))
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setDomain(Domain::entityToDto(self::getDomain(), $depth))
            ->setApplicationServer(ApplicationServer::entityToDto(self::getApplicationServer(), $depth))
            ->setCountry(Country::entityToDto(self::getCountry(), $depth))
            ->setCurrency(Currency::entityToDto(self::getCurrency(), $depth))
            ->setTransformationRuleSet(TransformationRuleSet::entityToDto(self::getTransformationRuleSet(), $depth))
            ->setOutgoingDdi(Ddi::entityToDto(self::getOutgoingDdi(), $depth))
            ->setOutgoingDdiRule(OutgoingDdiRule::entityToDto(self::getOutgoingDdiRule(), $depth))
            ->setVoicemailNotificationTemplate(NotificationTemplate::entityToDto(self::getVoicemailNotificationTemplate(), $depth))
            ->setFaxNotificationTemplate(NotificationTemplate::entityToDto(self::getFaxNotificationTemplate(), $depth))
            ->setInvoiceNotificationTemplate(NotificationTemplate::entityToDto(self::getInvoiceNotificationTemplate(), $depth))
            ->setCallCsvNotificationTemplate(NotificationTemplate::entityToDto(self::getCallCsvNotificationTemplate(), $depth))
            ->setMaxDailyUsageNotificationTemplate(NotificationTemplate::entityToDto(self::getMaxDailyUsageNotificationTemplate(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'type' => self::getType(),
            'name' => self::getName(),
            'domain_users' => self::getDomainUsers(),
            'nif' => self::getNif(),
            'distributeMethod' => self::getDistributeMethod(),
            'maxCalls' => self::getMaxCalls(),
            'maxDailyUsage' => self::getMaxDailyUsage(),
            'currentDayUsage' => self::getCurrentDayUsage(),
            'maxDailyUsageEmail' => self::getMaxDailyUsageEmail(),
            'postalAddress' => self::getPostalAddress(),
            'postalCode' => self::getPostalCode(),
            'town' => self::getTown(),
            'province' => self::getProvince(),
            'country' => self::getCountryName(),
            'ipFilter' => self::getIpfilter(),
            'onDemandRecord' => self::getOnDemandRecord(),
            'allowRecordingRemoval' => self::getAllowRecordingRemoval(),
            'onDemandRecordCode' => self::getOnDemandRecordCode(),
            'externallyExtraOpts' => self::getExternallyextraopts(),
            'recordingsLimitMB' => self::getRecordingsLimitMB(),
            'recordingsLimitEmail' => self::getRecordingsLimitEmail(),
            'billingMethod' => self::getBillingMethod(),
            'balance' => self::getBalance(),
            'showInvoices' => self::getShowInvoices(),
            'languageId' => self::getLanguage() ? self::getLanguage()->getId() : null,
            'mediaRelaySetsId' => self::getMediaRelaySets() ? self::getMediaRelaySets()->getId() : null,
            'defaultTimezoneId' => self::getDefaultTimezone() ? self::getDefaultTimezone()->getId() : null,
            'brandId' => self::getBrand()->getId(),
            'domainId' => self::getDomain() ? self::getDomain()->getId() : null,
            'applicationServerId' => self::getApplicationServer() ? self::getApplicationServer()->getId() : null,
            'countryId' => self::getCountry()->getId(),
            'currencyId' => self::getCurrency() ? self::getCurrency()->getId() : null,
            'transformationRuleSetId' => self::getTransformationRuleSet() ? self::getTransformationRuleSet()->getId() : null,
            'outgoingDdiId' => self::getOutgoingDdi() ? self::getOutgoingDdi()->getId() : null,
            'outgoingDdiRuleId' => self::getOutgoingDdiRule() ? self::getOutgoingDdiRule()->getId() : null,
            'voicemailNotificationTemplateId' => self::getVoicemailNotificationTemplate() ? self::getVoicemailNotificationTemplate()->getId() : null,
            'faxNotificationTemplateId' => self::getFaxNotificationTemplate() ? self::getFaxNotificationTemplate()->getId() : null,
            'invoiceNotificationTemplateId' => self::getInvoiceNotificationTemplate() ? self::getInvoiceNotificationTemplate()->getId() : null,
            'callCsvNotificationTemplateId' => self::getCallCsvNotificationTemplate() ? self::getCallCsvNotificationTemplate()->getId() : null,
            'maxDailyUsageNotificationTemplateId' => self::getMaxDailyUsageNotificationTemplate() ? self::getMaxDailyUsageNotificationTemplate()->getId() : null
        ];
    }

    protected function setType(string $type): static
    {
        Assertion::maxLength($type, 25, 'type value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $type,
            [
                CompanyInterface::TYPE_VPBX,
                CompanyInterface::TYPE_RETAIL,
                CompanyInterface::TYPE_WHOLESALE,
                CompanyInterface::TYPE_RESIDENTIAL,
            ],
            'typevalue "%s" is not an element of the valid values: %s'
        );

        $this->type = $type;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 80, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setDomainUsers(?string $domainUsers = null): static
    {
        if (!is_null($domainUsers)) {
            Assertion::maxLength($domainUsers, 190, 'domainUsers value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->domainUsers = $domainUsers;

        return $this;
    }

    public function getDomainUsers(): ?string
    {
        return $this->domainUsers;
    }

    protected function setNif(string $nif): static
    {
        Assertion::maxLength($nif, 25, 'nif value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->nif = $nif;

        return $this;
    }

    public function getNif(): string
    {
        return $this->nif;
    }

    protected function setDistributeMethod(string $distributeMethod): static
    {
        Assertion::maxLength($distributeMethod, 25, 'distributeMethod value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $distributeMethod,
            [
                CompanyInterface::DISTRIBUTEMETHOD_STATIC,
                CompanyInterface::DISTRIBUTEMETHOD_RR,
                CompanyInterface::DISTRIBUTEMETHOD_HASH,
            ],
            'distributeMethodvalue "%s" is not an element of the valid values: %s'
        );

        $this->distributeMethod = $distributeMethod;

        return $this;
    }

    public function getDistributeMethod(): string
    {
        return $this->distributeMethod;
    }

    protected function setMaxCalls(int $maxCalls): static
    {
        Assertion::greaterOrEqualThan($maxCalls, 0, 'maxCalls provided "%s" is not greater or equal than "%s".');

        $this->maxCalls = $maxCalls;

        return $this;
    }

    public function getMaxCalls(): int
    {
        return $this->maxCalls;
    }

    protected function setMaxDailyUsage(int $maxDailyUsage): static
    {
        Assertion::greaterOrEqualThan($maxDailyUsage, 0, 'maxDailyUsage provided "%s" is not greater or equal than "%s".');

        $this->maxDailyUsage = $maxDailyUsage;

        return $this;
    }

    public function getMaxDailyUsage(): int
    {
        return $this->maxDailyUsage;
    }

    protected function setCurrentDayUsage(?float $currentDayUsage = null): static
    {
        if (!is_null($currentDayUsage)) {
            $currentDayUsage = (float) $currentDayUsage;
        }

        $this->currentDayUsage = $currentDayUsage;

        return $this;
    }

    public function getCurrentDayUsage(): ?float
    {
        return $this->currentDayUsage;
    }

    protected function setMaxDailyUsageEmail(?string $maxDailyUsageEmail = null): static
    {
        if (!is_null($maxDailyUsageEmail)) {
            Assertion::maxLength($maxDailyUsageEmail, 100, 'maxDailyUsageEmail value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->maxDailyUsageEmail = $maxDailyUsageEmail;

        return $this;
    }

    public function getMaxDailyUsageEmail(): ?string
    {
        return $this->maxDailyUsageEmail;
    }

    protected function setPostalAddress(string $postalAddress): static
    {
        Assertion::maxLength($postalAddress, 255, 'postalAddress value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->postalAddress = $postalAddress;

        return $this;
    }

    public function getPostalAddress(): string
    {
        return $this->postalAddress;
    }

    protected function setPostalCode(string $postalCode): static
    {
        Assertion::maxLength($postalCode, 10, 'postalCode value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->postalCode = $postalCode;

        return $this;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    protected function setTown(string $town): static
    {
        Assertion::maxLength($town, 255, 'town value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->town = $town;

        return $this;
    }

    public function getTown(): string
    {
        return $this->town;
    }

    protected function setProvince(string $province): static
    {
        Assertion::maxLength($province, 255, 'province value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->province = $province;

        return $this;
    }

    public function getProvince(): string
    {
        return $this->province;
    }

    protected function setCountryName(string $countryName): static
    {
        Assertion::maxLength($countryName, 255, 'countryName value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->countryName = $countryName;

        return $this;
    }

    public function getCountryName(): string
    {
        return $this->countryName;
    }

    protected function setIpfilter(?bool $ipfilter = null): static
    {
        $this->ipfilter = $ipfilter;

        return $this;
    }

    public function getIpfilter(): ?bool
    {
        return $this->ipfilter;
    }

    protected function setOnDemandRecord(?int $onDemandRecord = null): static
    {
        $this->onDemandRecord = $onDemandRecord;

        return $this;
    }

    public function getOnDemandRecord(): ?int
    {
        return $this->onDemandRecord;
    }

    protected function setAllowRecordingRemoval(bool $allowRecordingRemoval): static
    {
        $this->allowRecordingRemoval = $allowRecordingRemoval;

        return $this;
    }

    public function getAllowRecordingRemoval(): bool
    {
        return $this->allowRecordingRemoval;
    }

    protected function setOnDemandRecordCode(?string $onDemandRecordCode = null): static
    {
        if (!is_null($onDemandRecordCode)) {
            Assertion::maxLength($onDemandRecordCode, 3, 'onDemandRecordCode value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->onDemandRecordCode = $onDemandRecordCode;

        return $this;
    }

    public function getOnDemandRecordCode(): ?string
    {
        return $this->onDemandRecordCode;
    }

    protected function setExternallyextraopts(?string $externallyextraopts = null): static
    {
        if (!is_null($externallyextraopts)) {
            Assertion::maxLength($externallyextraopts, 65535, 'externallyextraopts value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->externallyextraopts = $externallyextraopts;

        return $this;
    }

    public function getExternallyextraopts(): ?string
    {
        return $this->externallyextraopts;
    }

    protected function setRecordingsLimitMB(?int $recordingsLimitMB = null): static
    {
        $this->recordingsLimitMB = $recordingsLimitMB;

        return $this;
    }

    public function getRecordingsLimitMB(): ?int
    {
        return $this->recordingsLimitMB;
    }

    protected function setRecordingsLimitEmail(?string $recordingsLimitEmail = null): static
    {
        if (!is_null($recordingsLimitEmail)) {
            Assertion::maxLength($recordingsLimitEmail, 250, 'recordingsLimitEmail value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->recordingsLimitEmail = $recordingsLimitEmail;

        return $this;
    }

    public function getRecordingsLimitEmail(): ?string
    {
        return $this->recordingsLimitEmail;
    }

    protected function setBillingMethod(string $billingMethod): static
    {
        Assertion::maxLength($billingMethod, 25, 'billingMethod value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $billingMethod,
            [
                CompanyInterface::BILLINGMETHOD_POSTPAID,
                CompanyInterface::BILLINGMETHOD_PREPAID,
                CompanyInterface::BILLINGMETHOD_PSEUDOPREPAID,
            ],
            'billingMethodvalue "%s" is not an element of the valid values: %s'
        );

        $this->billingMethod = $billingMethod;

        return $this;
    }

    public function getBillingMethod(): string
    {
        return $this->billingMethod;
    }

    protected function setBalance(?float $balance = null): static
    {
        if (!is_null($balance)) {
            $balance = (float) $balance;
        }

        $this->balance = $balance;

        return $this;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    protected function setShowInvoices(?bool $showInvoices = null): static
    {
        $this->showInvoices = $showInvoices;

        return $this;
    }

    public function getShowInvoices(): ?bool
    {
        return $this->showInvoices;
    }

    protected function setLanguage(?LanguageInterface $language = null): static
    {
        $this->language = $language;

        return $this;
    }

    public function getLanguage(): ?LanguageInterface
    {
        return $this->language;
    }

    protected function setMediaRelaySets(?MediaRelaySetInterface $mediaRelaySets = null): static
    {
        $this->mediaRelaySets = $mediaRelaySets;

        return $this;
    }

    public function getMediaRelaySets(): ?MediaRelaySetInterface
    {
        return $this->mediaRelaySets;
    }

    protected function setDefaultTimezone(?TimezoneInterface $defaultTimezone = null): static
    {
        $this->defaultTimezone = $defaultTimezone;

        return $this;
    }

    public function getDefaultTimezone(): ?TimezoneInterface
    {
        return $this->defaultTimezone;
    }

    public function setBrand(BrandInterface $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): BrandInterface
    {
        return $this->brand;
    }

    protected function setDomain(?DomainInterface $domain = null): static
    {
        $this->domain = $domain;

        return $this;
    }

    public function getDomain(): ?DomainInterface
    {
        return $this->domain;
    }

    protected function setApplicationServer(?ApplicationServerInterface $applicationServer = null): static
    {
        $this->applicationServer = $applicationServer;

        return $this;
    }

    public function getApplicationServer(): ?ApplicationServerInterface
    {
        return $this->applicationServer;
    }

    protected function setCountry(CountryInterface $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getCountry(): CountryInterface
    {
        return $this->country;
    }

    protected function setCurrency(?CurrencyInterface $currency = null): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getCurrency(): ?CurrencyInterface
    {
        return $this->currency;
    }

    protected function setTransformationRuleSet(?TransformationRuleSetInterface $transformationRuleSet = null): static
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    public function getTransformationRuleSet(): ?TransformationRuleSetInterface
    {
        return $this->transformationRuleSet;
    }

    protected function setOutgoingDdi(?DdiInterface $outgoingDdi = null): static
    {
        $this->outgoingDdi = $outgoingDdi;

        return $this;
    }

    public function getOutgoingDdi(): ?DdiInterface
    {
        return $this->outgoingDdi;
    }

    protected function setOutgoingDdiRule(?OutgoingDdiRuleInterface $outgoingDdiRule = null): static
    {
        $this->outgoingDdiRule = $outgoingDdiRule;

        return $this;
    }

    public function getOutgoingDdiRule(): ?OutgoingDdiRuleInterface
    {
        return $this->outgoingDdiRule;
    }

    protected function setVoicemailNotificationTemplate(?NotificationTemplateInterface $voicemailNotificationTemplate = null): static
    {
        $this->voicemailNotificationTemplate = $voicemailNotificationTemplate;

        return $this;
    }

    public function getVoicemailNotificationTemplate(): ?NotificationTemplateInterface
    {
        return $this->voicemailNotificationTemplate;
    }

    protected function setFaxNotificationTemplate(?NotificationTemplateInterface $faxNotificationTemplate = null): static
    {
        $this->faxNotificationTemplate = $faxNotificationTemplate;

        return $this;
    }

    public function getFaxNotificationTemplate(): ?NotificationTemplateInterface
    {
        return $this->faxNotificationTemplate;
    }

    protected function setInvoiceNotificationTemplate(?NotificationTemplateInterface $invoiceNotificationTemplate = null): static
    {
        $this->invoiceNotificationTemplate = $invoiceNotificationTemplate;

        return $this;
    }

    public function getInvoiceNotificationTemplate(): ?NotificationTemplateInterface
    {
        return $this->invoiceNotificationTemplate;
    }

    protected function setCallCsvNotificationTemplate(?NotificationTemplateInterface $callCsvNotificationTemplate = null): static
    {
        $this->callCsvNotificationTemplate = $callCsvNotificationTemplate;

        return $this;
    }

    public function getCallCsvNotificationTemplate(): ?NotificationTemplateInterface
    {
        return $this->callCsvNotificationTemplate;
    }

    protected function setMaxDailyUsageNotificationTemplate(?NotificationTemplateInterface $maxDailyUsageNotificationTemplate = null): static
    {
        $this->maxDailyUsageNotificationTemplate = $maxDailyUsageNotificationTemplate;

        return $this;
    }

    public function getMaxDailyUsageNotificationTemplate(): ?NotificationTemplateInterface
    {
        return $this->maxDailyUsageNotificationTemplate;
    }
}
