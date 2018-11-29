<?php

namespace Ivoz\Kam\Domain\Model\TrunksUacreg;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * TrunksUacregAbstract
 * @codeCoverageIgnore
 */
abstract class TrunksUacregAbstract
{
    /**
     * column: l_uuid
     * @var string
     */
    protected $lUuid = '';

    /**
     * column: l_username
     * @var string
     */
    protected $lUsername = 'unused';

    /**
     * column: l_domain
     * @var string
     */
    protected $lDomain = 'unused';

    /**
     * column: r_username
     * @var string
     */
    protected $rUsername = '';

    /**
     * column: r_domain
     * @var string
     */
    protected $rDomain = '';

    /**
     * @var string
     */
    protected $realm = '';

    /**
     * column: auth_username
     * @var string
     */
    protected $authUsername = '';

    /**
     * column: auth_password
     * @var string
     */
    protected $authPassword = '';

    /**
     * column: auth_proxy
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
     * column: reg_delay
     * @var integer
     */
    protected $regDelay = '0';

    /**
     * column: auth_ha1
     * @var string
     */
    protected $authHa1 = '';

    /**
     * @var \Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface
     */
    protected $ddiProviderRegistration;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
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
        $authHa1
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
        $this->setAuthHa1($authHa1);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "TrunksUacreg",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param null $id
     * @return TrunksUacregDto
     */
    public static function createDto($id = null)
    {
        return new TrunksUacregDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return TrunksUacregDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TrunksUacregInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TrunksUacregDto
         */
        Assertion::isInstanceOf($dto, TrunksUacregDto::class);

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
            $dto->getAuthHa1()
        );

        $self
            ->setDdiProviderRegistration($dto->getDdiProviderRegistration())
            ->setBrand($dto->getBrand())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TrunksUacregDto
         */
        Assertion::isInstanceOf($dto, TrunksUacregDto::class);

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
            ->setAuthHa1($dto->getAuthHa1())
            ->setDdiProviderRegistration($dto->getDdiProviderRegistration())
            ->setBrand($dto->getBrand());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return TrunksUacregDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setLUuid(self::getLUuid())
            ->setLUsername(self::getLUsername())
            ->setLDomain(self::getLDomain())
            ->setRUsername(self::getRUsername())
            ->setRDomain(self::getRDomain())
            ->setRealm(self::getRealm())
            ->setAuthUsername(self::getAuthUsername())
            ->setAuthPassword(self::getAuthPassword())
            ->setAuthProxy(self::getAuthProxy())
            ->setExpires(self::getExpires())
            ->setFlags(self::getFlags())
            ->setRegDelay(self::getRegDelay())
            ->setAuthHa1(self::getAuthHa1())
            ->setDdiProviderRegistration(\Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistration::entityToDto(self::getDdiProviderRegistration(), $depth))
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto(self::getBrand(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'l_uuid' => self::getLUuid(),
            'l_username' => self::getLUsername(),
            'l_domain' => self::getLDomain(),
            'r_username' => self::getRUsername(),
            'r_domain' => self::getRDomain(),
            'realm' => self::getRealm(),
            'auth_username' => self::getAuthUsername(),
            'auth_password' => self::getAuthPassword(),
            'auth_proxy' => self::getAuthProxy(),
            'expires' => self::getExpires(),
            'flags' => self::getFlags(),
            'reg_delay' => self::getRegDelay(),
            'auth_ha1' => self::getAuthHa1(),
            'ddiProviderRegistrationId' => self::getDdiProviderRegistration() ? self::getDdiProviderRegistration()->getId() : null,
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null
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
    protected function setLUuid($lUuid)
    {
        Assertion::notNull($lUuid, 'lUuid value "%s" is null, but non null value was expected.');
        Assertion::maxLength($lUuid, 64, 'lUuid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setLUsername($lUsername)
    {
        Assertion::notNull($lUsername, 'lUsername value "%s" is null, but non null value was expected.');
        Assertion::maxLength($lUsername, 64, 'lUsername value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setLDomain($lDomain)
    {
        Assertion::notNull($lDomain, 'lDomain value "%s" is null, but non null value was expected.');
        Assertion::maxLength($lDomain, 190, 'lDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setRUsername($rUsername)
    {
        Assertion::notNull($rUsername, 'rUsername value "%s" is null, but non null value was expected.');
        Assertion::maxLength($rUsername, 64, 'rUsername value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setRDomain($rDomain)
    {
        Assertion::notNull($rDomain, 'rDomain value "%s" is null, but non null value was expected.');
        Assertion::maxLength($rDomain, 190, 'rDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setRealm($realm)
    {
        Assertion::notNull($realm, 'realm value "%s" is null, but non null value was expected.');
        Assertion::maxLength($realm, 64, 'realm value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setAuthUsername($authUsername)
    {
        Assertion::notNull($authUsername, 'authUsername value "%s" is null, but non null value was expected.');
        Assertion::maxLength($authUsername, 64, 'authUsername value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setAuthPassword($authPassword)
    {
        Assertion::notNull($authPassword, 'authPassword value "%s" is null, but non null value was expected.');
        Assertion::maxLength($authPassword, 64, 'authPassword value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setAuthProxy($authProxy)
    {
        Assertion::notNull($authProxy, 'authProxy value "%s" is null, but non null value was expected.');
        Assertion::maxLength($authProxy, 64, 'authProxy value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setExpires($expires)
    {
        Assertion::notNull($expires, 'expires value "%s" is null, but non null value was expected.');
        Assertion::integerish($expires, 'expires value "%s" is not an integer or a number castable to integer.');

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
    protected function setFlags($flags)
    {
        Assertion::notNull($flags, 'flags value "%s" is null, but non null value was expected.');
        Assertion::integerish($flags, 'flags value "%s" is not an integer or a number castable to integer.');

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
    protected function setRegDelay($regDelay)
    {
        Assertion::notNull($regDelay, 'regDelay value "%s" is null, but non null value was expected.');
        Assertion::integerish($regDelay, 'regDelay value "%s" is not an integer or a number castable to integer.');

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
     * Set authHa1
     *
     * @param string $authHa1
     *
     * @return self
     */
    protected function setAuthHa1($authHa1)
    {
        Assertion::notNull($authHa1, 'authHa1 value "%s" is null, but non null value was expected.');
        Assertion::maxLength($authHa1, 128, 'authHa1 value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->authHa1 = $authHa1;

        return $this;
    }

    /**
     * Get authHa1
     *
     * @return string
     */
    public function getAuthHa1()
    {
        return $this->authHa1;
    }

    /**
     * Set ddiProviderRegistration
     *
     * @param \Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface $ddiProviderRegistration
     *
     * @return self
     */
    public function setDdiProviderRegistration(\Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface $ddiProviderRegistration)
    {
        $this->ddiProviderRegistration = $ddiProviderRegistration;

        return $this;
    }

    /**
     * Get ddiProviderRegistration
     *
     * @return \Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface
     */
    public function getDdiProviderRegistration()
    {
        return $this->ddiProviderRegistration;
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

    // @codeCoverageIgnoreEnd
}
