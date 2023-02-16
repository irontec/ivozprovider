<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Company;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\Invoicing;
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
     * @var string
     * comment: enum:vpbx|retail|wholesale|residential
     */
    protected $type = 'vpbx';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var ?string
     * column: domain_users
     */
    protected $domainUsers = null;

    /**
     * @var string
     * comment: enum:static|rr|hash
     */
    protected $distributeMethod = 'hash';

    /**
     * @var int
     */
    protected $maxCalls = 0;

    /**
     * @var int
     */
    protected $maxDailyUsage = 1000000;

    /**
     * @var ?float
     */
    protected $currentDayUsage = 0;

    /**
     * @var ?string
     */
    protected $maxDailyUsageEmail = null;

    /**
     * @var ?bool
     * column: ipFilter
     */
    protected $ipfilter = true;

    /**
     * @var ?int
     */
    protected $onDemandRecord = 0;

    /**
     * @var bool
     */
    protected $allowRecordingRemoval = true;

    /**
     * @var ?string
     */
    protected $onDemandRecordCode = null;

    /**
     * @var ?string
     * column: externallyExtraOpts
     */
    protected $externallyextraopts = null;

    /**
     * @var ?int
     */
    protected $recordingsLimitMB = null;

    /**
     * @var ?string
     */
    protected $recordingsLimitEmail = null;

    /**
     * @var string
     * comment: enum:postpaid|prepaid|pseudoprepaid|none
     */
    protected $billingMethod = 'postpaid';

    /**
     * @var ?float
     */
    protected $balance = 0;

    /**
     * @var ?bool
     */
    protected $showInvoices = false;

    /**
     * @var Invoicing
     */
    protected $invoicing;

    /**
     * @var ?LanguageInterface
     */
    protected $language = null;

    /**
     * @var ?MediaRelaySetInterface
     */
    protected $mediaRelaySets = null;

    /**
     * @var ?TimezoneInterface
     */
    protected $defaultTimezone = null;

    /**
     * @var BrandInterface
     * inversedBy companies
     */
    protected $brand;

    /**
     * @var ?DomainInterface
     */
    protected $domain = null;

    /**
     * @var ?ApplicationServerInterface
     */
    protected $applicationServer = null;

    /**
     * @var CountryInterface
     */
    protected $country;

    /**
     * @var ?CurrencyInterface
     */
    protected $currency = null;

    /**
     * @var ?TransformationRuleSetInterface
     */
    protected $transformationRuleSet = null;

    /**
     * @var ?DdiInterface
     */
    protected $outgoingDdi = null;

    /**
     * @var ?OutgoingDdiRuleInterface
     */
    protected $outgoingDdiRule = null;

    /**
     * @var ?NotificationTemplateInterface
     */
    protected $voicemailNotificationTemplate = null;

    /**
     * @var ?NotificationTemplateInterface
     */
    protected $faxNotificationTemplate = null;

    /**
     * @var ?NotificationTemplateInterface
     */
    protected $invoiceNotificationTemplate = null;

    /**
     * @var ?NotificationTemplateInterface
     */
    protected $callCsvNotificationTemplate = null;

    /**
     * @var ?NotificationTemplateInterface
     */
    protected $maxDailyUsageNotificationTemplate = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $type,
        string $name,
        string $distributeMethod,
        int $maxCalls,
        int $maxDailyUsage,
        bool $allowRecordingRemoval,
        string $billingMethod,
        Invoicing $invoicing
    ) {
        $this->setType($type);
        $this->setName($name);
        $this->setDistributeMethod($distributeMethod);
        $this->setMaxCalls($maxCalls);
        $this->setMaxDailyUsage($maxDailyUsage);
        $this->setAllowRecordingRemoval($allowRecordingRemoval);
        $this->setBillingMethod($billingMethod);
        $this->invoicing = $invoicing;
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Company",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): CompanyDto
    {
        return new CompanyDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|CompanyInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CompanyDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CompanyDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CompanyDto::class);
        $invoicingNif = $dto->getInvoicingNif();
        Assertion::notNull($invoicingNif, 'invoicingNif value is null, but non null value was expected.');
        $invoicingPostalAddress = $dto->getInvoicingPostalAddress();
        Assertion::notNull($invoicingPostalAddress, 'invoicingPostalAddress value is null, but non null value was expected.');
        $invoicingPostalCode = $dto->getInvoicingPostalCode();
        Assertion::notNull($invoicingPostalCode, 'invoicingPostalCode value is null, but non null value was expected.');
        $invoicingTown = $dto->getInvoicingTown();
        Assertion::notNull($invoicingTown, 'invoicingTown value is null, but non null value was expected.');
        $invoicingProvince = $dto->getInvoicingProvince();
        Assertion::notNull($invoicingProvince, 'invoicingProvince value is null, but non null value was expected.');
        $invoicingCountryName = $dto->getInvoicingCountryName();
        Assertion::notNull($invoicingCountryName, 'invoicingCountryName value is null, but non null value was expected.');
        $type = $dto->getType();
        Assertion::notNull($type, 'getType value is null, but non null value was expected.');
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $distributeMethod = $dto->getDistributeMethod();
        Assertion::notNull($distributeMethod, 'getDistributeMethod value is null, but non null value was expected.');
        $maxCalls = $dto->getMaxCalls();
        Assertion::notNull($maxCalls, 'getMaxCalls value is null, but non null value was expected.');
        $maxDailyUsage = $dto->getMaxDailyUsage();
        Assertion::notNull($maxDailyUsage, 'getMaxDailyUsage value is null, but non null value was expected.');
        $allowRecordingRemoval = $dto->getAllowRecordingRemoval();
        Assertion::notNull($allowRecordingRemoval, 'getAllowRecordingRemoval value is null, but non null value was expected.');
        $billingMethod = $dto->getBillingMethod();
        Assertion::notNull($billingMethod, 'getBillingMethod value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');
        $country = $dto->getCountry();
        Assertion::notNull($country, 'getCountry value is null, but non null value was expected.');

        $invoicing = new Invoicing(
            $invoicingNif,
            $invoicingPostalAddress,
            $invoicingPostalCode,
            $invoicingTown,
            $invoicingProvince,
            $invoicingCountryName
        );

        $self = new static(
            $type,
            $name,
            $distributeMethod,
            $maxCalls,
            $maxDailyUsage,
            $allowRecordingRemoval,
            $billingMethod,
            $invoicing
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
            ->setBrand($fkTransformer->transform($brand))
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setApplicationServer($fkTransformer->transform($dto->getApplicationServer()))
            ->setCountry($fkTransformer->transform($country))
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
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CompanyDto::class);

        $invoicingNif = $dto->getInvoicingNif();
        Assertion::notNull($invoicingNif, 'invoicingNif value is null, but non null value was expected.');
        $invoicingPostalAddress = $dto->getInvoicingPostalAddress();
        Assertion::notNull($invoicingPostalAddress, 'invoicingPostalAddress value is null, but non null value was expected.');
        $invoicingPostalCode = $dto->getInvoicingPostalCode();
        Assertion::notNull($invoicingPostalCode, 'invoicingPostalCode value is null, but non null value was expected.');
        $invoicingTown = $dto->getInvoicingTown();
        Assertion::notNull($invoicingTown, 'invoicingTown value is null, but non null value was expected.');
        $invoicingProvince = $dto->getInvoicingProvince();
        Assertion::notNull($invoicingProvince, 'invoicingProvince value is null, but non null value was expected.');
        $invoicingCountryName = $dto->getInvoicingCountryName();
        Assertion::notNull($invoicingCountryName, 'invoicingCountryName value is null, but non null value was expected.');
        $type = $dto->getType();
        Assertion::notNull($type, 'getType value is null, but non null value was expected.');
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $distributeMethod = $dto->getDistributeMethod();
        Assertion::notNull($distributeMethod, 'getDistributeMethod value is null, but non null value was expected.');
        $maxCalls = $dto->getMaxCalls();
        Assertion::notNull($maxCalls, 'getMaxCalls value is null, but non null value was expected.');
        $maxDailyUsage = $dto->getMaxDailyUsage();
        Assertion::notNull($maxDailyUsage, 'getMaxDailyUsage value is null, but non null value was expected.');
        $allowRecordingRemoval = $dto->getAllowRecordingRemoval();
        Assertion::notNull($allowRecordingRemoval, 'getAllowRecordingRemoval value is null, but non null value was expected.');
        $billingMethod = $dto->getBillingMethod();
        Assertion::notNull($billingMethod, 'getBillingMethod value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');
        $country = $dto->getCountry();
        Assertion::notNull($country, 'getCountry value is null, but non null value was expected.');

        $invoicing = new Invoicing(
            $invoicingNif,
            $invoicingPostalAddress,
            $invoicingPostalCode,
            $invoicingTown,
            $invoicingProvince,
            $invoicingCountryName
        );

        $this
            ->setType($type)
            ->setName($name)
            ->setDomainUsers($dto->getDomainUsers())
            ->setDistributeMethod($distributeMethod)
            ->setMaxCalls($maxCalls)
            ->setMaxDailyUsage($maxDailyUsage)
            ->setCurrentDayUsage($dto->getCurrentDayUsage())
            ->setMaxDailyUsageEmail($dto->getMaxDailyUsageEmail())
            ->setIpfilter($dto->getIpfilter())
            ->setOnDemandRecord($dto->getOnDemandRecord())
            ->setAllowRecordingRemoval($allowRecordingRemoval)
            ->setOnDemandRecordCode($dto->getOnDemandRecordCode())
            ->setExternallyextraopts($dto->getExternallyextraopts())
            ->setRecordingsLimitMB($dto->getRecordingsLimitMB())
            ->setRecordingsLimitEmail($dto->getRecordingsLimitEmail())
            ->setBillingMethod($billingMethod)
            ->setBalance($dto->getBalance())
            ->setShowInvoices($dto->getShowInvoices())
            ->setInvoicing($invoicing)
            ->setLanguage($fkTransformer->transform($dto->getLanguage()))
            ->setMediaRelaySets($fkTransformer->transform($dto->getMediaRelaySets()))
            ->setDefaultTimezone($fkTransformer->transform($dto->getDefaultTimezone()))
            ->setBrand($fkTransformer->transform($brand))
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setApplicationServer($fkTransformer->transform($dto->getApplicationServer()))
            ->setCountry($fkTransformer->transform($country))
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
     */
    public function toDto(int $depth = 0): CompanyDto
    {
        return self::createDto()
            ->setType(self::getType())
            ->setName(self::getName())
            ->setDomainUsers(self::getDomainUsers())
            ->setDistributeMethod(self::getDistributeMethod())
            ->setMaxCalls(self::getMaxCalls())
            ->setMaxDailyUsage(self::getMaxDailyUsage())
            ->setCurrentDayUsage(self::getCurrentDayUsage())
            ->setMaxDailyUsageEmail(self::getMaxDailyUsageEmail())
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
            ->setInvoicingNif(self::getInvoicing()->getNif())
            ->setInvoicingPostalAddress(self::getInvoicing()->getPostalAddress())
            ->setInvoicingPostalCode(self::getInvoicing()->getPostalCode())
            ->setInvoicingTown(self::getInvoicing()->getTown())
            ->setInvoicingProvince(self::getInvoicing()->getProvince())
            ->setInvoicingCountryName(self::getInvoicing()->getCountryName())
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
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'type' => self::getType(),
            'name' => self::getName(),
            'domain_users' => self::getDomainUsers(),
            'distributeMethod' => self::getDistributeMethod(),
            'maxCalls' => self::getMaxCalls(),
            'maxDailyUsage' => self::getMaxDailyUsage(),
            'currentDayUsage' => self::getCurrentDayUsage(),
            'maxDailyUsageEmail' => self::getMaxDailyUsageEmail(),
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
            'invoicingNif' => self::getInvoicing()->getNif(),
            'invoicingPostalAddress' => self::getInvoicing()->getPostalAddress(),
            'invoicingPostalCode' => self::getInvoicing()->getPostalCode(),
            'invoicingTown' => self::getInvoicing()->getTown(),
            'invoicingProvince' => self::getInvoicing()->getProvince(),
            'invoicingCountryName' => self::getInvoicing()->getCountryName(),
            'languageId' => self::getLanguage()?->getId(),
            'mediaRelaySetsId' => self::getMediaRelaySets()?->getId(),
            'defaultTimezoneId' => self::getDefaultTimezone()?->getId(),
            'brandId' => self::getBrand()->getId(),
            'domainId' => self::getDomain()?->getId(),
            'applicationServerId' => self::getApplicationServer()?->getId(),
            'countryId' => self::getCountry()->getId(),
            'currencyId' => self::getCurrency()?->getId(),
            'transformationRuleSetId' => self::getTransformationRuleSet()?->getId(),
            'outgoingDdiId' => self::getOutgoingDdi()?->getId(),
            'outgoingDdiRuleId' => self::getOutgoingDdiRule()?->getId(),
            'voicemailNotificationTemplateId' => self::getVoicemailNotificationTemplate()?->getId(),
            'faxNotificationTemplateId' => self::getFaxNotificationTemplate()?->getId(),
            'invoiceNotificationTemplateId' => self::getInvoiceNotificationTemplate()?->getId(),
            'callCsvNotificationTemplateId' => self::getCallCsvNotificationTemplate()?->getId(),
            'maxDailyUsageNotificationTemplateId' => self::getMaxDailyUsageNotificationTemplate()?->getId()
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
                CompanyInterface::BILLINGMETHOD_NONE,
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

    public function getInvoicing(): Invoicing
    {
        return $this->invoicing;
    }

    protected function setInvoicing(Invoicing $invoicing): static
    {
        $isEqual = $this->invoicing->equals($invoicing);
        if ($isEqual) {
            return $this;
        }

        $this->invoicing = $invoicing;
        return $this;
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
