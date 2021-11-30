<?php

declare(strict_types=1);

namespace Ivoz\Kam\Domain\Model\TrunksUacreg;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistration;
use Ivoz\Provider\Domain\Model\Brand\Brand;

/**
* TrunksUacregAbstract
* @codeCoverageIgnore
*/
abstract class TrunksUacregAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     * column: l_uuid
     */
    protected $lUuid = '';

    /**
     * @var string
     * column: l_username
     */
    protected $lUsername = 'unused';

    /**
     * @var string
     * column: l_domain
     */
    protected $lDomain = 'unused';

    /**
     * @var string
     * column: r_username
     */
    protected $rUsername = '';

    /**
     * @var string
     * column: r_domain
     */
    protected $rDomain = '';

    /**
     * @var string
     */
    protected $realm = '';

    /**
     * @var string
     * column: auth_username
     */
    protected $authUsername = '';

    /**
     * @var string
     * column: auth_password
     */
    protected $authPassword = '';

    /**
     * @var string
     * column: auth_proxy
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
     * @var int
     * column: reg_delay
     */
    protected $regDelay = 0;

    /**
     * @var string
     * column: auth_ha1
     */
    protected $authHa1 = '';

    /**
     * @var string
     */
    protected $socket = '';

    /**
     * @var string
     * column: contact_addr
     */
    protected $contactAddr = '';

    /**
     * @var DdiProviderRegistrationInterface
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
        string $lUuid,
        string $lUsername,
        string $lDomain,
        string $rUsername,
        string $rDomain,
        string $realm,
        string $authUsername,
        string $authPassword,
        string $authProxy,
        int $expires,
        int $flags,
        int $regDelay,
        string $authHa1,
        string $socket,
        string $contactAddr
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
        $this->setSocket($socket);
        $this->setContactAddr($contactAddr);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "TrunksUacreg",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): TrunksUacregDto
    {
        return new TrunksUacregDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|TrunksUacregInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TrunksUacregDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TrunksUacregDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TrunksUacregDto::class);
        $lUuid = $dto->getLUuid();
        Assertion::notNull($lUuid, 'getLUuid value is null, but non null value was expected.');
        $lUsername = $dto->getLUsername();
        Assertion::notNull($lUsername, 'getLUsername value is null, but non null value was expected.');
        $lDomain = $dto->getLDomain();
        Assertion::notNull($lDomain, 'getLDomain value is null, but non null value was expected.');
        $rUsername = $dto->getRUsername();
        Assertion::notNull($rUsername, 'getRUsername value is null, but non null value was expected.');
        $rDomain = $dto->getRDomain();
        Assertion::notNull($rDomain, 'getRDomain value is null, but non null value was expected.');
        $realm = $dto->getRealm();
        Assertion::notNull($realm, 'getRealm value is null, but non null value was expected.');
        $authUsername = $dto->getAuthUsername();
        Assertion::notNull($authUsername, 'getAuthUsername value is null, but non null value was expected.');
        $authPassword = $dto->getAuthPassword();
        Assertion::notNull($authPassword, 'getAuthPassword value is null, but non null value was expected.');
        $authProxy = $dto->getAuthProxy();
        Assertion::notNull($authProxy, 'getAuthProxy value is null, but non null value was expected.');
        $expires = $dto->getExpires();
        Assertion::notNull($expires, 'getExpires value is null, but non null value was expected.');
        $flags = $dto->getFlags();
        Assertion::notNull($flags, 'getFlags value is null, but non null value was expected.');
        $regDelay = $dto->getRegDelay();
        Assertion::notNull($regDelay, 'getRegDelay value is null, but non null value was expected.');
        $authHa1 = $dto->getAuthHa1();
        Assertion::notNull($authHa1, 'getAuthHa1 value is null, but non null value was expected.');
        $socket = $dto->getSocket();
        Assertion::notNull($socket, 'getSocket value is null, but non null value was expected.');
        $contactAddr = $dto->getContactAddr();
        Assertion::notNull($contactAddr, 'getContactAddr value is null, but non null value was expected.');
        $ddiProviderRegistration = $dto->getDdiProviderRegistration();
        Assertion::notNull($ddiProviderRegistration, 'getDdiProviderRegistration value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');

        $self = new static(
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
            $authHa1,
            $socket,
            $contactAddr
        );

        $self
            ->setDdiProviderRegistration($fkTransformer->transform($ddiProviderRegistration))
            ->setBrand($fkTransformer->transform($brand));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TrunksUacregDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TrunksUacregDto::class);

        $lUuid = $dto->getLUuid();
        Assertion::notNull($lUuid, 'getLUuid value is null, but non null value was expected.');
        $lUsername = $dto->getLUsername();
        Assertion::notNull($lUsername, 'getLUsername value is null, but non null value was expected.');
        $lDomain = $dto->getLDomain();
        Assertion::notNull($lDomain, 'getLDomain value is null, but non null value was expected.');
        $rUsername = $dto->getRUsername();
        Assertion::notNull($rUsername, 'getRUsername value is null, but non null value was expected.');
        $rDomain = $dto->getRDomain();
        Assertion::notNull($rDomain, 'getRDomain value is null, but non null value was expected.');
        $realm = $dto->getRealm();
        Assertion::notNull($realm, 'getRealm value is null, but non null value was expected.');
        $authUsername = $dto->getAuthUsername();
        Assertion::notNull($authUsername, 'getAuthUsername value is null, but non null value was expected.');
        $authPassword = $dto->getAuthPassword();
        Assertion::notNull($authPassword, 'getAuthPassword value is null, but non null value was expected.');
        $authProxy = $dto->getAuthProxy();
        Assertion::notNull($authProxy, 'getAuthProxy value is null, but non null value was expected.');
        $expires = $dto->getExpires();
        Assertion::notNull($expires, 'getExpires value is null, but non null value was expected.');
        $flags = $dto->getFlags();
        Assertion::notNull($flags, 'getFlags value is null, but non null value was expected.');
        $regDelay = $dto->getRegDelay();
        Assertion::notNull($regDelay, 'getRegDelay value is null, but non null value was expected.');
        $authHa1 = $dto->getAuthHa1();
        Assertion::notNull($authHa1, 'getAuthHa1 value is null, but non null value was expected.');
        $socket = $dto->getSocket();
        Assertion::notNull($socket, 'getSocket value is null, but non null value was expected.');
        $contactAddr = $dto->getContactAddr();
        Assertion::notNull($contactAddr, 'getContactAddr value is null, but non null value was expected.');
        $ddiProviderRegistration = $dto->getDdiProviderRegistration();
        Assertion::notNull($ddiProviderRegistration, 'getDdiProviderRegistration value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');

        $this
            ->setLUuid($lUuid)
            ->setLUsername($lUsername)
            ->setLDomain($lDomain)
            ->setRUsername($rUsername)
            ->setRDomain($rDomain)
            ->setRealm($realm)
            ->setAuthUsername($authUsername)
            ->setAuthPassword($authPassword)
            ->setAuthProxy($authProxy)
            ->setExpires($expires)
            ->setFlags($flags)
            ->setRegDelay($regDelay)
            ->setAuthHa1($authHa1)
            ->setSocket($socket)
            ->setContactAddr($contactAddr)
            ->setDdiProviderRegistration($fkTransformer->transform($ddiProviderRegistration))
            ->setBrand($fkTransformer->transform($brand));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TrunksUacregDto
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
            ->setSocket(self::getSocket())
            ->setContactAddr(self::getContactAddr())
            ->setDdiProviderRegistration(DdiProviderRegistration::entityToDto(self::getDdiProviderRegistration(), $depth))
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth));
    }

    protected function __toArray(): array
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
            'socket' => self::getSocket(),
            'contact_addr' => self::getContactAddr(),
            'ddiProviderRegistrationId' => self::getDdiProviderRegistration()->getId(),
            'brandId' => self::getBrand()->getId()
        ];
    }

    protected function setLUuid(string $lUuid): static
    {
        Assertion::maxLength($lUuid, 64, 'lUuid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->lUuid = $lUuid;

        return $this;
    }

    public function getLUuid(): string
    {
        return $this->lUuid;
    }

    protected function setLUsername(string $lUsername): static
    {
        Assertion::maxLength($lUsername, 64, 'lUsername value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->lUsername = $lUsername;

        return $this;
    }

    public function getLUsername(): string
    {
        return $this->lUsername;
    }

    protected function setLDomain(string $lDomain): static
    {
        Assertion::maxLength($lDomain, 190, 'lDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->lDomain = $lDomain;

        return $this;
    }

    public function getLDomain(): string
    {
        return $this->lDomain;
    }

    protected function setRUsername(string $rUsername): static
    {
        Assertion::maxLength($rUsername, 64, 'rUsername value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->rUsername = $rUsername;

        return $this;
    }

    public function getRUsername(): string
    {
        return $this->rUsername;
    }

    protected function setRDomain(string $rDomain): static
    {
        Assertion::maxLength($rDomain, 190, 'rDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->rDomain = $rDomain;

        return $this;
    }

    public function getRDomain(): string
    {
        return $this->rDomain;
    }

    protected function setRealm(string $realm): static
    {
        Assertion::maxLength($realm, 64, 'realm value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->realm = $realm;

        return $this;
    }

    public function getRealm(): string
    {
        return $this->realm;
    }

    protected function setAuthUsername(string $authUsername): static
    {
        Assertion::maxLength($authUsername, 64, 'authUsername value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->authUsername = $authUsername;

        return $this;
    }

    public function getAuthUsername(): string
    {
        return $this->authUsername;
    }

    protected function setAuthPassword(string $authPassword): static
    {
        Assertion::maxLength($authPassword, 64, 'authPassword value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->authPassword = $authPassword;

        return $this;
    }

    public function getAuthPassword(): string
    {
        return $this->authPassword;
    }

    protected function setAuthProxy(string $authProxy): static
    {
        Assertion::maxLength($authProxy, 255, 'authProxy value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->authProxy = $authProxy;

        return $this;
    }

    public function getAuthProxy(): string
    {
        return $this->authProxy;
    }

    protected function setExpires(int $expires): static
    {
        $this->expires = $expires;

        return $this;
    }

    public function getExpires(): int
    {
        return $this->expires;
    }

    protected function setFlags(int $flags): static
    {
        $this->flags = $flags;

        return $this;
    }

    public function getFlags(): int
    {
        return $this->flags;
    }

    protected function setRegDelay(int $regDelay): static
    {
        $this->regDelay = $regDelay;

        return $this;
    }

    public function getRegDelay(): int
    {
        return $this->regDelay;
    }

    protected function setAuthHa1(string $authHa1): static
    {
        Assertion::maxLength($authHa1, 128, 'authHa1 value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->authHa1 = $authHa1;

        return $this;
    }

    public function getAuthHa1(): string
    {
        return $this->authHa1;
    }

    protected function setSocket(string $socket): static
    {
        Assertion::maxLength($socket, 128, 'socket value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->socket = $socket;

        return $this;
    }

    public function getSocket(): string
    {
        return $this->socket;
    }

    protected function setContactAddr(string $contactAddr): static
    {
        Assertion::maxLength($contactAddr, 255, 'contactAddr value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->contactAddr = $contactAddr;

        return $this;
    }

    public function getContactAddr(): string
    {
        return $this->contactAddr;
    }

    public function setDdiProviderRegistration(DdiProviderRegistrationInterface $ddiProviderRegistration): static
    {
        $this->ddiProviderRegistration = $ddiProviderRegistration;

        return $this;
    }

    public function getDdiProviderRegistration(): DdiProviderRegistrationInterface
    {
        return $this->ddiProviderRegistration;
    }

    protected function setBrand(BrandInterface $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): BrandInterface
    {
        return $this->brand;
    }
}
