<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Brand;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\Logo;
use Ivoz\Provider\Domain\Model\Brand\Invoice;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Model\Currency\CurrencyInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\Language\Language;
use Ivoz\Provider\Domain\Model\Timezone\Timezone;
use Ivoz\Provider\Domain\Model\Currency\Currency;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate;

/**
* BrandAbstract
* @codeCoverageIgnore
*/
abstract class BrandAbstract
{
    use ChangelogTrait;

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
     * @var ?int
     */
    protected $recordingsLimitMB = null;

    /**
     * @var ?string
     */
    protected $recordingsLimitEmail = null;

    /**
     * @var int
     */
    protected $maxCalls = 0;

    /**
     * @var Logo
     */
    protected $logo;

    /**
     * @var Invoice
     */
    protected $invoice;

    /**
     * @var ?DomainInterface
     */
    protected $domain = null;

    /**
     * @var LanguageInterface
     */
    protected $language;

    /**
     * @var TimezoneInterface
     */
    protected $defaultTimezone;

    /**
     * @var ?CurrencyInterface
     */
    protected $currency = null;

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
        string $name,
        int $maxCalls,
        Logo $logo,
        Invoice $invoice
    ) {
        $this->setName($name);
        $this->setMaxCalls($maxCalls);
        $this->logo = $logo;
        $this->invoice = $invoice;
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Brand",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): BrandDto
    {
        return new BrandDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|BrandInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?BrandDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param BrandDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, BrandDto::class);
        Assertion::notNull($dto->getInvoiceNif(), 'invoiceNif value is null, but non null value was expected.');
        Assertion::notNull($dto->getInvoicePostalAddress(), 'invoicePostalAddress value is null, but non null value was expected.');
        Assertion::notNull($dto->getInvoicePostalCode(), 'invoicePostalCode value is null, but non null value was expected.');
        Assertion::notNull($dto->getInvoiceTown(), 'invoiceTown value is null, but non null value was expected.');
        Assertion::notNull($dto->getInvoiceProvince(), 'invoiceProvince value is null, but non null value was expected.');
        Assertion::notNull($dto->getInvoiceCountry(), 'invoiceCountry value is null, but non null value was expected.');
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $maxCalls = $dto->getMaxCalls();
        Assertion::notNull($maxCalls, 'getMaxCalls value is null, but non null value was expected.');
        $language = $dto->getLanguage();
        Assertion::notNull($language, 'getLanguage value is null, but non null value was expected.');
        $defaultTimezone = $dto->getDefaultTimezone();
        Assertion::notNull($defaultTimezone, 'getDefaultTimezone value is null, but non null value was expected.');

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
            $name,
            $maxCalls,
            $logo,
            $invoice
        );

        $self
            ->setDomainUsers($dto->getDomainUsers())
            ->setRecordingsLimitMB($dto->getRecordingsLimitMB())
            ->setRecordingsLimitEmail($dto->getRecordingsLimitEmail())
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setLanguage($fkTransformer->transform($language))
            ->setDefaultTimezone($fkTransformer->transform($defaultTimezone))
            ->setCurrency($fkTransformer->transform($dto->getCurrency()))
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
     * @param BrandDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, BrandDto::class);

        Assertion::notNull($dto->getInvoiceNif(), 'invoiceNif value is null, but non null value was expected.');
        Assertion::notNull($dto->getInvoicePostalAddress(), 'invoicePostalAddress value is null, but non null value was expected.');
        Assertion::notNull($dto->getInvoicePostalCode(), 'invoicePostalCode value is null, but non null value was expected.');
        Assertion::notNull($dto->getInvoiceTown(), 'invoiceTown value is null, but non null value was expected.');
        Assertion::notNull($dto->getInvoiceProvince(), 'invoiceProvince value is null, but non null value was expected.');
        Assertion::notNull($dto->getInvoiceCountry(), 'invoiceCountry value is null, but non null value was expected.');
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $maxCalls = $dto->getMaxCalls();
        Assertion::notNull($maxCalls, 'getMaxCalls value is null, but non null value was expected.');
        $language = $dto->getLanguage();
        Assertion::notNull($language, 'getLanguage value is null, but non null value was expected.');
        $defaultTimezone = $dto->getDefaultTimezone();
        Assertion::notNull($defaultTimezone, 'getDefaultTimezone value is null, but non null value was expected.');

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
            ->setName($name)
            ->setDomainUsers($dto->getDomainUsers())
            ->setRecordingsLimitMB($dto->getRecordingsLimitMB())
            ->setRecordingsLimitEmail($dto->getRecordingsLimitEmail())
            ->setMaxCalls($maxCalls)
            ->setLogo($logo)
            ->setInvoice($invoice)
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setLanguage($fkTransformer->transform($language))
            ->setDefaultTimezone($fkTransformer->transform($defaultTimezone))
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
     */
    public function toDto(int $depth = 0): BrandDto
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
            ->setDomain(Domain::entityToDto(self::getDomain(), $depth))
            ->setLanguage(Language::entityToDto(self::getLanguage(), $depth))
            ->setDefaultTimezone(Timezone::entityToDto(self::getDefaultTimezone(), $depth))
            ->setCurrency(Currency::entityToDto(self::getCurrency(), $depth))
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
            'domainId' => self::getDomain()?->getId(),
            'languageId' => self::getLanguage()->getId(),
            'defaultTimezoneId' => self::getDefaultTimezone()->getId(),
            'currencyId' => self::getCurrency()?->getId(),
            'voicemailNotificationTemplateId' => self::getVoicemailNotificationTemplate()?->getId(),
            'faxNotificationTemplateId' => self::getFaxNotificationTemplate()?->getId(),
            'invoiceNotificationTemplateId' => self::getInvoiceNotificationTemplate()?->getId(),
            'callCsvNotificationTemplateId' => self::getCallCsvNotificationTemplate()?->getId(),
            'maxDailyUsageNotificationTemplateId' => self::getMaxDailyUsageNotificationTemplate()?->getId()
        ];
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 75, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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

    public function getLogo(): Logo
    {
        return $this->logo;
    }

    protected function setLogo(Logo $logo): static
    {
        $isEqual = $this->logo->equals($logo);
        if ($isEqual) {
            return $this;
        }

        $this->logo = $logo;
        return $this;
    }

    public function getInvoice(): Invoice
    {
        return $this->invoice;
    }

    protected function setInvoice(Invoice $invoice): static
    {
        $isEqual = $this->invoice->equals($invoice);
        if ($isEqual) {
            return $this;
        }

        $this->invoice = $invoice;
        return $this;
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

    protected function setLanguage(LanguageInterface $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getLanguage(): LanguageInterface
    {
        return $this->language;
    }

    protected function setDefaultTimezone(TimezoneInterface $defaultTimezone): static
    {
        $this->defaultTimezone = $defaultTimezone;

        return $this;
    }

    public function getDefaultTimezone(): TimezoneInterface
    {
        return $this->defaultTimezone;
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
