<?php
declare(strict_types = 1);

namespace Ivoz\Kam\Domain\Model\TrunksUacreg;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistration;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;

/**
* TrunksUacregAbstract
* @codeCoverageIgnore
*/
abstract class TrunksUacregAbstract
{
    use ChangelogTrait;

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
     * @var int
     */
    protected $expires = 0;

    /**
     * @var int
     */
    protected $flags = 0;

    /**
     * column: reg_delay
     * @var int
     */
    protected $regDelay = 0;

    /**
     * column: auth_ha1
     * @var string
     */
    protected $authHa1 = '';

    /**
     * @var DdiProviderRegistration
     * inversedBy trunksUacreg
     */
    protected $ddiProviderRegistration;

    /**
     * @var BrandInterface
     */
    protected $brand;

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
     * @param TrunksUacregInterface|null $entity
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

        /** @var TrunksUacregDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TrunksUacregDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
            ->setDdiProviderRegistration($fkTransformer->transform($dto->getDdiProviderRegistration()))
            ->setBrand($fkTransformer->transform($dto->getBrand()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TrunksUacregDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
            ->setDdiProviderRegistration($fkTransformer->transform($dto->getDdiProviderRegistration()))
            ->setBrand($fkTransformer->transform($dto->getBrand()));

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
            ->setDdiProviderRegistration(DdiProviderRegistration::entityToDto(self::getDdiProviderRegistration(), $depth))
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth));
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
            'ddiProviderRegistrationId' => self::getDdiProviderRegistration()->getId(),
            'brandId' => self::getBrand()->getId()
        ];
    }

    /**
     * Set lUuid
     *
     * @param string $lUuid
     *
     * @return static
     */
    protected function setLUuid(string $lUuid): TrunksUacregInterface
    {
        Assertion::maxLength($lUuid, 64, 'lUuid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->lUuid = $lUuid;

        return $this;
    }

    /**
     * Get lUuid
     *
     * @return string
     */
    public function getLUuid(): string
    {
        return $this->lUuid;
    }

    /**
     * Set lUsername
     *
     * @param string $lUsername
     *
     * @return static
     */
    protected function setLUsername(string $lUsername): TrunksUacregInterface
    {
        Assertion::maxLength($lUsername, 64, 'lUsername value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->lUsername = $lUsername;

        return $this;
    }

    /**
     * Get lUsername
     *
     * @return string
     */
    public function getLUsername(): string
    {
        return $this->lUsername;
    }

    /**
     * Set lDomain
     *
     * @param string $lDomain
     *
     * @return static
     */
    protected function setLDomain(string $lDomain): TrunksUacregInterface
    {
        Assertion::maxLength($lDomain, 190, 'lDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->lDomain = $lDomain;

        return $this;
    }

    /**
     * Get lDomain
     *
     * @return string
     */
    public function getLDomain(): string
    {
        return $this->lDomain;
    }

    /**
     * Set rUsername
     *
     * @param string $rUsername
     *
     * @return static
     */
    protected function setRUsername(string $rUsername): TrunksUacregInterface
    {
        Assertion::maxLength($rUsername, 64, 'rUsername value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->rUsername = $rUsername;

        return $this;
    }

    /**
     * Get rUsername
     *
     * @return string
     */
    public function getRUsername(): string
    {
        return $this->rUsername;
    }

    /**
     * Set rDomain
     *
     * @param string $rDomain
     *
     * @return static
     */
    protected function setRDomain(string $rDomain): TrunksUacregInterface
    {
        Assertion::maxLength($rDomain, 190, 'rDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->rDomain = $rDomain;

        return $this;
    }

    /**
     * Get rDomain
     *
     * @return string
     */
    public function getRDomain(): string
    {
        return $this->rDomain;
    }

    /**
     * Set realm
     *
     * @param string $realm
     *
     * @return static
     */
    protected function setRealm(string $realm): TrunksUacregInterface
    {
        Assertion::maxLength($realm, 64, 'realm value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->realm = $realm;

        return $this;
    }

    /**
     * Get realm
     *
     * @return string
     */
    public function getRealm(): string
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
    protected function setAuthUsername(string $authUsername): TrunksUacregInterface
    {
        Assertion::maxLength($authUsername, 64, 'authUsername value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->authUsername = $authUsername;

        return $this;
    }

    /**
     * Get authUsername
     *
     * @return string
     */
    public function getAuthUsername(): string
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
    protected function setAuthPassword(string $authPassword): TrunksUacregInterface
    {
        Assertion::maxLength($authPassword, 64, 'authPassword value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->authPassword = $authPassword;

        return $this;
    }

    /**
     * Get authPassword
     *
     * @return string
     */
    public function getAuthPassword(): string
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
    protected function setAuthProxy(string $authProxy): TrunksUacregInterface
    {
        Assertion::maxLength($authProxy, 64, 'authProxy value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->authProxy = $authProxy;

        return $this;
    }

    /**
     * Get authProxy
     *
     * @return string
     */
    public function getAuthProxy(): string
    {
        return $this->authProxy;
    }

    /**
     * Set expires
     *
     * @param int $expires
     *
     * @return static
     */
    protected function setExpires(int $expires): TrunksUacregInterface
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * Get expires
     *
     * @return int
     */
    public function getExpires(): int
    {
        return $this->expires;
    }

    /**
     * Set flags
     *
     * @param int $flags
     *
     * @return static
     */
    protected function setFlags(int $flags): TrunksUacregInterface
    {
        $this->flags = $flags;

        return $this;
    }

    /**
     * Get flags
     *
     * @return int
     */
    public function getFlags(): int
    {
        return $this->flags;
    }

    /**
     * Set regDelay
     *
     * @param int $regDelay
     *
     * @return static
     */
    protected function setRegDelay(int $regDelay): TrunksUacregInterface
    {
        $this->regDelay = $regDelay;

        return $this;
    }

    /**
     * Get regDelay
     *
     * @return int
     */
    public function getRegDelay(): int
    {
        return $this->regDelay;
    }

    /**
     * Set authHa1
     *
     * @param string $authHa1
     *
     * @return static
     */
    protected function setAuthHa1(string $authHa1): TrunksUacregInterface
    {
        Assertion::maxLength($authHa1, 128, 'authHa1 value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->authHa1 = $authHa1;

        return $this;
    }

    /**
     * Get authHa1
     *
     * @return string
     */
    public function getAuthHa1(): string
    {
        return $this->authHa1;
    }

    /**
     * Set ddiProviderRegistration
     *
     * @param DdiProviderRegistration
     *
     * @return static
     */
    public function setDdiProviderRegistration(DdiProviderRegistration $ddiProviderRegistration): TrunksUacregInterface
    {
        $this->ddiProviderRegistration = $ddiProviderRegistration;

        return $this;
    }

    /**
     * Get ddiProviderRegistration
     *
     * @return DdiProviderRegistration
     */
    public function getDdiProviderRegistration(): DdiProviderRegistration
    {
        return $this->ddiProviderRegistration;
    }

    /**
     * Set brand
     *
     * @param BrandInterface
     *
     * @return static
     */
    protected function setBrand(BrandInterface $brand): TrunksUacregInterface
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface
    {
        return $this->brand;
    }

}
