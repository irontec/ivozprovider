<?php

namespace Ivoz\Provider\Domain\Model\Brand;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class BrandDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $domainUsers;

    /**
     * @var string
     */
    private $fromName;

    /**
     * @var string
     */
    private $fromAddress;

    /**
     * @var integer
     */
    private $recordingsLimitMB;

    /**
     * @var string
     */
    private $recordingsLimitEmail;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $logoFileSize;

    /**
     * @var string
     */
    private $logoMimeType;

    /**
     * @var string
     */
    private $logoBaseName;

    /**
     * @var string
     */
    private $invoiceNif;

    /**
     * @var string
     */
    private $invoicePostalAddress;

    /**
     * @var string
     */
    private $invoicePostalCode;

    /**
     * @var string
     */
    private $invoiceTown;

    /**
     * @var string
     */
    private $invoiceProvince;

    /**
     * @var string
     */
    private $invoiceCountry;

    /**
     * @var string
     */
    private $invoiceRegistryData;

    /**
     * @var \Ivoz\Provider\Domain\Model\Domain\DomainDto | null
     */
    private $domain;

    /**
     * @var \Ivoz\Provider\Domain\Model\Language\LanguageDto | null
     */
    private $language;

    /**
     * @var \Ivoz\Provider\Domain\Model\Timezone\TimezoneDto | null
     */
    private $defaultTimezone;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto[] | null
     */
    private $companies = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\BrandService\BrandServiceDto[] | null
     */
    private $services = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\BrandUrl\BrandUrlDto[] | null
     */
    private $urls = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandDto[] | null
     */
    private $relFeatures = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\Domain\DomainDto[] | null
     */
    private $domains = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto[] | null
     */
    private $retailAccounts = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldDto[] | null
     */
    private $musicsOnHold = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\MatchList\MatchListDto[] | null
     */
    private $matchLists = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto[] | null
     */
    private $outgoingRoutings = null;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'name' => 'name',
            'domainUsers' => 'domainUsers',
            'fromName' => 'fromName',
            'fromAddress' => 'fromAddress',
            'recordingsLimitMB' => 'recordingsLimitMB',
            'recordingsLimitEmail' => 'recordingsLimitEmail',
            'id' => 'id',
            'logo' => ['fileSize','mimeType','baseName'],
            'invoice' => ['nif','postalAddress','postalCode','town','province','country','registryData'],
            'domainId' => 'domain',
            'languageId' => 'language',
            'defaultTimezoneId' => 'defaultTimezone'
        ];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'domainUsers' => $this->getDomainUsers(),
            'fromName' => $this->getFromName(),
            'fromAddress' => $this->getFromAddress(),
            'recordingsLimitMB' => $this->getRecordingsLimitMB(),
            'recordingsLimitEmail' => $this->getRecordingsLimitEmail(),
            'id' => $this->getId(),
            'logo' => [
                'fileSize' => $this->getLogoFileSize(),
                'mimeType' => $this->getLogoMimeType(),
                'baseName' => $this->getLogoBaseName()
            ],
            'invoice' => [
                'nif' => $this->getInvoiceNif(),
                'postalAddress' => $this->getInvoicePostalAddress(),
                'postalCode' => $this->getInvoicePostalCode(),
                'town' => $this->getInvoiceTown(),
                'province' => $this->getInvoiceProvince(),
                'country' => $this->getInvoiceCountry(),
                'registryData' => $this->getInvoiceRegistryData()
            ],
            'domain' => $this->getDomain(),
            'language' => $this->getLanguage(),
            'defaultTimezone' => $this->getDefaultTimezone(),
            'companies' => $this->getCompanies(),
            'services' => $this->getServices(),
            'urls' => $this->getUrls(),
            'relFeatures' => $this->getRelFeatures(),
            'domains' => $this->getDomains(),
            'retailAccounts' => $this->getRetailAccounts(),
            'musicsOnHold' => $this->getMusicsOnHold(),
            'matchLists' => $this->getMatchLists(),
            'outgoingRoutings' => $this->getOutgoingRoutings()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->domain = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Domain\\Domain', $this->getDomainId());
        $this->language = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Language\\Language', $this->getLanguageId());
        $this->defaultTimezone = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Timezone\\Timezone', $this->getDefaultTimezoneId());
        if (!is_null($this->companies)) {
            $items = $this->getCompanies();
            $this->companies = [];
            foreach ($items as $item) {
                $this->companies[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\Company\\Company',
                    $item->getId() ?? $item
                );
            }
        }

        if (!is_null($this->services)) {
            $items = $this->getServices();
            $this->services = [];
            foreach ($items as $item) {
                $this->services[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\BrandService\\BrandService',
                    $item->getId() ?? $item
                );
            }
        }

        if (!is_null($this->urls)) {
            $items = $this->getUrls();
            $this->urls = [];
            foreach ($items as $item) {
                $this->urls[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\BrandUrl\\BrandUrl',
                    $item->getId() ?? $item
                );
            }
        }

        if (!is_null($this->relFeatures)) {
            $items = $this->getRelFeatures();
            $this->relFeatures = [];
            foreach ($items as $item) {
                $this->relFeatures[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\FeaturesRelBrand\\FeaturesRelBrand',
                    $item->getId() ?? $item
                );
            }
        }

        if (!is_null($this->domains)) {
            $items = $this->getDomains();
            $this->domains = [];
            foreach ($items as $item) {
                $this->domains[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\Domain\\Domain',
                    $item->getId() ?? $item
                );
            }
        }

        if (!is_null($this->retailAccounts)) {
            $items = $this->getRetailAccounts();
            $this->retailAccounts = [];
            foreach ($items as $item) {
                $this->retailAccounts[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\RetailAccount\\RetailAccount',
                    $item->getId() ?? $item
                );
            }
        }

        if (!is_null($this->musicsOnHold)) {
            $items = $this->getMusicsOnHold();
            $this->musicsOnHold = [];
            foreach ($items as $item) {
                $this->musicsOnHold[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\MusicOnHold\\MusicOnHold',
                    $item->getId() ?? $item
                );
            }
        }

        if (!is_null($this->matchLists)) {
            $items = $this->getMatchLists();
            $this->matchLists = [];
            foreach ($items as $item) {
                $this->matchLists[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\MatchList\\MatchList',
                    $item->getId() ?? $item
                );
            }
        }

        if (!is_null($this->outgoingRoutings)) {
            $items = $this->getOutgoingRoutings();
            $this->outgoingRoutings = [];
            foreach ($items as $item) {
                $this->outgoingRoutings[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\OutgoingRouting\\OutgoingRouting',
                    $item->getId() ?? $item
                );
            }
        }

    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {
        $this->companies = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\Company\\Company',
            $this->companies
        );
        $this->services = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\BrandService\\BrandService',
            $this->services
        );
        $this->urls = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\BrandUrl\\BrandUrl',
            $this->urls
        );
        $this->relFeatures = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\FeaturesRelBrand\\FeaturesRelBrand',
            $this->relFeatures
        );
        $this->domains = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\Domain\\Domain',
            $this->domains
        );
        $this->retailAccounts = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\RetailAccount\\RetailAccount',
            $this->retailAccounts
        );
        $this->musicsOnHold = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\MusicOnHold\\MusicOnHold',
            $this->musicsOnHold
        );
        $this->matchLists = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\MatchList\\MatchList',
            $this->matchLists
        );
        $this->outgoingRoutings = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\OutgoingRouting\\OutgoingRouting',
            $this->outgoingRoutings
        );
    }

    /**
     * @param string $name
     *
     * @return static
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $domainUsers
     *
     * @return static
     */
    public function setDomainUsers($domainUsers = null)
    {
        $this->domainUsers = $domainUsers;

        return $this;
    }

    /**
     * @return string
     */
    public function getDomainUsers()
    {
        return $this->domainUsers;
    }

    /**
     * @param string $fromName
     *
     * @return static
     */
    public function setFromName($fromName = null)
    {
        $this->fromName = $fromName;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * @param string $fromAddress
     *
     * @return static
     */
    public function setFromAddress($fromAddress = null)
    {
        $this->fromAddress = $fromAddress;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromAddress()
    {
        return $this->fromAddress;
    }

    /**
     * @param integer $recordingsLimitMB
     *
     * @return static
     */
    public function setRecordingsLimitMB($recordingsLimitMB = null)
    {
        $this->recordingsLimitMB = $recordingsLimitMB;

        return $this;
    }

    /**
     * @return integer
     */
    public function getRecordingsLimitMB()
    {
        return $this->recordingsLimitMB;
    }

    /**
     * @param string $recordingsLimitEmail
     *
     * @return static
     */
    public function setRecordingsLimitEmail($recordingsLimitEmail = null)
    {
        $this->recordingsLimitEmail = $recordingsLimitEmail;

        return $this;
    }

    /**
     * @return string
     */
    public function getRecordingsLimitEmail()
    {
        return $this->recordingsLimitEmail;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $logoFileSize
     *
     * @return static
     */
    public function setLogoFileSize($logoFileSize = null)
    {
        $this->logoFileSize = $logoFileSize;

        return $this;
    }

    /**
     * @return integer
     */
    public function getLogoFileSize()
    {
        return $this->logoFileSize;
    }

    /**
     * @param string $logoMimeType
     *
     * @return static
     */
    public function setLogoMimeType($logoMimeType = null)
    {
        $this->logoMimeType = $logoMimeType;

        return $this;
    }

    /**
     * @return string
     */
    public function getLogoMimeType()
    {
        return $this->logoMimeType;
    }

    /**
     * @param string $logoBaseName
     *
     * @return static
     */
    public function setLogoBaseName($logoBaseName = null)
    {
        $this->logoBaseName = $logoBaseName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLogoBaseName()
    {
        return $this->logoBaseName;
    }

    /**
     * @param string $invoiceNif
     *
     * @return static
     */
    public function setInvoiceNif($invoiceNif = null)
    {
        $this->invoiceNif = $invoiceNif;

        return $this;
    }

    /**
     * @return string
     */
    public function getInvoiceNif()
    {
        return $this->invoiceNif;
    }

    /**
     * @param string $invoicePostalAddress
     *
     * @return static
     */
    public function setInvoicePostalAddress($invoicePostalAddress = null)
    {
        $this->invoicePostalAddress = $invoicePostalAddress;

        return $this;
    }

    /**
     * @return string
     */
    public function getInvoicePostalAddress()
    {
        return $this->invoicePostalAddress;
    }

    /**
     * @param string $invoicePostalCode
     *
     * @return static
     */
    public function setInvoicePostalCode($invoicePostalCode = null)
    {
        $this->invoicePostalCode = $invoicePostalCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getInvoicePostalCode()
    {
        return $this->invoicePostalCode;
    }

    /**
     * @param string $invoiceTown
     *
     * @return static
     */
    public function setInvoiceTown($invoiceTown = null)
    {
        $this->invoiceTown = $invoiceTown;

        return $this;
    }

    /**
     * @return string
     */
    public function getInvoiceTown()
    {
        return $this->invoiceTown;
    }

    /**
     * @param string $invoiceProvince
     *
     * @return static
     */
    public function setInvoiceProvince($invoiceProvince = null)
    {
        $this->invoiceProvince = $invoiceProvince;

        return $this;
    }

    /**
     * @return string
     */
    public function getInvoiceProvince()
    {
        return $this->invoiceProvince;
    }

    /**
     * @param string $invoiceCountry
     *
     * @return static
     */
    public function setInvoiceCountry($invoiceCountry = null)
    {
        $this->invoiceCountry = $invoiceCountry;

        return $this;
    }

    /**
     * @return string
     */
    public function getInvoiceCountry()
    {
        return $this->invoiceCountry;
    }

    /**
     * @param string $invoiceRegistryData
     *
     * @return static
     */
    public function setInvoiceRegistryData($invoiceRegistryData = null)
    {
        $this->invoiceRegistryData = $invoiceRegistryData;

        return $this;
    }

    /**
     * @return string
     */
    public function getInvoiceRegistryData()
    {
        return $this->invoiceRegistryData;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Domain\DomainDto $domain
     *
     * @return static
     */
    public function setDomain(\Ivoz\Provider\Domain\Model\Domain\DomainDto $domain = null)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Domain\DomainDto
     */
    public function getDomain()
    {
        return $this->domain;
    }

        /**
         * @param integer $id | null
         *
         * @return static
         */
        public function setDomainId($id)
        {
            $value = !is_null($id)
                ? new \Ivoz\Provider\Domain\Model\Domain\DomainDto($id)
                : null;

            return $this->setDomain($value);
        }

        /**
         * @return integer | null
         */
        public function getDomainId()
        {
            if ($dto = $this->getDomain()) {
                return $dto->getId();
            }

            return null;
        }

    /**
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageDto $language
     *
     * @return static
     */
    public function setLanguage(\Ivoz\Provider\Domain\Model\Language\LanguageDto $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageDto
     */
    public function getLanguage()
    {
        return $this->language;
    }

        /**
         * @param integer $id | null
         *
         * @return static
         */
        public function setLanguageId($id)
        {
            $value = !is_null($id)
                ? new \Ivoz\Provider\Domain\Model\Language\LanguageDto($id)
                : null;

            return $this->setLanguage($value);
        }

        /**
         * @return integer | null
         */
        public function getLanguageId()
        {
            if ($dto = $this->getLanguage()) {
                return $dto->getId();
            }

            return null;
        }

    /**
     * @param \Ivoz\Provider\Domain\Model\Timezone\TimezoneDto $defaultTimezone
     *
     * @return static
     */
    public function setDefaultTimezone(\Ivoz\Provider\Domain\Model\Timezone\TimezoneDto $defaultTimezone = null)
    {
        $this->defaultTimezone = $defaultTimezone;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneDto
     */
    public function getDefaultTimezone()
    {
        return $this->defaultTimezone;
    }

        /**
         * @param integer $id | null
         *
         * @return static
         */
        public function setDefaultTimezoneId($id)
        {
            $value = !is_null($id)
                ? new \Ivoz\Provider\Domain\Model\Timezone\TimezoneDto($id)
                : null;

            return $this->setDefaultTimezone($value);
        }

        /**
         * @return integer | null
         */
        public function getDefaultTimezoneId()
        {
            if ($dto = $this->getDefaultTimezone()) {
                return $dto->getId();
            }

            return null;
        }

    /**
     * @param array $companies
     *
     * @return static
     */
    public function setCompanies($companies = null)
    {
        $this->companies = $companies;

        return $this;
    }

    /**
     * @return array
     */
    public function getCompanies()
    {
        return $this->companies;
    }

    /**
     * @param array $services
     *
     * @return static
     */
    public function setServices($services = null)
    {
        $this->services = $services;

        return $this;
    }

    /**
     * @return array
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @param array $urls
     *
     * @return static
     */
    public function setUrls($urls = null)
    {
        $this->urls = $urls;

        return $this;
    }

    /**
     * @return array
     */
    public function getUrls()
    {
        return $this->urls;
    }

    /**
     * @param array $relFeatures
     *
     * @return static
     */
    public function setRelFeatures($relFeatures = null)
    {
        $this->relFeatures = $relFeatures;

        return $this;
    }

    /**
     * @return array
     */
    public function getRelFeatures()
    {
        return $this->relFeatures;
    }

    /**
     * @param array $domains
     *
     * @return static
     */
    public function setDomains($domains = null)
    {
        $this->domains = $domains;

        return $this;
    }

    /**
     * @return array
     */
    public function getDomains()
    {
        return $this->domains;
    }

    /**
     * @param array $retailAccounts
     *
     * @return static
     */
    public function setRetailAccounts($retailAccounts = null)
    {
        $this->retailAccounts = $retailAccounts;

        return $this;
    }

    /**
     * @return array
     */
    public function getRetailAccounts()
    {
        return $this->retailAccounts;
    }

    /**
     * @param array $musicsOnHold
     *
     * @return static
     */
    public function setMusicsOnHold($musicsOnHold = null)
    {
        $this->musicsOnHold = $musicsOnHold;

        return $this;
    }

    /**
     * @return array
     */
    public function getMusicsOnHold()
    {
        return $this->musicsOnHold;
    }

    /**
     * @param array $matchLists
     *
     * @return static
     */
    public function setMatchLists($matchLists = null)
    {
        $this->matchLists = $matchLists;

        return $this;
    }

    /**
     * @return array
     */
    public function getMatchLists()
    {
        return $this->matchLists;
    }

    /**
     * @param array $outgoingRoutings
     *
     * @return static
     */
    public function setOutgoingRoutings($outgoingRoutings = null)
    {
        $this->outgoingRoutings = $outgoingRoutings;

        return $this;
    }

    /**
     * @return array
     */
    public function getOutgoingRoutings()
    {
        return $this->outgoingRoutings;
    }
}


