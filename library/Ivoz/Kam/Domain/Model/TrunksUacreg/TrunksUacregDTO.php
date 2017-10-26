<?php

namespace Ivoz\Kam\Domain\Model\TrunksUacreg;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class TrunksUacregDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $lUuid = '';

    /**
     * @var string
     */
    private $lUsername = 'unused';

    /**
     * @var string
     */
    private $lDomain = 'unused';

    /**
     * @var string
     */
    private $rUsername = '';

    /**
     * @var string
     */
    private $rDomain = '';

    /**
     * @var string
     */
    private $realm = '';

    /**
     * @var string
     */
    private $authUsername = '';

    /**
     * @var string
     */
    private $authPassword = '';

    /**
     * @var string
     */
    private $authProxy = '';

    /**
     * @var integer
     */
    private $expires = '0';

    /**
     * @var integer
     */
    private $flags = '0';

    /**
     * @var integer
     */
    private $regDelay = '0';

    /**
     * @var boolean
     */
    private $multiddi = '0';

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
    private $peeringContractId;

    /**
     * @var mixed
     */
    private $brand;

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
        $this->peeringContract = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\PeeringContract\\PeeringContract', $this->getPeeringContractId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $lUuid
     *
     * @return TrunksUacregDTO
     */
    public function setLUuid($lUuid)
    {
        $this->lUuid = $lUuid;

        return $this;
    }

    /**
     * @return string
     */
    public function getLUuid()
    {
        return $this->lUuid;
    }

    /**
     * @param string $lUsername
     *
     * @return TrunksUacregDTO
     */
    public function setLUsername($lUsername)
    {
        $this->lUsername = $lUsername;

        return $this;
    }

    /**
     * @return string
     */
    public function getLUsername()
    {
        return $this->lUsername;
    }

    /**
     * @param string $lDomain
     *
     * @return TrunksUacregDTO
     */
    public function setLDomain($lDomain)
    {
        $this->lDomain = $lDomain;

        return $this;
    }

    /**
     * @return string
     */
    public function getLDomain()
    {
        return $this->lDomain;
    }

    /**
     * @param string $rUsername
     *
     * @return TrunksUacregDTO
     */
    public function setRUsername($rUsername)
    {
        $this->rUsername = $rUsername;

        return $this;
    }

    /**
     * @return string
     */
    public function getRUsername()
    {
        return $this->rUsername;
    }

    /**
     * @param string $rDomain
     *
     * @return TrunksUacregDTO
     */
    public function setRDomain($rDomain)
    {
        $this->rDomain = $rDomain;

        return $this;
    }

    /**
     * @return string
     */
    public function getRDomain()
    {
        return $this->rDomain;
    }

    /**
     * @param string $realm
     *
     * @return TrunksUacregDTO
     */
    public function setRealm($realm)
    {
        $this->realm = $realm;

        return $this;
    }

    /**
     * @return string
     */
    public function getRealm()
    {
        return $this->realm;
    }

    /**
     * @param string $authUsername
     *
     * @return TrunksUacregDTO
     */
    public function setAuthUsername($authUsername)
    {
        $this->authUsername = $authUsername;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthUsername()
    {
        return $this->authUsername;
    }

    /**
     * @param string $authPassword
     *
     * @return TrunksUacregDTO
     */
    public function setAuthPassword($authPassword)
    {
        $this->authPassword = $authPassword;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->authPassword;
    }

    /**
     * @param string $authProxy
     *
     * @return TrunksUacregDTO
     */
    public function setAuthProxy($authProxy)
    {
        $this->authProxy = $authProxy;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthProxy()
    {
        return $this->authProxy;
    }

    /**
     * @param integer $expires
     *
     * @return TrunksUacregDTO
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * @return integer
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * @param integer $flags
     *
     * @return TrunksUacregDTO
     */
    public function setFlags($flags)
    {
        $this->flags = $flags;

        return $this;
    }

    /**
     * @return integer
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * @param integer $regDelay
     *
     * @return TrunksUacregDTO
     */
    public function setRegDelay($regDelay)
    {
        $this->regDelay = $regDelay;

        return $this;
    }

    /**
     * @return integer
     */
    public function getRegDelay()
    {
        return $this->regDelay;
    }

    /**
     * @param boolean $multiddi
     *
     * @return TrunksUacregDTO
     */
    public function setMultiddi($multiddi)
    {
        $this->multiddi = $multiddi;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getMultiddi()
    {
        return $this->multiddi;
    }

    /**
     * @param integer $id
     *
     * @return TrunksUacregDTO
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
     * @return TrunksUacregDTO
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
     * @param integer $peeringContractId
     *
     * @return TrunksUacregDTO
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


