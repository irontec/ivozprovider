<?php

namespace Ivoz\Provider\Domain\Model\DdiProviderRegistration;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * DdiProviderRegistrationAbstract
 * @codeCoverageIgnore
 */
abstract class DdiProviderRegistrationAbstract
{
    /**
     * @var string
     */
    protected $username = '';

    /**
     * @var string
     */
    protected $domain = '';

    /**
     * @var string
     */
    protected $realm = '';

    /**
     * @var string
     */
    protected $authUsername = '';

    /**
     * @var string
     */
    protected $authPassword = '';

    /**
     * @var string
     */
    protected $authProxy = '';

    /**
     * @var integer
     */
    protected $expires = 0;

    /**
     * @var boolean | null
     */
    protected $multiDdi = false;

    /**
     * @var string
     */
    protected $contactUsername = '';

    /**
     * @var \Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface
     */
    protected $trunksUacreg;

    /**
     * @var \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface
     */
    protected $ddiProvider;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
        $username,
        $domain,
        $realm,
        $authUsername,
        $authPassword,
        $authProxy,
        $expires,
        $contactUsername
    ) {
        $this->setUsername($username);
        $this->setDomain($domain);
        $this->setRealm($realm);
        $this->setAuthUsername($authUsername);
        $this->setAuthPassword($authPassword);
        $this->setAuthProxy($authProxy);
        $this->setExpires($expires);
        $this->setContactUsername($contactUsername);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "DdiProviderRegistration",
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
     * @return DdiProviderRegistrationDto
     */
    public static function createDto($id = null)
    {
        return new DdiProviderRegistrationDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param DdiProviderRegistrationInterface|null $entity
     * @param int $depth
     * @return DdiProviderRegistrationDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, DdiProviderRegistrationInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var DdiProviderRegistrationDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DdiProviderRegistrationDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, DdiProviderRegistrationDto::class);

        $self = new static(
            $dto->getUsername(),
            $dto->getDomain(),
            $dto->getRealm(),
            $dto->getAuthUsername(),
            $dto->getAuthPassword(),
            $dto->getAuthProxy(),
            $dto->getExpires(),
            $dto->getContactUsername()
        );

        $self
            ->setMultiDdi($dto->getMultiDdi())
            ->setTrunksUacreg($fkTransformer->transform($dto->getTrunksUacreg()))
            ->setDdiProvider($fkTransformer->transform($dto->getDdiProvider()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DdiProviderRegistrationDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, DdiProviderRegistrationDto::class);

        $this
            ->setUsername($dto->getUsername())
            ->setDomain($dto->getDomain())
            ->setRealm($dto->getRealm())
            ->setAuthUsername($dto->getAuthUsername())
            ->setAuthPassword($dto->getAuthPassword())
            ->setAuthProxy($dto->getAuthProxy())
            ->setExpires($dto->getExpires())
            ->setMultiDdi($dto->getMultiDdi())
            ->setContactUsername($dto->getContactUsername())
            ->setTrunksUacreg($fkTransformer->transform($dto->getTrunksUacreg()))
            ->setDdiProvider($fkTransformer->transform($dto->getDdiProvider()));



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return DdiProviderRegistrationDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setUsername(self::getUsername())
            ->setDomain(self::getDomain())
            ->setRealm(self::getRealm())
            ->setAuthUsername(self::getAuthUsername())
            ->setAuthPassword(self::getAuthPassword())
            ->setAuthProxy(self::getAuthProxy())
            ->setExpires(self::getExpires())
            ->setMultiDdi(self::getMultiDdi())
            ->setContactUsername(self::getContactUsername())
            ->setTrunksUacreg(\Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacreg::entityToDto(self::getTrunksUacreg(), $depth))
            ->setDdiProvider(\Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider::entityToDto(self::getDdiProvider(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'username' => self::getUsername(),
            'domain' => self::getDomain(),
            'realm' => self::getRealm(),
            'authUsername' => self::getAuthUsername(),
            'authPassword' => self::getAuthPassword(),
            'authProxy' => self::getAuthProxy(),
            'expires' => self::getExpires(),
            'multiDdi' => self::getMultiDdi(),
            'contactUsername' => self::getContactUsername(),
            'trunksUacregId' => self::getTrunksUacreg() ? self::getTrunksUacreg()->getId() : null,
            'ddiProviderId' => self::getDdiProvider() ? self::getDdiProvider()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set username
     *
     * @param string $username
     *
     * @return static
     */
    protected function setUsername($username)
    {
        Assertion::notNull($username, 'username value "%s" is null, but non null value was expected.');
        Assertion::maxLength($username, 64, 'username value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set domain
     *
     * @param string $domain
     *
     * @return static
     */
    protected function setDomain($domain)
    {
        Assertion::notNull($domain, 'domain value "%s" is null, but non null value was expected.');
        Assertion::maxLength($domain, 190, 'domain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set realm
     *
     * @param string $realm
     *
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
     */
    protected function setExpires($expires)
    {
        Assertion::notNull($expires, 'expires value "%s" is null, but non null value was expected.');
        Assertion::integerish($expires, 'expires value "%s" is not an integer or a number castable to integer.');

        $this->expires = (int) $expires;

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
     * Set multiDdi
     *
     * @param boolean $multiDdi | null
     *
     * @return static
     */
    protected function setMultiDdi($multiDdi = null)
    {
        if (!is_null($multiDdi)) {
            Assertion::between(intval($multiDdi), 0, 1, 'multiDdi provided "%s" is not a valid boolean value.');
            $multiDdi = (bool) $multiDdi;
        }

        $this->multiDdi = $multiDdi;

        return $this;
    }

    /**
     * Get multiDdi
     *
     * @return boolean | null
     */
    public function getMultiDdi()
    {
        return $this->multiDdi;
    }

    /**
     * Set contactUsername
     *
     * @param string $contactUsername
     *
     * @return static
     */
    protected function setContactUsername($contactUsername)
    {
        Assertion::notNull($contactUsername, 'contactUsername value "%s" is null, but non null value was expected.');
        Assertion::maxLength($contactUsername, 64, 'contactUsername value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->contactUsername = $contactUsername;

        return $this;
    }

    /**
     * Get contactUsername
     *
     * @return string
     */
    public function getContactUsername()
    {
        return $this->contactUsername;
    }

    /**
     * Set trunksUacreg
     *
     * @param \Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface $trunksUacreg
     *
     * @return static
     */
    public function setTrunksUacreg(\Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface $trunksUacreg = null)
    {
        $this->trunksUacreg = $trunksUacreg;

        return $this;
    }

    /**
     * Get trunksUacreg
     *
     * @return \Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface
     */
    public function getTrunksUacreg()
    {
        return $this->trunksUacreg;
    }

    /**
     * Set ddiProvider
     *
     * @param \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface $ddiProvider
     *
     * @return static
     */
    public function setDdiProvider(\Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface $ddiProvider = null)
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    /**
     * Get ddiProvider
     *
     * @return \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface
     */
    public function getDdiProvider()
    {
        return $this->ddiProvider;
    }

    // @codeCoverageIgnoreEnd
}
