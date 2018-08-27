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
     * @var string
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
    protected $maxCalls = '0';

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
     * @var boolean
     */
    protected $ipfilter = '1';

    /**
     * @var integer
     */
    protected $onDemandRecord = '0';

    /**
     * @var string
     */
    protected $onDemandRecordCode;

    /**
     * @var string
     */
    protected $externallyextraopts;

    /**
     * @var integer
     */
    protected $recordingsLimitMB;

    /**
     * @var string
     */
    protected $recordingsLimitEmail;

    /**
     * comment: enum:postpaid|prepaid|pseudoprepaid
     * @var string
     */
    protected $billingMethod = 'postpaid';

    /**
     * @var string
     */
    protected $balance = 0;

    /**
     * @var \Ivoz\Provider\Domain\Model\Language\LanguageInterface
     */
    protected $language;

    /**
     * @var \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface
     */
    protected $mediaRelaySets;

    /**
     * @var \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    protected $defaultTimezone;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Domain\DomainInterface
     */
    protected $domain;

    /**
     * @var \Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface
     */
    protected $applicationServer;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    protected $country;

    /**
     * @var \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface
     */
    protected $transformationRuleSet;

    /**
     * @var \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    protected $outgoingDdi;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface
     */
    protected $outgoingDdiRule;

    /**
     * @var \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface
     */
    protected $voicemailNotificationTemplate;

    /**
     * @var \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface
     */
    protected $faxNotificationTemplate;

    /**
     * @var \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface
     */
    protected $invoiceNotificationTemplate;


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
        $postalAddress,
        $postalCode,
        $town,
        $province,
        $countryName,
        $billingMethod
    ) {
        $this->setType($type);
        $this->setName($name);
        $this->setNif($nif);
        $this->setDistributeMethod($distributeMethod);
        $this->setMaxCalls($maxCalls);
        $this->setPostalAddress($postalAddress);
        $this->setPostalCode($postalCode);
        $this->setTown($town);
        $this->setProvince($province);
        $this->setCountryName($countryName);
        $this->setBillingMethod($billingMethod);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
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
     * @param EntityInterface|null $entity
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

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CompanyDto
         */
        Assertion::isInstanceOf($dto, CompanyDto::class);

        $self = new static(
            $dto->getType(),
            $dto->getName(),
            $dto->getNif(),
            $dto->getDistributeMethod(),
            $dto->getMaxCalls(),
            $dto->getPostalAddress(),
            $dto->getPostalCode(),
            $dto->getTown(),
            $dto->getProvince(),
            $dto->getCountryName(),
            $dto->getBillingMethod());

        $self
            ->setDomainUsers($dto->getDomainUsers())
            ->setIpfilter($dto->getIpfilter())
            ->setOnDemandRecord($dto->getOnDemandRecord())
            ->setOnDemandRecordCode($dto->getOnDemandRecordCode())
            ->setExternallyextraopts($dto->getExternallyextraopts())
            ->setRecordingsLimitMB($dto->getRecordingsLimitMB())
            ->setRecordingsLimitEmail($dto->getRecordingsLimitEmail())
            ->setBalance($dto->getBalance())
            ->setLanguage($dto->getLanguage())
            ->setMediaRelaySets($dto->getMediaRelaySets())
            ->setDefaultTimezone($dto->getDefaultTimezone())
            ->setBrand($dto->getBrand())
            ->setDomain($dto->getDomain())
            ->setApplicationServer($dto->getApplicationServer())
            ->setCountry($dto->getCountry())
            ->setTransformationRuleSet($dto->getTransformationRuleSet())
            ->setOutgoingDdi($dto->getOutgoingDdi())
            ->setOutgoingDdiRule($dto->getOutgoingDdiRule())
            ->setVoicemailNotificationTemplate($dto->getVoicemailNotificationTemplate())
            ->setFaxNotificationTemplate($dto->getFaxNotificationTemplate())
            ->setInvoiceNotificationTemplate($dto->getInvoiceNotificationTemplate())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CompanyDto
         */
        Assertion::isInstanceOf($dto, CompanyDto::class);

        $this
            ->setType($dto->getType())
            ->setName($dto->getName())
            ->setDomainUsers($dto->getDomainUsers())
            ->setNif($dto->getNif())
            ->setDistributeMethod($dto->getDistributeMethod())
            ->setMaxCalls($dto->getMaxCalls())
            ->setPostalAddress($dto->getPostalAddress())
            ->setPostalCode($dto->getPostalCode())
            ->setTown($dto->getTown())
            ->setProvince($dto->getProvince())
            ->setCountryName($dto->getCountryName())
            ->setIpfilter($dto->getIpfilter())
            ->setOnDemandRecord($dto->getOnDemandRecord())
            ->setOnDemandRecordCode($dto->getOnDemandRecordCode())
            ->setExternallyextraopts($dto->getExternallyextraopts())
            ->setRecordingsLimitMB($dto->getRecordingsLimitMB())
            ->setRecordingsLimitEmail($dto->getRecordingsLimitEmail())
            ->setBillingMethod($dto->getBillingMethod())
            ->setBalance($dto->getBalance())
            ->setLanguage($dto->getLanguage())
            ->setMediaRelaySets($dto->getMediaRelaySets())
            ->setDefaultTimezone($dto->getDefaultTimezone())
            ->setBrand($dto->getBrand())
            ->setDomain($dto->getDomain())
            ->setApplicationServer($dto->getApplicationServer())
            ->setCountry($dto->getCountry())
            ->setTransformationRuleSet($dto->getTransformationRuleSet())
            ->setOutgoingDdi($dto->getOutgoingDdi())
            ->setOutgoingDdiRule($dto->getOutgoingDdiRule())
            ->setVoicemailNotificationTemplate($dto->getVoicemailNotificationTemplate())
            ->setFaxNotificationTemplate($dto->getFaxNotificationTemplate())
            ->setInvoiceNotificationTemplate($dto->getInvoiceNotificationTemplate());



        $this->sanitizeValues();
        return $this;
    }

    /**
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
            ->setPostalAddress(self::getPostalAddress())
            ->setPostalCode(self::getPostalCode())
            ->setTown(self::getTown())
            ->setProvince(self::getProvince())
            ->setCountryName(self::getCountryName())
            ->setIpfilter(self::getIpfilter())
            ->setOnDemandRecord(self::getOnDemandRecord())
            ->setOnDemandRecordCode(self::getOnDemandRecordCode())
            ->setExternallyextraopts(self::getExternallyextraopts())
            ->setRecordingsLimitMB(self::getRecordingsLimitMB())
            ->setRecordingsLimitEmail(self::getRecordingsLimitEmail())
            ->setBillingMethod(self::getBillingMethod())
            ->setBalance(self::getBalance())
            ->setLanguage(\Ivoz\Provider\Domain\Model\Language\Language::entityToDto(self::getLanguage(), $depth))
            ->setMediaRelaySets(\Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySet::entityToDto(self::getMediaRelaySets(), $depth))
            ->setDefaultTimezone(\Ivoz\Provider\Domain\Model\Timezone\Timezone::entityToDto(self::getDefaultTimezone(), $depth))
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto(self::getBrand(), $depth))
            ->setDomain(\Ivoz\Provider\Domain\Model\Domain\Domain::entityToDto(self::getDomain(), $depth))
            ->setApplicationServer(\Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServer::entityToDto(self::getApplicationServer(), $depth))
            ->setCountry(\Ivoz\Provider\Domain\Model\Country\Country::entityToDto(self::getCountry(), $depth))
            ->setTransformationRuleSet(\Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSet::entityToDto(self::getTransformationRuleSet(), $depth))
            ->setOutgoingDdi(\Ivoz\Provider\Domain\Model\Ddi\Ddi::entityToDto(self::getOutgoingDdi(), $depth))
            ->setOutgoingDdiRule(\Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRule::entityToDto(self::getOutgoingDdiRule(), $depth))
            ->setVoicemailNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate::entityToDto(self::getVoicemailNotificationTemplate(), $depth))
            ->setFaxNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate::entityToDto(self::getFaxNotificationTemplate(), $depth))
            ->setInvoiceNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate::entityToDto(self::getInvoiceNotificationTemplate(), $depth));
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
            'postalAddress' => self::getPostalAddress(),
            'postalCode' => self::getPostalCode(),
            'town' => self::getTown(),
            'province' => self::getProvince(),
            'country' => self::getCountryName(),
            'ipFilter' => self::getIpfilter(),
            'onDemandRecord' => self::getOnDemandRecord(),
            'onDemandRecordCode' => self::getOnDemandRecordCode(),
            'externallyExtraOpts' => self::getExternallyextraopts(),
            'recordingsLimitMB' => self::getRecordingsLimitMB(),
            'recordingsLimitEmail' => self::getRecordingsLimitEmail(),
            'billingMethod' => self::getBillingMethod(),
            'balance' => self::getBalance(),
            'languageId' => self::getLanguage() ? self::getLanguage()->getId() : null,
            'mediaRelaySetsId' => self::getMediaRelaySets() ? self::getMediaRelaySets()->getId() : null,
            'defaultTimezoneId' => self::getDefaultTimezone() ? self::getDefaultTimezone()->getId() : null,
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'domainId' => self::getDomain() ? self::getDomain()->getId() : null,
            'applicationServerId' => self::getApplicationServer() ? self::getApplicationServer()->getId() : null,
            'countryId' => self::getCountry() ? self::getCountry()->getId() : null,
            'transformationRuleSetId' => self::getTransformationRuleSet() ? self::getTransformationRuleSet()->getId() : null,
            'outgoingDdiId' => self::getOutgoingDdi() ? self::getOutgoingDdi()->getId() : null,
            'outgoingDdiRuleId' => self::getOutgoingDdiRule() ? self::getOutgoingDdiRule()->getId() : null,
            'voicemailNotificationTemplateId' => self::getVoicemailNotificationTemplate() ? self::getVoicemailNotificationTemplate()->getId() : null,
            'faxNotificationTemplateId' => self::getFaxNotificationTemplate() ? self::getFaxNotificationTemplate()->getId() : null,
            'invoiceNotificationTemplateId' => self::getInvoiceNotificationTemplate() ? self::getInvoiceNotificationTemplate()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * @deprecated
     * Set type
     *
     * @param string $type
     *
     * @return self
     */
    public function setType($type)
    {
        Assertion::notNull($type, 'type value "%s" is null, but non null value was expected.');
        Assertion::maxLength($type, 25, 'type value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($type, array (
          0 => 'vpbx',
          1 => 'retail',
          2 => 'wholesale',
          3 => 'residential',
        ), 'typevalue "%s" is not an element of the valid values: %s');

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
     * @deprecated
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
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
     * @deprecated
     * Set domainUsers
     *
     * @param string $domainUsers
     *
     * @return self
     */
    public function setDomainUsers($domainUsers = null)
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
     * @return string
     */
    public function getDomainUsers()
    {
        return $this->domainUsers;
    }

    /**
     * @deprecated
     * Set nif
     *
     * @param string $nif
     *
     * @return self
     */
    public function setNif($nif)
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
     * @deprecated
     * Set distributeMethod
     *
     * @param string $distributeMethod
     *
     * @return self
     */
    public function setDistributeMethod($distributeMethod)
    {
        Assertion::notNull($distributeMethod, 'distributeMethod value "%s" is null, but non null value was expected.');
        Assertion::maxLength($distributeMethod, 25, 'distributeMethod value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($distributeMethod, array (
          0 => 'static',
          1 => 'rr',
          2 => 'hash',
        ), 'distributeMethodvalue "%s" is not an element of the valid values: %s');

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
     * @deprecated
     * Set maxCalls
     *
     * @param integer $maxCalls
     *
     * @return self
     */
    public function setMaxCalls($maxCalls)
    {
        Assertion::notNull($maxCalls, 'maxCalls value "%s" is null, but non null value was expected.');
        Assertion::integerish($maxCalls, 'maxCalls value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($maxCalls, 0, 'maxCalls provided "%s" is not greater or equal than "%s".');

        $this->maxCalls = $maxCalls;

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
     * @deprecated
     * Set postalAddress
     *
     * @param string $postalAddress
     *
     * @return self
     */
    public function setPostalAddress($postalAddress)
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
     * @deprecated
     * Set postalCode
     *
     * @param string $postalCode
     *
     * @return self
     */
    public function setPostalCode($postalCode)
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
     * @deprecated
     * Set town
     *
     * @param string $town
     *
     * @return self
     */
    public function setTown($town)
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
     * @deprecated
     * Set province
     *
     * @param string $province
     *
     * @return self
     */
    public function setProvince($province)
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
     * @deprecated
     * Set countryName
     *
     * @param string $countryName
     *
     * @return self
     */
    public function setCountryName($countryName)
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
     * @deprecated
     * Set ipfilter
     *
     * @param boolean $ipfilter
     *
     * @return self
     */
    public function setIpfilter($ipfilter = null)
    {
        if (!is_null($ipfilter)) {
            Assertion::between(intval($ipfilter), 0, 1, 'ipfilter provided "%s" is not a valid boolean value.');
        }

        $this->ipfilter = $ipfilter;

        return $this;
    }

    /**
     * Get ipfilter
     *
     * @return boolean
     */
    public function getIpfilter()
    {
        return $this->ipfilter;
    }

    /**
     * @deprecated
     * Set onDemandRecord
     *
     * @param integer $onDemandRecord
     *
     * @return self
     */
    public function setOnDemandRecord($onDemandRecord = null)
    {
        if (!is_null($onDemandRecord)) {
            if (!is_null($onDemandRecord)) {
                Assertion::integerish($onDemandRecord, 'onDemandRecord value "%s" is not an integer or a number castable to integer.');
            }
        }

        $this->onDemandRecord = $onDemandRecord;

        return $this;
    }

    /**
     * Get onDemandRecord
     *
     * @return integer
     */
    public function getOnDemandRecord()
    {
        return $this->onDemandRecord;
    }

    /**
     * @deprecated
     * Set onDemandRecordCode
     *
     * @param string $onDemandRecordCode
     *
     * @return self
     */
    public function setOnDemandRecordCode($onDemandRecordCode = null)
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
     * @return string
     */
    public function getOnDemandRecordCode()
    {
        return $this->onDemandRecordCode;
    }

    /**
     * @deprecated
     * Set externallyextraopts
     *
     * @param string $externallyextraopts
     *
     * @return self
     */
    public function setExternallyextraopts($externallyextraopts = null)
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
     * @return string
     */
    public function getExternallyextraopts()
    {
        return $this->externallyextraopts;
    }

    /**
     * @deprecated
     * Set recordingsLimitMB
     *
     * @param integer $recordingsLimitMB
     *
     * @return self
     */
    public function setRecordingsLimitMB($recordingsLimitMB = null)
    {
        if (!is_null($recordingsLimitMB)) {
            if (!is_null($recordingsLimitMB)) {
                Assertion::integerish($recordingsLimitMB, 'recordingsLimitMB value "%s" is not an integer or a number castable to integer.');
            }
        }

        $this->recordingsLimitMB = $recordingsLimitMB;

        return $this;
    }

    /**
     * Get recordingsLimitMB
     *
     * @return integer
     */
    public function getRecordingsLimitMB()
    {
        return $this->recordingsLimitMB;
    }

    /**
     * @deprecated
     * Set recordingsLimitEmail
     *
     * @param string $recordingsLimitEmail
     *
     * @return self
     */
    public function setRecordingsLimitEmail($recordingsLimitEmail = null)
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
     * @return string
     */
    public function getRecordingsLimitEmail()
    {
        return $this->recordingsLimitEmail;
    }

    /**
     * @deprecated
     * Set billingMethod
     *
     * @param string $billingMethod
     *
     * @return self
     */
    public function setBillingMethod($billingMethod)
    {
        Assertion::notNull($billingMethod, 'billingMethod value "%s" is null, but non null value was expected.');
        Assertion::maxLength($billingMethod, 25, 'billingMethod value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($billingMethod, array (
          0 => 'postpaid',
          1 => 'prepaid',
          2 => 'pseudoprepaid',
        ), 'billingMethodvalue "%s" is not an element of the valid values: %s');

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
     * @deprecated
     * Set balance
     *
     * @param string $balance
     *
     * @return self
     */
    public function setBalance($balance = null)
    {
        if (!is_null($balance)) {
            if (!is_null($balance)) {
                Assertion::numeric($balance);
                $balance = (float) $balance;
            }
        }

        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return string
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set language
     *
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageInterface $language
     *
     * @return self
     */
    public function setLanguage(\Ivoz\Provider\Domain\Model\Language\LanguageInterface $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageInterface
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set mediaRelaySets
     *
     * @param \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface $mediaRelaySets
     *
     * @return self
     */
    public function setMediaRelaySets(\Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface $mediaRelaySets = null)
    {
        $this->mediaRelaySets = $mediaRelaySets;

        return $this;
    }

    /**
     * Get mediaRelaySets
     *
     * @return \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface
     */
    public function getMediaRelaySets()
    {
        return $this->mediaRelaySets;
    }

    /**
     * Set defaultTimezone
     *
     * @param \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface $defaultTimezone
     *
     * @return self
     */
    public function setDefaultTimezone(\Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface $defaultTimezone = null)
    {
        $this->defaultTimezone = $defaultTimezone;

        return $this;
    }

    /**
     * Get defaultTimezone
     *
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
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
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null)
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
     * @param \Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain
     *
     * @return self
     */
    public function setDomain(\Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain = null)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return \Ivoz\Provider\Domain\Model\Domain\DomainInterface
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set applicationServer
     *
     * @param \Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface $applicationServer
     *
     * @return self
     */
    public function setApplicationServer(\Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface $applicationServer = null)
    {
        $this->applicationServer = $applicationServer;

        return $this;
    }

    /**
     * Get applicationServer
     *
     * @return \Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface
     */
    public function getApplicationServer()
    {
        return $this->applicationServer;
    }

    /**
     * Set country
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $country
     *
     * @return self
     */
    public function setCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set transformationRuleSet
     *
     * @param \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet
     *
     * @return self
     */
    public function setTransformationRuleSet(\Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet = null)
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    /**
     * Get transformationRuleSet
     *
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface
     */
    public function getTransformationRuleSet()
    {
        return $this->transformationRuleSet;
    }

    /**
     * Set outgoingDdi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi
     *
     * @return self
     */
    public function setOutgoingDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi = null)
    {
        $this->outgoingDdi = $outgoingDdi;

        return $this;
    }

    /**
     * Get outgoingDdi
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    public function getOutgoingDdi()
    {
        return $this->outgoingDdi;
    }

    /**
     * Set outgoingDdiRule
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface $outgoingDdiRule
     *
     * @return self
     */
    public function setOutgoingDdiRule(\Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface $outgoingDdiRule = null)
    {
        $this->outgoingDdiRule = $outgoingDdiRule;

        return $this;
    }

    /**
     * Get outgoingDdiRule
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface
     */
    public function getOutgoingDdiRule()
    {
        return $this->outgoingDdiRule;
    }

    /**
     * Set voicemailNotificationTemplate
     *
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $voicemailNotificationTemplate
     *
     * @return self
     */
    public function setVoicemailNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $voicemailNotificationTemplate = null)
    {
        $this->voicemailNotificationTemplate = $voicemailNotificationTemplate;

        return $this;
    }

    /**
     * Get voicemailNotificationTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface
     */
    public function getVoicemailNotificationTemplate()
    {
        return $this->voicemailNotificationTemplate;
    }

    /**
     * Set faxNotificationTemplate
     *
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $faxNotificationTemplate
     *
     * @return self
     */
    public function setFaxNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $faxNotificationTemplate = null)
    {
        $this->faxNotificationTemplate = $faxNotificationTemplate;

        return $this;
    }

    /**
     * Get faxNotificationTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface
     */
    public function getFaxNotificationTemplate()
    {
        return $this->faxNotificationTemplate;
    }

    /**
     * Set invoiceNotificationTemplate
     *
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $invoiceNotificationTemplate
     *
     * @return self
     */
    public function setInvoiceNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $invoiceNotificationTemplate = null)
    {
        $this->invoiceNotificationTemplate = $invoiceNotificationTemplate;

        return $this;
    }

    /**
     * Get invoiceNotificationTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface
     */
    public function getInvoiceNotificationTemplate()
    {
        return $this->invoiceNotificationTemplate;
    }



    // @codeCoverageIgnoreEnd
}

