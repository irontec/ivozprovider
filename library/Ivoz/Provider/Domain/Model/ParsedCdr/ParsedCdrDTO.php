<?php

namespace Ivoz\Provider\Domain\Model\ParsedCdr;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class ParsedCdrDTO implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $statId;

    /**
     * @var integer
     */
    private $xstatId;

    /**
     * @var string
     */
    private $statType;

    /**
     * @var string
     */
    private $initialLeg;

    /**
     * @var string
     */
    private $initialLegHash;

    /**
     * @var string
     */
    private $cid;

    /**
     * @var string
     */
    private $cidHash;

    /**
     * @var string
     */
    private $xcid;

    /**
     * @var string
     */
    private $xcidHash;

    /**
     * @var string
     */
    private $proxies;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $subtype;

    /**
     * @var \DateTime
     */
    private $calldate = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $duration;

    /**
     * @var string
     */
    private $aParty;

    /**
     * @var string
     */
    private $bParty;

    /**
     * @var string
     */
    private $caller;

    /**
     * @var string
     */
    private $callee;

    /**
     * @var string
     */
    private $xCaller;

    /**
     * @var string
     */
    private $xCallee;

    /**
     * @var string
     */
    private $initialReferrer;

    /**
     * @var string
     */
    private $referrer;

    /**
     * @var string
     */
    private $referee;

    /**
     * @var string
     */
    private $lastForwarder;

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
    private $peeringContractId;

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
    private $peeringContract;

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->brand = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Brand\\Brand', $this->getBrandId());
        $this->company = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $this->getCompanyId());
        $this->peeringContract = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\PeeringContract\\PeeringContract', $this->getPeeringContractId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param integer $statId
     *
     * @return ParsedCdrDTO
     */
    public function setStatId($statId = null)
    {
        $this->statId = $statId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getStatId()
    {
        return $this->statId;
    }

    /**
     * @param integer $xstatId
     *
     * @return ParsedCdrDTO
     */
    public function setXstatId($xstatId = null)
    {
        $this->xstatId = $xstatId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getXstatId()
    {
        return $this->xstatId;
    }

    /**
     * @param string $statType
     *
     * @return ParsedCdrDTO
     */
    public function setStatType($statType = null)
    {
        $this->statType = $statType;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatType()
    {
        return $this->statType;
    }

    /**
     * @param string $initialLeg
     *
     * @return ParsedCdrDTO
     */
    public function setInitialLeg($initialLeg = null)
    {
        $this->initialLeg = $initialLeg;

        return $this;
    }

    /**
     * @return string
     */
    public function getInitialLeg()
    {
        return $this->initialLeg;
    }

    /**
     * @param string $initialLegHash
     *
     * @return ParsedCdrDTO
     */
    public function setInitialLegHash($initialLegHash = null)
    {
        $this->initialLegHash = $initialLegHash;

        return $this;
    }

    /**
     * @return string
     */
    public function getInitialLegHash()
    {
        return $this->initialLegHash;
    }

    /**
     * @param string $cid
     *
     * @return ParsedCdrDTO
     */
    public function setCid($cid = null)
    {
        $this->cid = $cid;

        return $this;
    }

    /**
     * @return string
     */
    public function getCid()
    {
        return $this->cid;
    }

    /**
     * @param string $cidHash
     *
     * @return ParsedCdrDTO
     */
    public function setCidHash($cidHash = null)
    {
        $this->cidHash = $cidHash;

        return $this;
    }

    /**
     * @return string
     */
    public function getCidHash()
    {
        return $this->cidHash;
    }

    /**
     * @param string $xcid
     *
     * @return ParsedCdrDTO
     */
    public function setXcid($xcid = null)
    {
        $this->xcid = $xcid;

        return $this;
    }

    /**
     * @return string
     */
    public function getXcid()
    {
        return $this->xcid;
    }

    /**
     * @param string $xcidHash
     *
     * @return ParsedCdrDTO
     */
    public function setXcidHash($xcidHash = null)
    {
        $this->xcidHash = $xcidHash;

        return $this;
    }

    /**
     * @return string
     */
    public function getXcidHash()
    {
        return $this->xcidHash;
    }

    /**
     * @param string $proxies
     *
     * @return ParsedCdrDTO
     */
    public function setProxies($proxies = null)
    {
        $this->proxies = $proxies;

        return $this;
    }

    /**
     * @return string
     */
    public function getProxies()
    {
        return $this->proxies;
    }

    /**
     * @param string $type
     *
     * @return ParsedCdrDTO
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $subtype
     *
     * @return ParsedCdrDTO
     */
    public function setSubtype($subtype = null)
    {
        $this->subtype = $subtype;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubtype()
    {
        return $this->subtype;
    }

    /**
     * @param \DateTime $calldate
     *
     * @return ParsedCdrDTO
     */
    public function setCalldate($calldate)
    {
        $this->calldate = $calldate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCalldate()
    {
        return $this->calldate;
    }

    /**
     * @param integer $duration
     *
     * @return ParsedCdrDTO
     */
    public function setDuration($duration = null)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param string $aParty
     *
     * @return ParsedCdrDTO
     */
    public function setAParty($aParty = null)
    {
        $this->aParty = $aParty;

        return $this;
    }

    /**
     * @return string
     */
    public function getAParty()
    {
        return $this->aParty;
    }

    /**
     * @param string $bParty
     *
     * @return ParsedCdrDTO
     */
    public function setBParty($bParty = null)
    {
        $this->bParty = $bParty;

        return $this;
    }

    /**
     * @return string
     */
    public function getBParty()
    {
        return $this->bParty;
    }

    /**
     * @param string $caller
     *
     * @return ParsedCdrDTO
     */
    public function setCaller($caller = null)
    {
        $this->caller = $caller;

        return $this;
    }

    /**
     * @return string
     */
    public function getCaller()
    {
        return $this->caller;
    }

    /**
     * @param string $callee
     *
     * @return ParsedCdrDTO
     */
    public function setCallee($callee = null)
    {
        $this->callee = $callee;

        return $this;
    }

    /**
     * @return string
     */
    public function getCallee()
    {
        return $this->callee;
    }

    /**
     * @param string $xCaller
     *
     * @return ParsedCdrDTO
     */
    public function setXCaller($xCaller = null)
    {
        $this->xCaller = $xCaller;

        return $this;
    }

    /**
     * @return string
     */
    public function getXCaller()
    {
        return $this->xCaller;
    }

    /**
     * @param string $xCallee
     *
     * @return ParsedCdrDTO
     */
    public function setXCallee($xCallee = null)
    {
        $this->xCallee = $xCallee;

        return $this;
    }

    /**
     * @return string
     */
    public function getXCallee()
    {
        return $this->xCallee;
    }

    /**
     * @param string $initialReferrer
     *
     * @return ParsedCdrDTO
     */
    public function setInitialReferrer($initialReferrer = null)
    {
        $this->initialReferrer = $initialReferrer;

        return $this;
    }

    /**
     * @return string
     */
    public function getInitialReferrer()
    {
        return $this->initialReferrer;
    }

    /**
     * @param string $referrer
     *
     * @return ParsedCdrDTO
     */
    public function setReferrer($referrer = null)
    {
        $this->referrer = $referrer;

        return $this;
    }

    /**
     * @return string
     */
    public function getReferrer()
    {
        return $this->referrer;
    }

    /**
     * @param string $referee
     *
     * @return ParsedCdrDTO
     */
    public function setReferee($referee = null)
    {
        $this->referee = $referee;

        return $this;
    }

    /**
     * @return string
     */
    public function getReferee()
    {
        return $this->referee;
    }

    /**
     * @param string $lastForwarder
     *
     * @return ParsedCdrDTO
     */
    public function setLastForwarder($lastForwarder = null)
    {
        $this->lastForwarder = $lastForwarder;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastForwarder()
    {
        return $this->lastForwarder;
    }

    /**
     * @param integer $id
     *
     * @return ParsedCdrDTO
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
     * @return ParsedCdrDTO
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
     * @return ParsedCdrDTO
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
     * @param integer $peeringContractId
     *
     * @return ParsedCdrDTO
     */
    public function setPeeringContractId($peeringContractId)
    {
        $this->peeringContractId = $peeringContractId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPeeringContractId()
    {
        return $this->peeringContractId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContract
     */
    public function getPeeringContract()
    {
        return $this->peeringContract;
    }
}


