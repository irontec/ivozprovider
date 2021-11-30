<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\DdiProviderRegistration;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider;

/**
* DdiProviderRegistrationAbstract
* @codeCoverageIgnore
*/
abstract class DdiProviderRegistrationAbstract
{
    use ChangelogTrait;

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
     * @var int
     */
    protected $expires = 0;

    /**
     * @var ?bool
     */
    protected $multiDdi = false;

    /**
     * @var string
     */
    protected $contactUsername = '';

    /**
     * @var DdiProviderInterface
     * inversedBy ddiProviderRegistrations
     */
    protected $ddiProvider;

    /**
     * Constructor
     */
    protected function __construct(
        string $username,
        string $domain,
        string $realm,
        string $authUsername,
        string $authPassword,
        string $authProxy,
        int $expires,
        string $contactUsername
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

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "DdiProviderRegistration",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): DdiProviderRegistrationDto
    {
        return new DdiProviderRegistrationDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|DdiProviderRegistrationInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?DdiProviderRegistrationDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DdiProviderRegistrationDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, DdiProviderRegistrationDto::class);
        $username = $dto->getUsername();
        Assertion::notNull($username, 'getUsername value is null, but non null value was expected.');
        $domain = $dto->getDomain();
        Assertion::notNull($domain, 'getDomain value is null, but non null value was expected.');
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
        $contactUsername = $dto->getContactUsername();
        Assertion::notNull($contactUsername, 'getContactUsername value is null, but non null value was expected.');
        $ddiProvider = $dto->getDdiProvider();
        Assertion::notNull($ddiProvider, 'getDdiProvider value is null, but non null value was expected.');

        $self = new static(
            $username,
            $domain,
            $realm,
            $authUsername,
            $authPassword,
            $authProxy,
            $expires,
            $contactUsername
        );

        $self
            ->setMultiDdi($dto->getMultiDdi())
            ->setDdiProvider($fkTransformer->transform($ddiProvider));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DdiProviderRegistrationDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, DdiProviderRegistrationDto::class);

        $username = $dto->getUsername();
        Assertion::notNull($username, 'getUsername value is null, but non null value was expected.');
        $domain = $dto->getDomain();
        Assertion::notNull($domain, 'getDomain value is null, but non null value was expected.');
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
        $contactUsername = $dto->getContactUsername();
        Assertion::notNull($contactUsername, 'getContactUsername value is null, but non null value was expected.');
        $ddiProvider = $dto->getDdiProvider();
        Assertion::notNull($ddiProvider, 'getDdiProvider value is null, but non null value was expected.');

        $this
            ->setUsername($username)
            ->setDomain($domain)
            ->setRealm($realm)
            ->setAuthUsername($authUsername)
            ->setAuthPassword($authPassword)
            ->setAuthProxy($authProxy)
            ->setExpires($expires)
            ->setMultiDdi($dto->getMultiDdi())
            ->setContactUsername($contactUsername)
            ->setDdiProvider($fkTransformer->transform($ddiProvider));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): DdiProviderRegistrationDto
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
            ->setDdiProvider(DdiProvider::entityToDto(self::getDdiProvider(), $depth));
    }

    protected function __toArray(): array
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
            'ddiProviderId' => self::getDdiProvider()->getId()
        ];
    }

    protected function setUsername(string $username): static
    {
        Assertion::maxLength($username, 64, 'username value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->username = $username;

        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    protected function setDomain(string $domain): static
    {
        Assertion::maxLength($domain, 190, 'domain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->domain = $domain;

        return $this;
    }

    public function getDomain(): string
    {
        return $this->domain;
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
        Assertion::maxLength($authProxy, 64, 'authProxy value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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

    protected function setMultiDdi(?bool $multiDdi = null): static
    {
        $this->multiDdi = $multiDdi;

        return $this;
    }

    public function getMultiDdi(): ?bool
    {
        return $this->multiDdi;
    }

    protected function setContactUsername(string $contactUsername): static
    {
        Assertion::maxLength($contactUsername, 64, 'contactUsername value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->contactUsername = $contactUsername;

        return $this;
    }

    public function getContactUsername(): string
    {
        return $this->contactUsername;
    }

    public function setDdiProvider(DdiProviderInterface $ddiProvider): static
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    public function getDdiProvider(): DdiProviderInterface
    {
        return $this->ddiProvider;
    }
}
