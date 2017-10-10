<?php

namespace Ivoz\Kam\Domain\Model\TrunksUacreg;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * TrunksUacregAbstract
 * @codeCoverageIgnore
 */
abstract class TrunksUacregAbstract
{
    /**
     * @column l_uuid
     * @var string
     */
    protected $lUuid = '';

    /**
     * @column l_username
     * @var string
     */
    protected $lUsername = 'unused';

    /**
     * @column l_domain
     * @var string
     */
    protected $lDomain = 'unused';

    /**
     * @column r_username
     * @var string
     */
    protected $rUsername = '';

    /**
     * @column r_domain
     * @var string
     */
    protected $rDomain = '';

    /**
     * @var string
     */
    protected $realm = '';

    /**
     * @column auth_username
     * @var string
     */
    protected $authUsername = '';

    /**
     * @column auth_password
     * @var string
     */
    protected $authPassword = '';

    /**
     * @column auth_proxy
     * @var string
     */
    protected $authProxy = '';

    /**
     * @var integer
     */
    protected $expires = '0';

    /**
     * @var integer
     */
    protected $flags = '0';

    /**
     * @column reg_delay
     * @var integer
     */
    protected $regDelay = '0';

    /**
     * @var boolean
     */
    protected $multiddi = '0';

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface
     */
    protected $peeringContract;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct(
        $lUuid,
        $lUsername,
        $lDomain,
        $rUsername,
        $rDomain,
        $realm,
        $authUsername,
        $authPassword,
        $authProxy,
        $expires,
        $flags,
        $regDelay,
        $multiddi
    ) {
        $this->setLUuid($lUuid);
        $this->setLUsername($lUsername);
        $this->setLDomain($lDomain);
        $this->setRUsername($rUsername);
        $this->setRDomain($rDomain);
        $this->setRealm($realm);
        $this->setAuthUsername($authUsername);
        $this->setAuthPassword($authPassword);
        $this->setAuthProxy($authProxy);
        $this->setExpires($expires);
        $this->setFlags($flags);
        $this->setRegDelay($regDelay);
        $this->setMultiddi($multiddi);

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
     * @return TrunksUacregDTO
     */
    public static function createDTO()
    {
        return new TrunksUacregDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TrunksUacregDTO
         */
        Assertion::isInstanceOf($dto, TrunksUacregDTO::class);

        $self = new static(
            $dto->getLUuid(),
            $dto->getLUsername(),
            $dto->getLDomain(),
            $dto->getRUsername(),
            $dto->getRDomain(),
            $dto->getRealm(),
            $dto->getAuthUsername(),
            $dto->getAuthPassword(),
            $dto->getAuthProxy(),
            $dto->getExpires(),
            $dto->getFlags(),
            $dto->getRegDelay(),
            $dto->getMultiddi());

        return $self
            ->setBrand($dto->getBrand())
            ->setPeeringContract($dto->getPeeringContract())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TrunksUacregDTO
         */
        Assertion::isInstanceOf($dto, TrunksUacregDTO::class);

        $this
            ->setLUuid($dto->getLUuid())
            ->setLUsername($dto->getLUsername())
            ->setLDomain($dto->getLDomain())
            ->setRUsername($dto->getRUsername())
            ->setRDomain($dto->getRDomain())
            ->setRealm($dto->getRealm())
            ->setAuthUsername($dto->getAuthUsername())
            ->setAuthPassword($dto->getAuthPassword())
            ->setAuthProxy($dto->getAuthProxy())
            ->setExpires($dto->getExpires())
            ->setFlags($dto->getFlags())
            ->setRegDelay($dto->getRegDelay())
            ->setMultiddi($dto->getMultiddi())
            ->setBrand($dto->getBrand())
            ->setPeeringContract($dto->getPeeringContract());


        return $this;
    }

    /**
     * @return TrunksUacregDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setLUuid($this->getLUuid())
            ->setLUsername($this->getLUsername())
            ->setLDomain($this->getLDomain())
            ->setRUsername($this->getRUsername())
            ->setRDomain($this->getRDomain())
            ->setRealm($this->getRealm())
            ->setAuthUsername($this->getAuthUsername())
            ->setAuthPassword($this->getAuthPassword())
            ->setAuthProxy($this->getAuthProxy())
            ->setExpires($this->getExpires())
            ->setFlags($this->getFlags())
            ->setRegDelay($this->getRegDelay())
            ->setMultiddi($this->getMultiddi())
            ->setBrandId($this->getBrand() ? $this->getBrand()->getId() : null)
            ->setPeeringContractId($this->getPeeringContract() ? $this->getPeeringContract()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'lUuid' => self::getLUuid(),
            'lUsername' => self::getLUsername(),
            'lDomain' => self::getLDomain(),
            'rUsername' => self::getRUsername(),
            'rDomain' => self::getRDomain(),
            'realm' => self::getRealm(),
            'authUsername' => self::getAuthUsername(),
            'authPassword' => self::getAuthPassword(),
            'authProxy' => self::getAuthProxy(),
            'expires' => self::getExpires(),
            'flags' => self::getFlags(),
            'regDelay' => self::getRegDelay(),
            'multiddi' => self::getMultiddi(),
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'peeringContractId' => self::getPeeringContract() ? self::getPeeringContract()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set lUuid
     *
     * @param string $lUuid
     *
     * @return self
     */
    public function setLUuid($lUuid)
    {
        Assertion::notNull($lUuid);
        Assertion::maxLength($lUuid, 64);

        $this->lUuid = $lUuid;

        return $this;
    }

    /**
     * Get lUuid
     *
     * @return string
     */
    public function getLUuid()
    {
        return $this->lUuid;
    }

    /**
     * Set lUsername
     *
     * @param string $lUsername
     *
     * @return self
     */
    public function setLUsername($lUsername)
    {
        Assertion::notNull($lUsername);
        Assertion::maxLength($lUsername, 64);

        $this->lUsername = $lUsername;

        return $this;
    }

    /**
     * Get lUsername
     *
     * @return string
     */
    public function getLUsername()
    {
        return $this->lUsername;
    }

    /**
     * Set lDomain
     *
     * @param string $lDomain
     *
     * @return self
     */
    public function setLDomain($lDomain)
    {
        Assertion::notNull($lDomain);
        Assertion::maxLength($lDomain, 190);

        $this->lDomain = $lDomain;

        return $this;
    }

    /**
     * Get lDomain
     *
     * @return string
     */
    public function getLDomain()
    {
        return $this->lDomain;
    }

    /**
     * Set rUsername
     *
     * @param string $rUsername
     *
     * @return self
     */
    public function setRUsername($rUsername)
    {
        Assertion::notNull($rUsername);
        Assertion::maxLength($rUsername, 64);

        $this->rUsername = $rUsername;

        return $this;
    }

    /**
     * Get rUsername
     *
     * @return string
     */
    public function getRUsername()
    {
        return $this->rUsername;
    }

    /**
     * Set rDomain
     *
     * @param string $rDomain
     *
     * @return self
     */
    public function setRDomain($rDomain)
    {
        Assertion::notNull($rDomain);
        Assertion::maxLength($rDomain, 190);

        $this->rDomain = $rDomain;

        return $this;
    }

    /**
     * Get rDomain
     *
     * @return string
     */
    public function getRDomain()
    {
        return $this->rDomain;
    }

    /**
     * Set realm
     *
     * @param string $realm
     *
     * @return self
     */
    public function setRealm($realm)
    {
        Assertion::notNull($realm);
        Assertion::maxLength($realm, 64);

        $this->realm = $realm;

        return $this;
    }

    /**
     * Get realm
     *
     * @return string
     */
    public function getRealm()
    {
        return $this->realm;
    }

    /**
     * Set authUsername
     *
     * @param string $authUsername
     *
     * @return self
     */
    public function setAuthUsername($authUsername)
    {
        Assertion::notNull($authUsername);
        Assertion::maxLength($authUsername, 64);

        $this->authUsername = $authUsername;

        return $this;
    }

    /**
     * Get authUsername
     *
     * @return string
     */
    public function getAuthUsername()
    {
        return $this->authUsername;
    }

    /**
     * Set authPassword
     *
     * @param string $authPassword
     *
     * @return self
     */
    public function setAuthPassword($authPassword)
    {
        Assertion::notNull($authPassword);
        Assertion::maxLength($authPassword, 64);

        $this->authPassword = $authPassword;

        return $this;
    }

    /**
     * Get authPassword
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->authPassword;
    }

    /**
     * Set authProxy
     *
     * @param string $authProxy
     *
     * @return self
     */
    public function setAuthProxy($authProxy)
    {
        Assertion::notNull($authProxy);
        Assertion::maxLength($authProxy, 64);

        $this->authProxy = $authProxy;

        return $this;
    }

    /**
     * Get authProxy
     *
     * @return string
     */
    public function getAuthProxy()
    {
        return $this->authProxy;
    }

    /**
     * Set expires
     *
     * @param integer $expires
     *
     * @return self
     */
    public function setExpires($expires)
    {
        Assertion::notNull($expires);
        Assertion::integerish($expires);

        $this->expires = $expires;

        return $this;
    }

    /**
     * Get expires
     *
     * @return integer
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * Set flags
     *
     * @param integer $flags
     *
     * @return self
     */
    public function setFlags($flags)
    {
        Assertion::notNull($flags);
        Assertion::integerish($flags);

        $this->flags = $flags;

        return $this;
    }

    /**
     * Get flags
     *
     * @return integer
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * Set regDelay
     *
     * @param integer $regDelay
     *
     * @return self
     */
    public function setRegDelay($regDelay)
    {
        Assertion::notNull($regDelay);
        Assertion::integerish($regDelay);

        $this->regDelay = $regDelay;

        return $this;
    }

    /**
     * Get regDelay
     *
     * @return integer
     */
    public function getRegDelay()
    {
        return $this->regDelay;
    }

    /**
     * Set multiddi
     *
     * @param boolean $multiddi
     *
     * @return self
     */
    public function setMultiddi($multiddi)
    {
        Assertion::notNull($multiddi);
        Assertion::between(intval($multiddi), 0, 1);

        $this->multiddi = $multiddi;

        return $this;
    }

    /**
     * Get multiddi
     *
     * @return boolean
     */
    public function getMultiddi()
    {
        return $this->multiddi;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand)
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
     * Set peeringContract
     *
     * @param \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface $peeringContract
     *
     * @return self
     */
    public function setPeeringContract(\Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface $peeringContract)
    {
        $this->peeringContract = $peeringContract;

        return $this;
    }

    /**
     * Get peeringContract
     *
     * @return \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface
     */
    public function getPeeringContract()
    {
        return $this->peeringContract;
    }



    // @codeCoverageIgnoreEnd
}

