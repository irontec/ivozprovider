<?php

namespace Ivoz\Kam\Domain\Model\TrunksUacreg;

use Ivoz\Core\Application\DataTransferObjectInterface;
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
     * @var string
     */
    private $authHa1 = '';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationDto | null
     */
    private $ddiProviderRegistration;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;


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
            'authHa1' => 'authHa1',
            'id' => 'id',
            'ddiProviderRegistrationId' => 'ddiProviderRegistration',
            'brandId' => 'brand'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
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
            'authHa1' => $this->getAuthHa1(),
            'id' => $this->getId(),
            'ddiProviderRegistration' => $this->getDdiProviderRegistration(),
            'brand' => $this->getBrand()
        ];
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
     * @param string $authHa1
     *
     * @return static
     */
    public function setAuthHa1($authHa1 = null)
    {
        $this->authHa1 = $authHa1;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthHa1()
    {
        return $this->authHa1;
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
     * @param \Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationDto $ddiProviderRegistration
     *
     * @return static
     */
    public function setDdiProviderRegistration(\Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationDto $ddiProviderRegistration = null)
    {
        $this->ddiProviderRegistration = $ddiProviderRegistration;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationDto
     */
    public function getDdiProviderRegistration()
    {
        return $this->ddiProviderRegistration;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setDdiProviderRegistrationId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationDto($id)
            : null;

        return $this->setDdiProviderRegistration($value);
    }

    /**
     * @return integer | null
     */
    public function getDdiProviderRegistrationId()
    {
        if ($dto = $this->getDdiProviderRegistration()) {
            return $dto->getId();
        }

        return null;
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
}
