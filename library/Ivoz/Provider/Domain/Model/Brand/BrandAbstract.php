<?php

namespace Ivoz\Provider\Domain\Model\Brand;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * BrandAbstract
 * @codeCoverageIgnore
 */
abstract class BrandAbstract
{
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
     * @var integer | null
     */
    protected $recordingsLimitMB;

    /**
     * @var string | null
     */
    protected $recordingsLimitEmail;

    /**
     * @var integer
     */
    protected $maxCalls = 0;

    /**
     * @var Logo | null
     */
    protected $logo;

    /**
     * @var Invoice | null
     */
    protected $invoice;

    /**
     * @var \Ivoz\Provider\Domain\Model\Domain\DomainInterface | null
     */
    protected $domain;

    /**
     * @var \Ivoz\Provider\Domain\Model\Language\LanguageInterface | null
     */
    protected $language;

    /**
     * @var \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    protected $defaultTimezone;

    /**
     * @var \Ivoz\Provider\Domain\Model\Currency\CurrencyInterface | null
     */
    protected $currency;

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

    /**
     * @var \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    protected $maxDailyUsageNotificationTemplate;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
        $name,
        $maxCalls,
        Logo $logo,
        Invoice $invoice
    ) {
        $this->setName($name);
        $this->setMaxCalls($maxCalls);
        $this->setLogo($logo);
        $this->setInvoice($invoice);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Brand",
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
     * @return BrandDto
     */
    public static function createDto($id = null)
    {
        return new BrandDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param BrandInterface|null $entity
     * @param int $depth
     * @return BrandDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, BrandInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var BrandDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param BrandDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, BrandDto::class);

        $logo = new Logo(
            $dto->getLogoFileSize(),
            $dto->getLogoMimeType(),
            $dto->getLogoBaseName()
        );

        $invoice = new Invoice(
            $dto->getInvoiceNif(),
            $dto->getInvoicePostalAddress(),
            $dto->getInvoicePostalCode(),
            $dto->getInvoiceTown(),
            $dto->getInvoiceProvince(),
            $dto->getInvoiceCountry(),
            $dto->getInvoiceRegistryData()
        );

        $self = new static(
            $dto->getName(),
            $dto->getMaxCalls(),
            $logo,
            $invoice
        );

        $self
            ->setDomainUsers($dto->getDomainUsers())
            ->setRecordingsLimitMB($dto->getRecordingsLimitMB())
            ->setRecordingsLimitEmail($dto->getRecordingsLimitEmail())
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setLanguage($fkTransformer->transform($dto->getLanguage()))
            ->setDefaultTimezone($fkTransformer->transform($dto->getDefaultTimezone()))
            ->setCurrency($fkTransformer->transform($dto->getCurrency()))
            ->setVoicemailNotificationTemplate($fkTransformer->transform($dto->getVoicemailNotificationTemplate()))
            ->setFaxNotificationTemplate($fkTransformer->transform($dto->getFaxNotificationTemplate()))
            ->setInvoiceNotificationTemplate($fkTransformer->transform($dto->getInvoiceNotificationTemplate()))
            ->setCallCsvNotificationTemplate($fkTransformer->transform($dto->getCallCsvNotificationTemplate()))
            ->setMaxDailyUsageNotificationTemplate($fkTransformer->transform($dto->getMaxDailyUsageNotificationTemplate()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param BrandDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, BrandDto::class);

        $logo = new Logo(
            $dto->getLogoFileSize(),
            $dto->getLogoMimeType(),
            $dto->getLogoBaseName()
        );

        $invoice = new Invoice(
            $dto->getInvoiceNif(),
            $dto->getInvoicePostalAddress(),
            $dto->getInvoicePostalCode(),
            $dto->getInvoiceTown(),
            $dto->getInvoiceProvince(),
            $dto->getInvoiceCountry(),
            $dto->getInvoiceRegistryData()
        );

        $this
            ->setName($dto->getName())
            ->setDomainUsers($dto->getDomainUsers())
            ->setRecordingsLimitMB($dto->getRecordingsLimitMB())
            ->setRecordingsLimitEmail($dto->getRecordingsLimitEmail())
            ->setMaxCalls($dto->getMaxCalls())
            ->setLogo($logo)
            ->setInvoice($invoice)
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setLanguage($fkTransformer->transform($dto->getLanguage()))
            ->setDefaultTimezone($fkTransformer->transform($dto->getDefaultTimezone()))
            ->setCurrency($fkTransformer->transform($dto->getCurrency()))
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
     * @return BrandDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setDomainUsers(self::getDomainUsers())
            ->setRecordingsLimitMB(self::getRecordingsLimitMB())
            ->setRecordingsLimitEmail(self::getRecordingsLimitEmail())
            ->setMaxCalls(self::getMaxCalls())
            ->setLogoFileSize(self::getLogo()->getFileSize())
            ->setLogoMimeType(self::getLogo()->getMimeType())
            ->setLogoBaseName(self::getLogo()->getBaseName())
            ->setInvoiceNif(self::getInvoice()->getNif())
            ->setInvoicePostalAddress(self::getInvoice()->getPostalAddress())
            ->setInvoicePostalCode(self::getInvoice()->getPostalCode())
            ->setInvoiceTown(self::getInvoice()->getTown())
            ->setInvoiceProvince(self::getInvoice()->getProvince())
            ->setInvoiceCountry(self::getInvoice()->getCountry())
            ->setInvoiceRegistryData(self::getInvoice()->getRegistryData())
            ->setDomain(\Ivoz\Provider\Domain\Model\Domain\Domain::entityToDto(self::getDomain(), $depth))
            ->setLanguage(\Ivoz\Provider\Domain\Model\Language\Language::entityToDto(self::getLanguage(), $depth))
            ->setDefaultTimezone(\Ivoz\Provider\Domain\Model\Timezone\Timezone::entityToDto(self::getDefaultTimezone(), $depth))
            ->setCurrency(\Ivoz\Provider\Domain\Model\Currency\Currency::entityToDto(self::getCurrency(), $depth))
            ->setVoicemailNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate::entityToDto(self::getVoicemailNotificationTemplate(), $depth))
            ->setFaxNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate::entityToDto(self::getFaxNotificationTemplate(), $depth))
            ->setInvoiceNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate::entityToDto(self::getInvoiceNotificationTemplate(), $depth))
            ->setCallCsvNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate::entityToDto(self::getCallCsvNotificationTemplate(), $depth))
            ->setMaxDailyUsageNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate::entityToDto(self::getMaxDailyUsageNotificationTemplate(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'domain_users' => self::getDomainUsers(),
            'recordingsLimitMB' => self::getRecordingsLimitMB(),
            'recordingsLimitEmail' => self::getRecordingsLimitEmail(),
            'maxCalls' => self::getMaxCalls(),
            'logoFileSize' => self::getLogo()->getFileSize(),
            'logoMimeType' => self::getLogo()->getMimeType(),
            'logoBaseName' => self::getLogo()->getBaseName(),
            'invoiceNif' => self::getInvoice()->getNif(),
            'invoicePostalAddress' => self::getInvoice()->getPostalAddress(),
            'invoicePostalCode' => self::getInvoice()->getPostalCode(),
            'invoiceTown' => self::getInvoice()->getTown(),
            'invoiceProvince' => self::getInvoice()->getProvince(),
            'invoiceCountry' => self::getInvoice()->getCountry(),
            'invoiceRegistryData' => self::getInvoice()->getRegistryData(),
            'domainId' => self::getDomain() ? self::getDomain()->getId() : null,
            'languageId' => self::getLanguage() ? self::getLanguage()->getId() : null,
            'defaultTimezoneId' => self::getDefaultTimezone()->getId(),
            'currencyId' => self::getCurrency() ? self::getCurrency()->getId() : null,
            'voicemailNotificationTemplateId' => self::getVoicemailNotificationTemplate() ? self::getVoicemailNotificationTemplate()->getId() : null,
            'faxNotificationTemplateId' => self::getFaxNotificationTemplate() ? self::getFaxNotificationTemplate()->getId() : null,
            'invoiceNotificationTemplateId' => self::getInvoiceNotificationTemplate() ? self::getInvoiceNotificationTemplate()->getId() : null,
            'callCsvNotificationTemplateId' => self::getCallCsvNotificationTemplate() ? self::getCallCsvNotificationTemplate()->getId() : null,
            'maxDailyUsageNotificationTemplateId' => self::getMaxDailyUsageNotificationTemplate() ? self::getMaxDailyUsageNotificationTemplate()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

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
        Assertion::maxLength($name, 75, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    public function getMaxCalls(): int
    {
        return $this->maxCalls;
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
     * Set defaultTimezone
     *
     * @param \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface $defaultTimezone
     *
     * @return static
     */
    protected function setDefaultTimezone(\Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface $defaultTimezone)
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

    /**
     * Set maxDailyUsageNotificationTemplate
     *
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $maxDailyUsageNotificationTemplate | null
     *
     * @return static
     */
    protected function setMaxDailyUsageNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $maxDailyUsageNotificationTemplate = null)
    {
        $this->maxDailyUsageNotificationTemplate = $maxDailyUsageNotificationTemplate;

        return $this;
    }

    /**
     * Get maxDailyUsageNotificationTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    public function getMaxDailyUsageNotificationTemplate()
    {
        return $this->maxDailyUsageNotificationTemplate;
    }

    /**
     * Set logo
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\Logo $logo
     *
     * @return static
     */
    protected function setLogo(Logo $logo)
    {
        $isEqual = $this->logo && $this->logo->equals($logo);
        if ($isEqual) {
            return $this;
        }

        $this->logo = $logo;
        return $this;
    }

    /**
     * Get logo
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\Logo
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set invoice
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\Invoice $invoice
     *
     * @return static
     */
    protected function setInvoice(Invoice $invoice)
    {
        $isEqual = $this->invoice && $this->invoice->equals($invoice);
        if ($isEqual) {
            return $this;
        }

        $this->invoice = $invoice;
        return $this;
    }

    /**
     * Get invoice
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\Invoice
     */
    public function getInvoice()
    {
        return $this->invoice;
    }
    // @codeCoverageIgnoreEnd
}
