<?php

namespace Ivoz\Provider\Domain\Model\Brand;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class BrandDTO implements DataTransferObjectInterface
{
    use BrandDTOTrait;
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
     * @var mixed
     */
    private $domainId;

    /**
     * @var mixed
     */
    private $languageId;

    /**
     * @var mixed
     */
    private $defaultTimezoneId;

    /**
     * @var mixed
     */
    private $domain;

    /**
     * @var mixed
     */
    private $language;

    /**
     * @var mixed
     */
    private $defaultTimezone;

    /**
     * @var array|null
     */
    private $companies = null;

    /**
     * @var array|null
     */
    private $services = null;

    /**
     * @var array|null
     */
    private $urls = null;

    /**
     * @var array|null
     */
    private $relFeatures = null;

    /**
     * @var array|null
     */
    private $domains = null;

    /**
     * @var array|null
     */
    private $retailAccounts = null;

    /**
     * @var array|null
     */
    private $musicsOnHold = null;

    /**
     * @var array|null
     */
    private $matchLists = null;

    /**
     * @var array|null
     */
    private $outgoingRoutings = null;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'name' => $this->getName(),
            'domainUsers' => $this->getDomainUsers(),
            'fromName' => $this->getFromName(),
            'fromAddress' => $this->getFromAddress(),
            'recordingsLimitMB' => $this->getRecordingsLimitMB(),
            'recordingsLimitEmail' => $this->getRecordingsLimitEmail(),
            'id' => $this->getId(),
            'logoFileSize' => $this->getLogoFileSize(),
            'logoMimeType' => $this->getLogoMimeType(),
            'logoBaseName' => $this->getLogoBaseName(),
            'invoiceNif' => $this->getInvoiceNif(),
            'invoicePostalAddress' => $this->getInvoicePostalAddress(),
            'invoicePostalCode' => $this->getInvoicePostalCode(),
            'invoiceTown' => $this->getInvoiceTown(),
            'invoiceProvince' => $this->getInvoiceProvince(),
            'invoiceCountry' => $this->getInvoiceCountry(),
            'invoiceRegistryData' => $this->getInvoiceRegistryData(),
            'domainId' => $this->getDomainId(),
            'languageId' => $this->getLanguageId(),
            'defaultTimezoneId' => $this->getDefaultTimezoneId(),
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
     * @return BrandDTO
     */
    public function setName($name)
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
     * @return BrandDTO
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
     * @return BrandDTO
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
     * @return BrandDTO
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
     * @return BrandDTO
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
     * @return BrandDTO
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
     * @return BrandDTO
     */
    public function setId($id)
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
     * @return BrandDTO
     */
    public function setLogoFileSize($logoFileSize)
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
     * @return BrandDTO
     */
    public function setLogoMimeType($logoMimeType)
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
     * @return BrandDTO
     */
    public function setLogoBaseName($logoBaseName)
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
     * @return BrandDTO
     */
    public function setInvoiceNif($invoiceNif)
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
     * @return BrandDTO
     */
    public function setInvoicePostalAddress($invoicePostalAddress)
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
     * @return BrandDTO
     */
    public function setInvoicePostalCode($invoicePostalCode)
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
     * @return BrandDTO
     */
    public function setInvoiceTown($invoiceTown)
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
     * @return BrandDTO
     */
    public function setInvoiceProvince($invoiceProvince)
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
     * @return BrandDTO
     */
    public function setInvoiceCountry($invoiceCountry)
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
     * @return BrandDTO
     */
    public function setInvoiceRegistryData($invoiceRegistryData)
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
     * @param integer $domainId
     *
     * @return BrandDTO
     */
    public function setDomainId($domainId)
    {
        $this->domainId = $domainId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getDomainId()
    {
        return $this->domainId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Domain\Domain
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param integer $languageId
     *
     * @return BrandDTO
     */
    public function setLanguageId($languageId)
    {
        $this->languageId = $languageId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getLanguageId()
    {
        return $this->languageId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Language\Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param integer $defaultTimezoneId
     *
     * @return BrandDTO
     */
    public function setDefaultTimezoneId($defaultTimezoneId)
    {
        $this->defaultTimezoneId = $defaultTimezoneId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getDefaultTimezoneId()
    {
        return $this->defaultTimezoneId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Timezone\Timezone
     */
    public function getDefaultTimezone()
    {
        return $this->defaultTimezone;
    }

    /**
     * @param array $companies
     *
     * @return BrandDTO
     */
    public function setCompanies($companies)
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
     * @return BrandDTO
     */
    public function setServices($services)
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
     * @return BrandDTO
     */
    public function setUrls($urls)
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
     * @return BrandDTO
     */
    public function setRelFeatures($relFeatures)
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
     * @return BrandDTO
     */
    public function setDomains($domains)
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
     * @return BrandDTO
     */
    public function setRetailAccounts($retailAccounts)
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
     * @return BrandDTO
     */
    public function setMusicsOnHold($musicsOnHold)
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
     * @return BrandDTO
     */
    public function setMatchLists($matchLists)
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
     * @return BrandDTO
     */
    public function setOutgoingRoutings($outgoingRoutings)
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


