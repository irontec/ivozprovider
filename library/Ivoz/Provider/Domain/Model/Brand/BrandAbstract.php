<?php

namespace Ivoz\Provider\Domain\Model\Brand;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

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
     * @column domain_users
     * @var string
     */
    protected $domainUsers;

    /**
     * @var string
     */
    protected $fromName;

    /**
     * @var string
     */
    protected $fromAddress;

    /**
     * @var integer
     */
    protected $recordingsLimitMB;

    /**
     * @var string
     */
    protected $recordingslimitemail;

    /**
     * @var Logo
     */
    protected $logo;

    /**
     * @var Invoice
     */
    protected $invoice;

    /**
     * @var \Ivoz\Provider\Domain\Model\Language\LanguageInterface
     */
    protected $language;

    /**
     * @var \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    protected $defaultTimezone;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($name, Logo $logo, Invoice $invoice)
    {
        $this->setName($name);
        $this->setLogo($logo);
        $this->setInvoice($invoice);

        $this->initChangelog();
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $values = $this->__toArray();
        if (!$this->getId()) {
            // Empty values for entities with no Id
            foreach ($values as $key => $val) {
                $values[$key] = null;
            }
        }

        $this->_initialValues = $values;
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function hasChanged($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$fieldName] != $this->_initialValues[$fieldName];
    }

    public function getInitialValue($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }

        return $this->_initialValues[$fieldName];
    }

    /**
     * @return BrandDTO
     */
    public static function createDTO()
    {
        return new BrandDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto BrandDTO
         */
        Assertion::isInstanceOf($dto, BrandDTO::class);

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
            $logo,
            $invoice
        );

        return $self
            ->setDomainUsers($dto->getDomainUsers())
            ->setFromName($dto->getFromName())
            ->setFromAddress($dto->getFromAddress())
            ->setRecordingsLimitMB($dto->getRecordingsLimitMB())
            ->setRecordingslimitemail($dto->getRecordingslimitemail())
            ->setLanguage($dto->getLanguage())
            ->setDefaultTimezone($dto->getDefaultTimezone())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto BrandDTO
         */
        Assertion::isInstanceOf($dto, BrandDTO::class);

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
            ->setFromName($dto->getFromName())
            ->setFromAddress($dto->getFromAddress())
            ->setRecordingsLimitMB($dto->getRecordingsLimitMB())
            ->setRecordingslimitemail($dto->getRecordingslimitemail())
            ->setLogo($logo)
            ->setInvoice($invoice)
            ->setLanguage($dto->getLanguage())
            ->setDefaultTimezone($dto->getDefaultTimezone());


        return $this;
    }

    /**
     * @return BrandDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setName($this->getName())
            ->setDomainUsers($this->getDomainUsers())
            ->setFromName($this->getFromName())
            ->setFromAddress($this->getFromAddress())
            ->setRecordingsLimitMB($this->getRecordingsLimitMB())
            ->setRecordingslimitemail($this->getRecordingslimitemail())
            ->setLogoFileSize($this->getLogo()->getFileSize())
            ->setLogoMimeType($this->getLogo()->getMimeType())
            ->setLogoBaseName($this->getLogo()->getBaseName())
            ->setInvoiceNif($this->getInvoice()->getNif())
            ->setInvoicePostalAddress($this->getInvoice()->getPostalAddress())
            ->setInvoicePostalCode($this->getInvoice()->getPostalCode())
            ->setInvoiceTown($this->getInvoice()->getTown())
            ->setInvoiceProvince($this->getInvoice()->getProvince())
            ->setInvoiceCountry($this->getInvoice()->getCountry())
            ->setInvoiceRegistryData($this->getInvoice()->getRegistryData())
            ->setLanguageId($this->getLanguage() ? $this->getLanguage()->getId() : null)
            ->setDefaultTimezoneId($this->getDefaultTimezone() ? $this->getDefaultTimezone()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'domainUsers' => self::getDomainUsers(),
            'fromName' => self::getFromName(),
            'fromAddress' => self::getFromAddress(),
            'recordingsLimitMB' => self::getRecordingsLimitMB(),
            'recordingslimitemail' => self::getRecordingslimitemail(),
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
            'languageId' => self::getLanguage() ? self::getLanguage()->getId() : null,
            'defaultTimezoneId' => self::getDefaultTimezone() ? self::getDefaultTimezone()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        Assertion::notNull($name);
        Assertion::maxLength($name, 75);

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
     * @param string $domainUsers
     *
     * @return self
     */
    public function setDomainUsers($domainUsers = null)
    {
        if (!is_null($domainUsers)) {
            Assertion::maxLength($domainUsers, 190);
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
     * Set fromName
     *
     * @param string $fromName
     *
     * @return self
     */
    public function setFromName($fromName = null)
    {
        if (!is_null($fromName)) {
            Assertion::maxLength($fromName, 255);
        }

        $this->fromName = $fromName;

        return $this;
    }

    /**
     * Get fromName
     *
     * @return string
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * Set fromAddress
     *
     * @param string $fromAddress
     *
     * @return self
     */
    public function setFromAddress($fromAddress = null)
    {
        if (!is_null($fromAddress)) {
            Assertion::maxLength($fromAddress, 255);
        }

        $this->fromAddress = $fromAddress;

        return $this;
    }

    /**
     * Get fromAddress
     *
     * @return string
     */
    public function getFromAddress()
    {
        return $this->fromAddress;
    }

    /**
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
                Assertion::integerish($recordingsLimitMB);
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
     * Set recordingslimitemail
     *
     * @param string $recordingslimitemail
     *
     * @return self
     */
    public function setRecordingslimitemail($recordingslimitemail = null)
    {
        if (!is_null($recordingslimitemail)) {
            Assertion::maxLength($recordingslimitemail, 250);
        }

        $this->recordingslimitemail = $recordingslimitemail;

        return $this;
    }

    /**
     * Get recordingslimitemail
     *
     * @return string
     */
    public function getRecordingslimitemail()
    {
        return $this->recordingslimitemail;
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
     * Set logo
     *
     * @param Logo $logo
     *
     * @return self
     */
    public function setLogo(Logo $logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return Logo
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set invoice
     *
     * @param Invoice $invoice
     *
     * @return self
     */
    public function setInvoice(Invoice $invoice)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get invoice
     *
     * @return Invoice
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    // @codeCoverageIgnoreEnd
}

