<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\Company;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var string
     */
    protected $type = 'vpbx';

    /**
     * @var string
     */
    protected $name;

    /**
     * column: domain_users
     * @var string | null
     */
    protected $domainUsers;

    /**
     * @var string
     */
    protected $nif;

    /**
     * comment: enum:static|rr|hash
     * @var string
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
     * @var float | null
     */
    protected $currentDayUsage = 0;

    /**
     * @var string | null
     */
    protected $maxDailyUsageEmail;

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
     * column: country
     * @var string
     */
    protected $countryName;

    /**
     * column: ipFilter
     * @var bool | null
     */
    protected $ipfilter = true;

    /**
     * @var int | null
     */
    protected $onDemandRecord = 0;

    /**
     * @var bool
     */
    protected $allowRecordingRemoval = true;

    /**
     * @var string | null
     */
    protected $onDemandRecordCode;

    /**
     * column: externallyExtraOpts
     * @var string | null
     */
    protected $externallyextraopts;

    /**
     * @var int | null
     */
    protected $recordingsLimitMB;

    /**
     * @var string | null
     */
    protected $recordingsLimitEmail;

    /**
     * comment: enum:postpaid|prepaid|pseudoprepaid
     * @var string
     */
    protected $billingMethod = 'postpaid';

    /**
     * @var float | null
     */
    protected $balance = 0;

    /**
     * @var bool | null
     */
    protected $showInvoices = false;

    /**
     * @var LanguageInterface
     */
    protected $language;

    /**
     * @var MediaRelaySetInterface
     */
    protected $mediaRelaySets;

    /**
     * @var TimezoneInterface
     */
    protected $defaultTimezone;

    /**
     * @var BrandInterface
     * inversedBy companies
     */
    protected $brand;

    /**
     * @var DomainInterface
     */
    protected $domain;

    /**
     * @var ApplicationServerInterface
     */
    protected $applicationServer;

    /**
     * @var CountryInterface
     */
    protected $country;

    /**
     * @var CurrencyInterface
     */
    protected $currency;

    /**
     * @var TransformationRuleSetInterface
     */
    protected $transformationRuleSet;

    /**
     * @var DdiInterface
     */
    protected $outgoingDdi;

    /**
     * @var OutgoingDdiRuleInterface
     */
    protected $outgoingDdiRule;

    /**
     * @var NotificationTemplateInterface
     */
    protected $voicemailNotificationTemplate;

    /**
     * @var NotificationTemplateInterface
     */
    protected $faxNotificationTemplate;

    /**
     * @var NotificationTemplateInterface
     */
    protected $invoiceNotificationTemplate;

    /**
     * @var NotificationTemplateInterface
     */
    protected $callCsvNotificationTemplate;

    /**
     * @var NotificationTemplateInterface
     */
    protected $maxDailyUsageNotificationTemplate;

    /**
     * Constructor
     */
    protected function __construct(
        $type,
        $name,
        $nif,
        $distributeMethod,
        $maxCalls,
        $maxDailyUsage,
        $postalAddress,
        $postalCode,
        $town,
        $province,
        $countryName,
        $allowRecordingRemoval,
        $billingMethod
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
     * @param null $id
     * @return CompanyDto
     */
    public static function createDto($id = null)
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
        $dto = $entity->toDto($depth-1);

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
     * @return CompanyDto
     */
    public function toDto($depth = 0)
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
            'countryId' => self::getCountry() ? self::getCountry()->getId() : null,
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

    /**
     * Set type
     *
     * @param string $type
     *
     * @return static
     */
    protected function setType(string $type): CompanyInterface
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

    /**
     * Get type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
     */
    protected function setName(string $name): CompanyInterface
    {
        Assertion::maxLength($name, 80, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set domainUsers
     *
     * @param string $domainUsers | null
     *
     * @return static
     */
    protected function setDomainUsers(?string $domainUsers = null): CompanyInterface
    {
        if (!is_null($domainUsers)) {
            Assertion::maxLength($domainUsers, 190, 'domainUsers value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->domainUsers = $domainUsers;

        return $this;
    }

    /**
     * Get domainUsers
     *
     * @return string | null
     */
    public function getDomainUsers(): ?string
    {
        return $this->domainUsers;
    }

    /**
     * Set nif
     *
     * @param string $nif
     *
     * @return static
     */
    protected function setNif(string $nif): CompanyInterface
    {
        Assertion::maxLength($nif, 25, 'nif value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->nif = $nif;

        return $this;
    }

    /**
     * Get nif
     *
     * @return string
     */
    public function getNif(): string
    {
        return $this->nif;
    }

    /**
     * Set distributeMethod
     *
     * @param string $distributeMethod
     *
     * @return static
     */
    protected function setDistributeMethod(string $distributeMethod): CompanyInterface
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

    /**
     * Get distributeMethod
     *
     * @return string
     */
    public function getDistributeMethod(): string
    {
        return $this->distributeMethod;
    }

    /**
     * Set maxCalls
     *
     * @param int $maxCalls
     *
     * @return static
     */
    protected function setMaxCalls(int $maxCalls): CompanyInterface
    {
        Assertion::greaterOrEqualThan($maxCalls, 0, 'maxCalls provided "%s" is not greater or equal than "%s".');

        $this->maxCalls = $maxCalls;

        return $this;
    }

    /**
     * Get maxCalls
     *
     * @return int
     */
    public function getMaxCalls(): int
    {
        return $this->maxCalls;
    }

    /**
     * Set maxDailyUsage
     *
     * @param int $maxDailyUsage
     *
     * @return static
     */
    protected function setMaxDailyUsage(int $maxDailyUsage): CompanyInterface
    {
        Assertion::greaterOrEqualThan($maxDailyUsage, 0, 'maxDailyUsage provided "%s" is not greater or equal than "%s".');

        $this->maxDailyUsage = $maxDailyUsage;

        return $this;
    }

    /**
     * Get maxDailyUsage
     *
     * @return int
     */
    public function getMaxDailyUsage(): int
    {
        return $this->maxDailyUsage;
    }

    /**
     * Set currentDayUsage
     *
     * @param float $currentDayUsage | null
     *
     * @return static
     */
    protected function setCurrentDayUsage(?float $currentDayUsage = null): CompanyInterface
    {
        if (!is_null($currentDayUsage)) {
            $currentDayUsage = (float) $currentDayUsage;
        }

        $this->currentDayUsage = $currentDayUsage;

        return $this;
    }

    /**
     * Get currentDayUsage
     *
     * @return float | null
     */
    public function getCurrentDayUsage(): ?float
    {
        return $this->currentDayUsage;
    }

    /**
     * Set maxDailyUsageEmail
     *
     * @param string $maxDailyUsageEmail | null
     *
     * @return static
     */
    protected function setMaxDailyUsageEmail(?string $maxDailyUsageEmail = null): CompanyInterface
    {
        if (!is_null($maxDailyUsageEmail)) {
            Assertion::maxLength($maxDailyUsageEmail, 100, 'maxDailyUsageEmail value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->maxDailyUsageEmail = $maxDailyUsageEmail;

        return $this;
    }

    /**
     * Get maxDailyUsageEmail
     *
     * @return string | null
     */
    public function getMaxDailyUsageEmail(): ?string
    {
        return $this->maxDailyUsageEmail;
    }

    /**
     * Set postalAddress
     *
     * @param string $postalAddress
     *
     * @return static
     */
    protected function setPostalAddress(string $postalAddress): CompanyInterface
    {
        Assertion::maxLength($postalAddress, 255, 'postalAddress value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->postalAddress = $postalAddress;

        return $this;
    }

    /**
     * Get postalAddress
     *
     * @return string
     */
    public function getPostalAddress(): string
    {
        return $this->postalAddress;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     *
     * @return static
     */
    protected function setPostalCode(string $postalCode): CompanyInterface
    {
        Assertion::maxLength($postalCode, 10, 'postalCode value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * Set town
     *
     * @param string $town
     *
     * @return static
     */
    protected function setTown(string $town): CompanyInterface
    {
        Assertion::maxLength($town, 255, 'town value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return string
     */
    public function getTown(): string
    {
        return $this->town;
    }

    /**
     * Set province
     *
     * @param string $province
     *
     * @return static
     */
    protected function setProvince(string $province): CompanyInterface
    {
        Assertion::maxLength($province, 255, 'province value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return string
     */
    public function getProvince(): string
    {
        return $this->province;
    }

    /**
     * Set countryName
     *
     * @param string $countryName
     *
     * @return static
     */
    protected function setCountryName(string $countryName): CompanyInterface
    {
        Assertion::maxLength($countryName, 255, 'countryName value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->countryName = $countryName;

        return $this;
    }

    /**
     * Get countryName
     *
     * @return string
     */
    public function getCountryName(): string
    {
        return $this->countryName;
    }

    /**
     * Set ipfilter
     *
     * @param bool $ipfilter | null
     *
     * @return static
     */
    protected function setIpfilter(?bool $ipfilter = null): CompanyInterface
    {
        if (!is_null($ipfilter)) {
            Assertion::between(intval($ipfilter), 0, 1, 'ipfilter provided "%s" is not a valid boolean value.');
            $ipfilter = (bool) $ipfilter;
        }

        $this->ipfilter = $ipfilter;

        return $this;
    }

    /**
     * Get ipfilter
     *
     * @return bool | null
     */
    public function getIpfilter(): ?bool
    {
        return $this->ipfilter;
    }

    /**
     * Set onDemandRecord
     *
     * @param int $onDemandRecord | null
     *
     * @return static
     */
    protected function setOnDemandRecord(?int $onDemandRecord = null): CompanyInterface
    {
        $this->onDemandRecord = $onDemandRecord;

        return $this;
    }

    /**
     * Get onDemandRecord
     *
     * @return int | null
     */
    public function getOnDemandRecord(): ?int
    {
        return $this->onDemandRecord;
    }

    /**
     * Set allowRecordingRemoval
     *
     * @param bool $allowRecordingRemoval
     *
     * @return static
     */
    protected function setAllowRecordingRemoval(bool $allowRecordingRemoval): CompanyInterface
    {
        Assertion::between(intval($allowRecordingRemoval), 0, 1, 'allowRecordingRemoval provided "%s" is not a valid boolean value.');
        $allowRecordingRemoval = (bool) $allowRecordingRemoval;

        $this->allowRecordingRemoval = $allowRecordingRemoval;

        return $this;
    }

    /**
     * Get allowRecordingRemoval
     *
     * @return bool
     */
    public function getAllowRecordingRemoval(): bool
    {
        return $this->allowRecordingRemoval;
    }

    /**
     * Set onDemandRecordCode
     *
     * @param string $onDemandRecordCode | null
     *
     * @return static
     */
    protected function setOnDemandRecordCode(?string $onDemandRecordCode = null): CompanyInterface
    {
        if (!is_null($onDemandRecordCode)) {
            Assertion::maxLength($onDemandRecordCode, 3, 'onDemandRecordCode value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->onDemandRecordCode = $onDemandRecordCode;

        return $this;
    }

    /**
     * Get onDemandRecordCode
     *
     * @return string | null
     */
    public function getOnDemandRecordCode(): ?string
    {
        return $this->onDemandRecordCode;
    }

    /**
     * Set externallyextraopts
     *
     * @param string $externallyextraopts | null
     *
     * @return static
     */
    protected function setExternallyextraopts(?string $externallyextraopts = null): CompanyInterface
    {
        if (!is_null($externallyextraopts)) {
            Assertion::maxLength($externallyextraopts, 65535, 'externallyextraopts value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->externallyextraopts = $externallyextraopts;

        return $this;
    }

    /**
     * Get externallyextraopts
     *
     * @return string | null
     */
    public function getExternallyextraopts(): ?string
    {
        return $this->externallyextraopts;
    }

    /**
     * Set recordingsLimitMB
     *
     * @param int $recordingsLimitMB | null
     *
     * @return static
     */
    protected function setRecordingsLimitMB(?int $recordingsLimitMB = null): CompanyInterface
    {
        $this->recordingsLimitMB = $recordingsLimitMB;

        return $this;
    }

    /**
     * Get recordingsLimitMB
     *
     * @return int | null
     */
    public function getRecordingsLimitMB(): ?int
    {
        return $this->recordingsLimitMB;
    }

    /**
     * Set recordingsLimitEmail
     *
     * @param string $recordingsLimitEmail | null
     *
     * @return static
     */
    protected function setRecordingsLimitEmail(?string $recordingsLimitEmail = null): CompanyInterface
    {
        if (!is_null($recordingsLimitEmail)) {
            Assertion::maxLength($recordingsLimitEmail, 250, 'recordingsLimitEmail value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->recordingsLimitEmail = $recordingsLimitEmail;

        return $this;
    }

    /**
     * Get recordingsLimitEmail
     *
     * @return string | null
     */
    public function getRecordingsLimitEmail(): ?string
    {
        return $this->recordingsLimitEmail;
    }

    /**
     * Set billingMethod
     *
     * @param string $billingMethod
     *
     * @return static
     */
    protected function setBillingMethod(string $billingMethod): CompanyInterface
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

    /**
     * Get billingMethod
     *
     * @return string
     */
    public function getBillingMethod(): string
    {
        return $this->billingMethod;
    }

    /**
     * Set balance
     *
     * @param float $balance | null
     *
     * @return static
     */
    protected function setBalance(?float $balance = null): CompanyInterface
    {
        if (!is_null($balance)) {
            $balance = (float) $balance;
        }

        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return float | null
     */
    public function getBalance(): ?float
    {
        return $this->balance;
    }

    /**
     * Set showInvoices
     *
     * @param bool $showInvoices | null
     *
     * @return static
     */
    protected function setShowInvoices(?bool $showInvoices = null): CompanyInterface
    {
        if (!is_null($showInvoices)) {
            Assertion::between(intval($showInvoices), 0, 1, 'showInvoices provided "%s" is not a valid boolean value.');
            $showInvoices = (bool) $showInvoices;
        }

        $this->showInvoices = $showInvoices;

        return $this;
    }

    /**
     * Get showInvoices
     *
     * @return bool | null
     */
    public function getShowInvoices(): ?bool
    {
        return $this->showInvoices;
    }

    /**
     * Set language
     *
     * @param LanguageInterface | null
     *
     * @return static
     */
    protected function setLanguage(?LanguageInterface $language = null): CompanyInterface
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return LanguageInterface | null
     */
    public function getLanguage(): ?LanguageInterface
    {
        return $this->language;
    }

    /**
     * Set mediaRelaySets
     *
     * @param MediaRelaySetInterface | null
     *
     * @return static
     */
    protected function setMediaRelaySets(?MediaRelaySetInterface $mediaRelaySets = null): CompanyInterface
    {
        $this->mediaRelaySets = $mediaRelaySets;

        return $this;
    }

    /**
     * Get mediaRelaySets
     *
     * @return MediaRelaySetInterface | null
     */
    public function getMediaRelaySets(): ?MediaRelaySetInterface
    {
        return $this->mediaRelaySets;
    }

    /**
     * Set defaultTimezone
     *
     * @param TimezoneInterface | null
     *
     * @return static
     */
    protected function setDefaultTimezone(?TimezoneInterface $defaultTimezone = null): CompanyInterface
    {
        $this->defaultTimezone = $defaultTimezone;

        return $this;
    }

    /**
     * Get defaultTimezone
     *
     * @return TimezoneInterface | null
     */
    public function getDefaultTimezone(): ?TimezoneInterface
    {
        return $this->defaultTimezone;
    }

    /**
     * Set brand
     *
     * @param BrandInterface
     *
     * @return static
     */
    public function setBrand(BrandInterface $brand): CompanyInterface
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface
    {
        return $this->brand;
    }

    /**
     * Set domain
     *
     * @param DomainInterface | null
     *
     * @return static
     */
    protected function setDomain(?DomainInterface $domain = null): CompanyInterface
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return DomainInterface | null
     */
    public function getDomain(): ?DomainInterface
    {
        return $this->domain;
    }

    /**
     * Set applicationServer
     *
     * @param ApplicationServerInterface | null
     *
     * @return static
     */
    protected function setApplicationServer(?ApplicationServerInterface $applicationServer = null): CompanyInterface
    {
        $this->applicationServer = $applicationServer;

        return $this;
    }

    /**
     * Get applicationServer
     *
     * @return ApplicationServerInterface | null
     */
    public function getApplicationServer(): ?ApplicationServerInterface
    {
        return $this->applicationServer;
    }

    /**
     * Set country
     *
     * @param CountryInterface | null
     *
     * @return static
     */
    protected function setCountry(?CountryInterface $country = null): CompanyInterface
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return CountryInterface | null
     */
    public function getCountry(): ?CountryInterface
    {
        return $this->country;
    }

    /**
     * Set currency
     *
     * @param CurrencyInterface | null
     *
     * @return static
     */
    protected function setCurrency(?CurrencyInterface $currency = null): CompanyInterface
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return CurrencyInterface | null
     */
    public function getCurrency(): ?CurrencyInterface
    {
        return $this->currency;
    }

    /**
     * Set transformationRuleSet
     *
     * @param TransformationRuleSetInterface | null
     *
     * @return static
     */
    protected function setTransformationRuleSet(?TransformationRuleSetInterface $transformationRuleSet = null): CompanyInterface
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    /**
     * Get transformationRuleSet
     *
     * @return TransformationRuleSetInterface | null
     */
    public function getTransformationRuleSet(): ?TransformationRuleSetInterface
    {
        return $this->transformationRuleSet;
    }

    /**
     * Set outgoingDdi
     *
     * @param DdiInterface | null
     *
     * @return static
     */
    protected function setOutgoingDdi(?DdiInterface $outgoingDdi = null): CompanyInterface
    {
        $this->outgoingDdi = $outgoingDdi;

        return $this;
    }

    /**
     * Get outgoingDdi
     *
     * @return DdiInterface | null
     */
    public function getOutgoingDdi(): ?DdiInterface
    {
        return $this->outgoingDdi;
    }

    /**
     * Set outgoingDdiRule
     *
     * @param OutgoingDdiRuleInterface | null
     *
     * @return static
     */
    protected function setOutgoingDdiRule(?OutgoingDdiRuleInterface $outgoingDdiRule = null): CompanyInterface
    {
        $this->outgoingDdiRule = $outgoingDdiRule;

        return $this;
    }

    /**
     * Get outgoingDdiRule
     *
     * @return OutgoingDdiRuleInterface | null
     */
    public function getOutgoingDdiRule(): ?OutgoingDdiRuleInterface
    {
        return $this->outgoingDdiRule;
    }

    /**
     * Set voicemailNotificationTemplate
     *
     * @param NotificationTemplateInterface | null
     *
     * @return static
     */
    protected function setVoicemailNotificationTemplate(?NotificationTemplateInterface $voicemailNotificationTemplate = null): CompanyInterface
    {
        $this->voicemailNotificationTemplate = $voicemailNotificationTemplate;

        return $this;
    }

    /**
     * Get voicemailNotificationTemplate
     *
     * @return NotificationTemplateInterface | null
     */
    public function getVoicemailNotificationTemplate(): ?NotificationTemplateInterface
    {
        return $this->voicemailNotificationTemplate;
    }

    /**
     * Set faxNotificationTemplate
     *
     * @param NotificationTemplateInterface | null
     *
     * @return static
     */
    protected function setFaxNotificationTemplate(?NotificationTemplateInterface $faxNotificationTemplate = null): CompanyInterface
    {
        $this->faxNotificationTemplate = $faxNotificationTemplate;

        return $this;
    }

    /**
     * Get faxNotificationTemplate
     *
     * @return NotificationTemplateInterface | null
     */
    public function getFaxNotificationTemplate(): ?NotificationTemplateInterface
    {
        return $this->faxNotificationTemplate;
    }

    /**
     * Set invoiceNotificationTemplate
     *
     * @param NotificationTemplateInterface | null
     *
     * @return static
     */
    protected function setInvoiceNotificationTemplate(?NotificationTemplateInterface $invoiceNotificationTemplate = null): CompanyInterface
    {
        $this->invoiceNotificationTemplate = $invoiceNotificationTemplate;

        return $this;
    }

    /**
     * Get invoiceNotificationTemplate
     *
     * @return NotificationTemplateInterface | null
     */
    public function getInvoiceNotificationTemplate(): ?NotificationTemplateInterface
    {
        return $this->invoiceNotificationTemplate;
    }

    /**
     * Set callCsvNotificationTemplate
     *
     * @param NotificationTemplateInterface | null
     *
     * @return static
     */
    protected function setCallCsvNotificationTemplate(?NotificationTemplateInterface $callCsvNotificationTemplate = null): CompanyInterface
    {
        $this->callCsvNotificationTemplate = $callCsvNotificationTemplate;

        return $this;
    }

    /**
     * Get callCsvNotificationTemplate
     *
     * @return NotificationTemplateInterface | null
     */
    public function getCallCsvNotificationTemplate(): ?NotificationTemplateInterface
    {
        return $this->callCsvNotificationTemplate;
    }

    /**
     * Set maxDailyUsageNotificationTemplate
     *
     * @param NotificationTemplateInterface | null
     *
     * @return static
     */
    protected function setMaxDailyUsageNotificationTemplate(?NotificationTemplateInterface $maxDailyUsageNotificationTemplate = null): CompanyInterface
    {
        $this->maxDailyUsageNotificationTemplate = $maxDailyUsageNotificationTemplate;

        return $this;
    }

    /**
     * Get maxDailyUsageNotificationTemplate
     *
     * @return NotificationTemplateInterface | null
     */
    public function getMaxDailyUsageNotificationTemplate(): ?NotificationTemplateInterface
    {
        return $this->maxDailyUsageNotificationTemplate;
    }

}
