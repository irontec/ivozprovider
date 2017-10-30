<?php

namespace Ivoz\Provider\Domain\Model\RetailAccount;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class RetailAccountDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $domain;

    /**
     * @var string
     */
    private $description = '';

    /**
     * @var string
     */
    private $transport;

    /**
     * @var string
     */
    private $ip;

    /**
     * @var integer
     */
    private $port;

    /**
     * @var string
     */
    private $authNeeded = 'yes';

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $areaCode;

    /**
     * @var string
     */
    private $disallow = 'all';

    /**
     * @var string
     */
    private $allow = 'alaw';

    /**
     * @var string
     */
    private $directMediaMethod = 'update';

    /**
     * @var string
     */
    private $calleridUpdateHeader = 'pai';

    /**
     * @var string
     */
    private $updateCallerid = 'yes';

    /**
     * @var string
     */
    private $fromDomain;

    /**
     * @var string
     */
    private $directConnectivity = 'yes';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var mixed
     */
    private $brandId;

    /**
     * @var mixed
     */
    private $companyId;

    /**
     * @var mixed
     */
    private $countryId;

    /**
     * @var mixed
     */
    private $outgoingDdiId;

    /**
     * @var mixed
     */
    private $languageId;

    /**
     * @var mixed
     */
    private $brand;

    /**
     * @var mixed
     */
    private $company;

    /**
     * @var mixed
     */
    private $country;

    /**
     * @var mixed
     */
    private $outgoingDdi;

    /**
     * @var mixed
     */
    private $language;

    /**
     * @var array|null
     */
    private $psEndpoints = null;

    /**
     * @var array|null
     */
    private $ddis = null;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'name' => $this->getName(),
            'domain' => $this->getDomain(),
            'description' => $this->getDescription(),
            'transport' => $this->getTransport(),
            'ip' => $this->getIp(),
            'port' => $this->getPort(),
            'authNeeded' => $this->getAuthNeeded(),
            'password' => $this->getPassword(),
            'areaCode' => $this->getAreaCode(),
            'disallow' => $this->getDisallow(),
            'allow' => $this->getAllow(),
            'directMediaMethod' => $this->getDirectMediaMethod(),
            'calleridUpdateHeader' => $this->getCalleridUpdateHeader(),
            'updateCallerid' => $this->getUpdateCallerid(),
            'fromDomain' => $this->getFromDomain(),
            'directConnectivity' => $this->getDirectConnectivity(),
            'id' => $this->getId(),
            'brandId' => $this->getBrandId(),
            'companyId' => $this->getCompanyId(),
            'countryId' => $this->getCountryId(),
            'outgoingDdiId' => $this->getOutgoingDdiId(),
            'languageId' => $this->getLanguageId(),
            'psEndpoints' => $this->getPsEndpoints(),
            'ddis' => $this->getDdis()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->brand = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Brand\\Brand', $this->getBrandId());
        $this->company = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $this->getCompanyId());
        $this->country = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Country\\Country', $this->getCountryId());
        $this->outgoingDdi = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Ddi\\Ddi', $this->getOutgoingDdiId());
        $this->language = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Language\\Language', $this->getLanguageId());
        if (!is_null($this->psEndpoints)) {
            $items = $this->getPsEndpoints();
            $this->psEndpoints = [];
            foreach ($items as $item) {
                $this->psEndpoints[] = $transformer->transform(
                    'Ivoz\\Ast\\Domain\\Model\\PsEndpoint\\PsEndpoint',
                    $item->getId() ?? $item
                );
            }
        }

        if (!is_null($this->ddis)) {
            $items = $this->getDdis();
            $this->ddis = [];
            foreach ($items as $item) {
                $this->ddis[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\Ddi\\Ddi',
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
        $this->psEndpoints = $transformer->transform(
            'Ivoz\\Ast\\Domain\\Model\\PsEndpoint\\PsEndpoint',
            $this->psEndpoints
        );
        $this->ddis = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\Ddi\\Ddi',
            $this->ddis
        );
    }

    /**
     * @param string $name
     *
     * @return RetailAccountDTO
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
     * @param string $domain
     *
     * @return RetailAccountDTO
     */
    public function setDomain($domain = null)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param string $description
     *
     * @return RetailAccountDTO
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $transport
     *
     * @return RetailAccountDTO
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;

        return $this;
    }

    /**
     * @return string
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * @param string $ip
     *
     * @return RetailAccountDTO
     */
    public function setIp($ip = null)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param integer $port
     *
     * @return RetailAccountDTO
     */
    public function setPort($port = null)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param string $authNeeded
     *
     * @return RetailAccountDTO
     */
    public function setAuthNeeded($authNeeded)
    {
        $this->authNeeded = $authNeeded;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthNeeded()
    {
        return $this->authNeeded;
    }

    /**
     * @param string $password
     *
     * @return RetailAccountDTO
     */
    public function setPassword($password = null)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $areaCode
     *
     * @return RetailAccountDTO
     */
    public function setAreaCode($areaCode = null)
    {
        $this->areaCode = $areaCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getAreaCode()
    {
        return $this->areaCode;
    }

    /**
     * @param string $disallow
     *
     * @return RetailAccountDTO
     */
    public function setDisallow($disallow)
    {
        $this->disallow = $disallow;

        return $this;
    }

    /**
     * @return string
     */
    public function getDisallow()
    {
        return $this->disallow;
    }

    /**
     * @param string $allow
     *
     * @return RetailAccountDTO
     */
    public function setAllow($allow)
    {
        $this->allow = $allow;

        return $this;
    }

    /**
     * @return string
     */
    public function getAllow()
    {
        return $this->allow;
    }

    /**
     * @param string $directMediaMethod
     *
     * @return RetailAccountDTO
     */
    public function setDirectMediaMethod($directMediaMethod)
    {
        $this->directMediaMethod = $directMediaMethod;

        return $this;
    }

    /**
     * @return string
     */
    public function getDirectMediaMethod()
    {
        return $this->directMediaMethod;
    }

    /**
     * @param string $calleridUpdateHeader
     *
     * @return RetailAccountDTO
     */
    public function setCalleridUpdateHeader($calleridUpdateHeader)
    {
        $this->calleridUpdateHeader = $calleridUpdateHeader;

        return $this;
    }

    /**
     * @return string
     */
    public function getCalleridUpdateHeader()
    {
        return $this->calleridUpdateHeader;
    }

    /**
     * @param string $updateCallerid
     *
     * @return RetailAccountDTO
     */
    public function setUpdateCallerid($updateCallerid)
    {
        $this->updateCallerid = $updateCallerid;

        return $this;
    }

    /**
     * @return string
     */
    public function getUpdateCallerid()
    {
        return $this->updateCallerid;
    }

    /**
     * @param string $fromDomain
     *
     * @return RetailAccountDTO
     */
    public function setFromDomain($fromDomain = null)
    {
        $this->fromDomain = $fromDomain;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromDomain()
    {
        return $this->fromDomain;
    }

    /**
     * @param string $directConnectivity
     *
     * @return RetailAccountDTO
     */
    public function setDirectConnectivity($directConnectivity)
    {
        $this->directConnectivity = $directConnectivity;

        return $this;
    }

    /**
     * @return string
     */
    public function getDirectConnectivity()
    {
        return $this->directConnectivity;
    }

    /**
     * @param integer $id
     *
     * @return RetailAccountDTO
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
     * @param integer $brandId
     *
     * @return RetailAccountDTO
     */
    public function setBrandId($brandId)
    {
        $this->brandId = $brandId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Brand\Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param integer $companyId
     *
     * @return RetailAccountDTO
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param integer $countryId
     *
     * @return RetailAccountDTO
     */
    public function setCountryId($countryId)
    {
        $this->countryId = $countryId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCountryId()
    {
        return $this->countryId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Country\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param integer $outgoingDdiId
     *
     * @return RetailAccountDTO
     */
    public function setOutgoingDdiId($outgoingDdiId)
    {
        $this->outgoingDdiId = $outgoingDdiId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getOutgoingDdiId()
    {
        return $this->outgoingDdiId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Ddi\Ddi
     */
    public function getOutgoingDdi()
    {
        return $this->outgoingDdi;
    }

    /**
     * @param integer $languageId
     *
     * @return RetailAccountDTO
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
     * @param array $psEndpoints
     *
     * @return RetailAccountDTO
     */
    public function setPsEndpoints($psEndpoints)
    {
        $this->psEndpoints = $psEndpoints;

        return $this;
    }

    /**
     * @return array
     */
    public function getPsEndpoints()
    {
        return $this->psEndpoints;
    }

    /**
     * @param array $ddis
     *
     * @return RetailAccountDTO
     */
    public function setDdis($ddis)
    {
        $this->ddis = $ddis;

        return $this;
    }

    /**
     * @return array
     */
    public function getDdis()
    {
        return $this->ddis;
    }
}


