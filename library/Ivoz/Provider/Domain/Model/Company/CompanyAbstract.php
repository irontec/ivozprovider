<?php

namespace Ivoz\Provider\Domain\Model\Company;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * CompanyAbstract
 * @codeCoverageIgnore
 */
abstract class CompanyAbstract
{
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
     * @var integer
     */
    protected $maxCalls = 0;

    /**
     * @var integer
     */
    protected $maxDailyUsage = 1000000;

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
     * @var boolean | null
     */
    protected $ipfilter = true;

    /**
     * @var integer | null
     */
    protected $onDemandRecord = 0;

    /**
     * @var boolean
     */
    protected $allowRecordingRemoval = true;

    /**
     * @var string | null
     */
    protected $onDemandRecordCode;

    /**
     * @var string | null
     */
    protected $externallyextraopts;

    /**
     * @var integer | null
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
     * @var boolean | null
     */
    protected $showInvoices = false;

    /**
     * @var \Ivoz\Provider\Domain\Model\Language\LanguageInterface | null
     */
    protected $language;

    /**
     * @var \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface | null
     */
    protected $mediaRelaySets;

    /**
     * @var \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface | null
     */
    protected $defaultTimezone;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Domain\DomainInterface | null
     */
    protected $domain;

    /**
     * @var \Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface | null
     */
    protected $applicationServer;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    protected $country;

    /**
     * @var \Ivoz\Provider\Domain\Model\Currency\CurrencyInterface | null
     */
    protected $currency;

    /**
     * @var \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface | null
     */
    protected $transformationRuleSet;

    /**
     * @var \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    protected $outgoingDdi;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface | null
     */
    protected $outgoingDdiRule;

    /**
     * @var \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    protected $voicemailNotificationTemplate;

    /**
     * @var \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    protected $faxNotificationTemplate;

    /**
     * @var \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    protected $invoiceNotificationTemplate;

    /**
     * @var \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    protected $callCsvNotificationTemplate;


    use ChangelogTrait;

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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
        ;

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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
            ->setCallCsvNotificationTemplate($fkTransformer->transform($dto->getCallCsvNotificationTemplate()));



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
            ->setLanguage(\Ivoz\Provider\Domain\Model\Language\Language::entityToDto(self::getLanguage(), $depth))
            ->setMediaRelaySets(\Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySet::entityToDto(self::getMediaRelaySets(), $depth))
            ->setDefaultTimezone(\Ivoz\Provider\Domain\Model\Timezone\Timezone::entityToDto(self::getDefaultTimezone(), $depth))
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto(self::getBrand(), $depth))
            ->setDomain(\Ivoz\Provider\Domain\Model\Domain\Domain::entityToDto(self::getDomain(), $depth))
            ->setApplicationServer(\Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServer::entityToDto(self::getApplicationServer(), $depth))
            ->setCountry(\Ivoz\Provider\Domain\Model\Country\Country::entityToDto(self::getCountry(), $depth))
            ->setCurrency(\Ivoz\Provider\Domain\Model\Currency\Currency::entityToDto(self::getCurrency(), $depth))
            ->setTransformationRuleSet(\Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSet::entityToDto(self::getTransformationRuleSet(), $depth))
            ->setOutgoingDdi(\Ivoz\Provider\Domain\Model\Ddi\Ddi::entityToDto(self::getOutgoingDdi(), $depth))
            ->setOutgoingDdiRule(\Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRule::entityToDto(self::getOutgoingDdiRule(), $depth))
            ->setVoicemailNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate::entityToDto(self::getVoicemailNotificationTemplate(), $depth))
            ->setFaxNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate::entityToDto(self::getFaxNotificationTemplate(), $depth))
            ->setInvoiceNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate::entityToDto(self::getInvoiceNotificationTemplate(), $depth))
            ->setCallCsvNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate::entityToDto(self::getCallCsvNotificationTemplate(), $depth));
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
            'callCsvNotificationTemplateId' => self::getCallCsvNotificationTemplate() ? self::getCallCsvNotificationTemplate()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set type
     *
     * @param string $type
     *
     * @return static
     */
    protected function setType($type)
    {
        Assertion::notNull($type, 'type value "%s" is null, but non null value was expected.');
        Assertion::maxLength($type, 25, 'type value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($type, [
            CompanyInterface::TYPE_VPBX,
            CompanyInterface::TYPE_RETAIL,
            CompanyInterface::TYPE_WHOLESALE,
            CompanyInterface::TYPE_RESIDENTIAL
        ], 'typevalue "%s" is not an element of the valid values: %s');

        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
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
    protected function setName($name)
    {
        Assertion::notNull($name, 'name value "%s" is null, but non null value was expected.');
        Assertion::maxLength($name, 80, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
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
    protected function setDomainUsers($domainUsers = null)
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
    public function getDomainUsers()
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
    protected function setNif($nif)
    {
        Assertion::notNull($nif, 'nif value "%s" is null, but non null value was expected.');
        Assertion::maxLength($nif, 25, 'nif value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->nif = $nif;

        return $this;
    }

    /**
     * Get nif
     *
     * @return string
     */
    public function getNif()
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
    protected function setDistributeMethod($distributeMethod)
    {
        Assertion::notNull($distributeMethod, 'distributeMethod value "%s" is null, but non null value was expected.');
        Assertion::maxLength($distributeMethod, 25, 'distributeMethod value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($distributeMethod, [
            CompanyInterface::DISTRIBUTEMETHOD_STATIC,
            CompanyInterface::DISTRIBUTEMETHOD_RR,
            CompanyInterface::DISTRIBUTEMETHOD_HASH
        ], 'distributeMethodvalue "%s" is not an element of the valid values: %s');

        $this->distributeMethod = $distributeMethod;

        return $this;
    }

    /**
     * Get distributeMethod
     *
     * @return string
     */
    public function getDistributeMethod()
    {
        return $this->distributeMethod;
    }

    /**
     * Set maxCalls
     *
     * @param integer $maxCalls
     *
     * @return static
     */
    protected function setMaxCalls($maxCalls)
    {
        Assertion::notNull($maxCalls, 'maxCalls value "%s" is null, but non null value was expected.');
        Assertion::integerish($maxCalls, 'maxCalls value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($maxCalls, 0, 'maxCalls provided "%s" is not greater or equal than "%s".');

        $this->maxCalls = (int) $maxCalls;

        return $this;
    }

    /**
     * Get maxCalls
     *
     * @return integer
     */
    public function getMaxCalls()
    {
        return $this->maxCalls;
    }

    /**
     * Set maxDailyUsage
     *
     * @param integer $maxDailyUsage
     *
     * @return static
     */
    protected function setMaxDailyUsage($maxDailyUsage)
    {
        Assertion::notNull($maxDailyUsage, 'maxDailyUsage value "%s" is null, but non null value was expected.');
        Assertion::integerish($maxDailyUsage, 'maxDailyUsage value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($maxDailyUsage, 0, 'maxDailyUsage provided "%s" is not greater or equal than "%s".');

        $this->maxDailyUsage = (int) $maxDailyUsage;

        return $this;
    }

    /**
     * Get maxDailyUsage
     *
     * @return integer
     */
    public function getMaxDailyUsage()
    {
        return $this->maxDailyUsage;
    }

    /**
     * Set postalAddress
     *
     * @param string $postalAddress
     *
     * @return static
     */
    protected function setPostalAddress($postalAddress)
    {
        Assertion::notNull($postalAddress, 'postalAddress value "%s" is null, but non null value was expected.');
        Assertion::maxLength($postalAddress, 255, 'postalAddress value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->postalAddress = $postalAddress;

        return $this;
    }

    /**
     * Get postalAddress
     *
     * @return string
     */
    public function getPostalAddress()
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
    protected function setPostalCode($postalCode)
    {
        Assertion::notNull($postalCode, 'postalCode value "%s" is null, but non null value was expected.');
        Assertion::maxLength($postalCode, 10, 'postalCode value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode()
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
    protected function setTown($town)
    {
        Assertion::notNull($town, 'town value "%s" is null, but non null value was expected.');
        Assertion::maxLength($town, 255, 'town value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return string
     */
    public function getTown()
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
    protected function setProvince($province)
    {
        Assertion::notNull($province, 'province value "%s" is null, but non null value was expected.');
        Assertion::maxLength($province, 255, 'province value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return string
     */
    public function getProvince()
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
    protected function setCountryName($countryName)
    {
        Assertion::notNull($countryName, 'countryName value "%s" is null, but non null value was expected.');
        Assertion::maxLength($countryName, 255, 'countryName value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->countryName = $countryName;

        return $this;
    }

    /**
     * Get countryName
     *
     * @return string
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * Set ipfilter
     *
     * @param boolean $ipfilter | null
     *
     * @return static
     */
    protected function setIpfilter($ipfilter = null)
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
     * @return boolean | null
     */
    public function getIpfilter()
    {
        return $this->ipfilter;
    }

    /**
     * Set onDemandRecord
     *
     * @param integer $onDemandRecord | null
     *
     * @return static
     */
    protected function setOnDemandRecord($onDemandRecord = null)
    {
        if (!is_null($onDemandRecord)) {
            Assertion::integerish($onDemandRecord, 'onDemandRecord value "%s" is not an integer or a number castable to integer.');
            $onDemandRecord = (int) $onDemandRecord;
        }

        $this->onDemandRecord = $onDemandRecord;

        return $this;
    }

    /**
     * Get onDemandRecord
     *
     * @return integer | null
     */
    public function getOnDemandRecord()
    {
        return $this->onDemandRecord;
    }

    /**
     * Set allowRecordingRemoval
     *
     * @param boolean $allowRecordingRemoval
     *
     * @return static
     */
    protected function setAllowRecordingRemoval($allowRecordingRemoval)
    {
        Assertion::notNull($allowRecordingRemoval, 'allowRecordingRemoval value "%s" is null, but non null value was expected.');
        Assertion::between(intval($allowRecordingRemoval), 0, 1, 'allowRecordingRemoval provided "%s" is not a valid boolean value.');
        $allowRecordingRemoval = (bool) $allowRecordingRemoval;

        $this->allowRecordingRemoval = $allowRecordingRemoval;

        return $this;
    }

    /**
     * Get allowRecordingRemoval
     *
     * @return boolean
     */
    public function getAllowRecordingRemoval()
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
    protected function setOnDemandRecordCode($onDemandRecordCode = null)
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
    public function getOnDemandRecordCode()
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
    protected function setExternallyextraopts($externallyextraopts = null)
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
    public function getExternallyextraopts()
    {
        return $this->externallyextraopts;
    }

    /**
     * Set recordingsLimitMB
     *
     * @param integer $recordingsLimitMB | null
     *
     * @return static
     */
    protected function setRecordingsLimitMB($recordingsLimitMB = null)
    {
        if (!is_null($recordingsLimitMB)) {
            Assertion::integerish($recordingsLimitMB, 'recordingsLimitMB value "%s" is not an integer or a number castable to integer.');
            $recordingsLimitMB = (int) $recordingsLimitMB;
        }

        $this->recordingsLimitMB = $recordingsLimitMB;

        return $this;
    }

    /**
     * Get recordingsLimitMB
     *
     * @return integer | null
     */
    public function getRecordingsLimitMB()
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
    protected function setRecordingsLimitEmail($recordingsLimitEmail = null)
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
    public function getRecordingsLimitEmail()
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
    protected function setBillingMethod($billingMethod)
    {
        Assertion::notNull($billingMethod, 'billingMethod value "%s" is null, but non null value was expected.');
        Assertion::maxLength($billingMethod, 25, 'billingMethod value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($billingMethod, [
            CompanyInterface::BILLINGMETHOD_POSTPAID,
            CompanyInterface::BILLINGMETHOD_PREPAID,
            CompanyInterface::BILLINGMETHOD_PSEUDOPREPAID
        ], 'billingMethodvalue "%s" is not an element of the valid values: %s');

        $this->billingMethod = $billingMethod;

        return $this;
    }

    /**
     * Get billingMethod
     *
     * @return string
     */
    public function getBillingMethod()
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
    protected function setBalance($balance = null)
    {
        if (!is_null($balance)) {
            Assertion::numeric($balance);
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
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set showInvoices
     *
     * @param boolean $showInvoices | null
     *
     * @return static
     */
    protected function setShowInvoices($showInvoices = null)
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
     * @return boolean | null
     */
    public function getShowInvoices()
    {
        return $this->showInvoices;
    }

    /**
     * Set language
     *
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageInterface $language | null
     *
     * @return static
     */
    protected function setLanguage(\Ivoz\Provider\Domain\Model\Language\LanguageInterface $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageInterface | null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set mediaRelaySets
     *
     * @param \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface $mediaRelaySets | null
     *
     * @return static
     */
    protected function setMediaRelaySets(\Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface $mediaRelaySets = null)
    {
        $this->mediaRelaySets = $mediaRelaySets;

        return $this;
    }

    /**
     * Get mediaRelaySets
     *
     * @return \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface | null
     */
    public function getMediaRelaySets()
    {
        return $this->mediaRelaySets;
    }

    /**
     * Set defaultTimezone
     *
     * @param \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface $defaultTimezone | null
     *
     * @return static
     */
    protected function setDefaultTimezone(\Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface $defaultTimezone = null)
    {
        $this->defaultTimezone = $defaultTimezone;

        return $this;
    }

    /**
     * Get defaultTimezone
     *
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface | null
     */
    public function getDefaultTimezone()
    {
        return $this->defaultTimezone;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set domain
     *
     * @param \Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain | null
     *
     * @return static
     */
    protected function setDomain(\Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain = null)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return \Ivoz\Provider\Domain\Model\Domain\DomainInterface | null
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set applicationServer
     *
     * @param \Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface $applicationServer | null
     *
     * @return static
     */
    protected function setApplicationServer(\Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface $applicationServer = null)
    {
        $this->applicationServer = $applicationServer;

        return $this;
    }

    /**
     * Get applicationServer
     *
     * @return \Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface | null
     */
    public function getApplicationServer()
    {
        return $this->applicationServer;
    }

    /**
     * Set country
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $country | null
     *
     * @return static
     */
    protected function setCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set currency
     *
     * @param \Ivoz\Provider\Domain\Model\Currency\CurrencyInterface $currency | null
     *
     * @return static
     */
    protected function setCurrency(\Ivoz\Provider\Domain\Model\Currency\CurrencyInterface $currency = null)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return \Ivoz\Provider\Domain\Model\Currency\CurrencyInterface | null
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set transformationRuleSet
     *
     * @param \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet | null
     *
     * @return static
     */
    protected function setTransformationRuleSet(\Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet = null)
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    /**
     * Get transformationRuleSet
     *
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface | null
     */
    public function getTransformationRuleSet()
    {
        return $this->transformationRuleSet;
    }

    /**
     * Set outgoingDdi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi | null
     *
     * @return static
     */
    protected function setOutgoingDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi = null)
    {
        $this->outgoingDdi = $outgoingDdi;

        return $this;
    }

    /**
     * Get outgoingDdi
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    public function getOutgoingDdi()
    {
        return $this->outgoingDdi;
    }

    /**
     * Set outgoingDdiRule
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface $outgoingDdiRule | null
     *
     * @return static
     */
    protected function setOutgoingDdiRule(\Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface $outgoingDdiRule = null)
    {
        $this->outgoingDdiRule = $outgoingDdiRule;

        return $this;
    }

    /**
     * Get outgoingDdiRule
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface | null
     */
    public function getOutgoingDdiRule()
    {
        return $this->outgoingDdiRule;
    }

    /**
     * Set voicemailNotificationTemplate
     *
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $voicemailNotificationTemplate | null
     *
     * @return static
     */
    protected function setVoicemailNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $voicemailNotificationTemplate = null)
    {
        $this->voicemailNotificationTemplate = $voicemailNotificationTemplate;

        return $this;
    }

    /**
     * Get voicemailNotificationTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    public function getVoicemailNotificationTemplate()
    {
        return $this->voicemailNotificationTemplate;
    }

    /**
     * Set faxNotificationTemplate
     *
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $faxNotificationTemplate | null
     *
     * @return static
     */
    protected function setFaxNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $faxNotificationTemplate = null)
    {
        $this->faxNotificationTemplate = $faxNotificationTemplate;

        return $this;
    }

    /**
     * Get faxNotificationTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    public function getFaxNotificationTemplate()
    {
        return $this->faxNotificationTemplate;
    }

    /**
     * Set invoiceNotificationTemplate
     *
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $invoiceNotificationTemplate | null
     *
     * @return static
     */
    protected function setInvoiceNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $invoiceNotificationTemplate = null)
    {
        $this->invoiceNotificationTemplate = $invoiceNotificationTemplate;

        return $this;
    }

    /**
     * Get invoiceNotificationTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    public function getInvoiceNotificationTemplate()
    {
        return $this->invoiceNotificationTemplate;
    }

    /**
     * Set callCsvNotificationTemplate
     *
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $callCsvNotificationTemplate | null
     *
     * @return static
     */
    protected function setCallCsvNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $callCsvNotificationTemplate = null)
    {
        $this->callCsvNotificationTemplate = $callCsvNotificationTemplate;

        return $this;
    }

    /**
     * Get callCsvNotificationTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    public function getCallCsvNotificationTemplate()
    {
        return $this->callCsvNotificationTemplate;
    }

    // @codeCoverageIgnoreEnd
}
