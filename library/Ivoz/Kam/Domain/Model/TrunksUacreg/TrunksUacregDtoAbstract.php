<?php

namespace Ivoz\Kam\Domain\Model\TrunksUacreg;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class TrunksUacregDtoAbstract implements DataTransferObjectInterface
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
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractDto | null
     */
    private $peeringContract;


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
            'lUuid' => 'lUuid',
            'lUsername' => 'lUsername',
            'lDomain' => 'lDomain',
            'rUsername' => 'rUsername',
            'rDomain' => 'rDomain',
            'realm' => 'realm',
            'authUsername' => 'authUsername',
            'authPassword' => 'authPassword',
            'authProxy' => 'authProxy',
            'expires' => 'expires',
            'flags' => 'flags',
            'regDelay' => 'regDelay',
            'multiddi' => 'multiddi',
            'id' => 'id',
            'brand' => 'brand',
            'peeringContract' => 'peeringContract'
        ];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'lUuid' => $this->getLUuid(),
            'lUsername' => $this->getLUsername(),
            'lDomain' => $this->getLDomain(),
            'rUsername' => $this->getRUsername(),
            'rDomain' => $this->getRDomain(),
            'realm' => $this->getRealm(),
            'authUsername' => $this->getAuthUsername(),
            'authPassword' => $this->getAuthPassword(),
            'authProxy' => $this->getAuthProxy(),
            'expires' => $this->getExpires(),
            'flags' => $this->getFlags(),
            'regDelay' => $this->getRegDelay(),
            'multiddi' => $this->getMultiddi(),
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'peeringContract' => $this->getPeeringContract()
        ];
    }

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
     * @return static
     */
    public function setLUuid($lUuid = null)
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
     * @return static
     */
    public function setLUsername($lUsername = null)
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
     * @return static
     */
    public function setLDomain($lDomain = null)
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
     * @return static
     */
    public function setRUsername($rUsername = null)
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
     * @return static
     */
    public function setRDomain($rDomain = null)
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
     * @return static
     */
    public function setRealm($realm = null)
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
     * @return static
     */
    public function setAuthUsername($authUsername = null)
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
     * @return static
     */
    public function setAuthPassword($authPassword = null)
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
     * @return static
     */
    public function setAuthProxy($authProxy = null)
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
     * @return static
     */
    public function setExpires($expires = null)
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
     * @return static
     */
    public function setFlags($flags = null)
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
     * @return static
     */
    public function setRegDelay($regDelay = null)
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
     * @return static
     */
    public function setMultiddi($multiddi = null)
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
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandDto $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandDto $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandDto
     */
    public function getBrand()
    {
        return $this->brand;
    }

        /**
         * @param integer $id | null
         *
         * @return static
         */
        public function setBrandId($id)
        {
            $value = !is_null($id)
                ? new \Ivoz\Provider\Domain\Model\Brand\BrandDto($id)
                : null;

            return $this->setBrand($value);
        }

        /**
         * @return integer | null
         */
        public function getBrandId()
        {
            if ($dto = $this->getBrand()) {
                return $dto->getId();
            }

            return null;
        }

    /**
     * @param \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractDto $peeringContract
     *
     * @return static
     */
    public function setPeeringContract(\Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractDto $peeringContract = null)
    {
        $this->peeringContract = $peeringContract;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractDto
     */
    public function getPeeringContract()
    {
        return $this->peeringContract;
    }

        /**
         * @param integer $id | null
         *
         * @return static
         */
        public function setPeeringContractId($id)
        {
            $value = !is_null($id)
                ? new \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractDto($id)
                : null;

            return $this->setPeeringContract($value);
        }

        /**
         * @return integer | null
         */
        public function getPeeringContractId()
        {
            if ($dto = $this->getPeeringContract()) {
                return $dto->getId();
            }

            return null;
        }
}


