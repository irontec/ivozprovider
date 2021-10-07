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
     * @var string
     */
    protected $socket = '';

    /**
     * column: contact_addr
     * @var string
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
     * @param mixed $id
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
        $dto = $entity->toDto($depth - 1);

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
            $dto->getAuthHa1(),
            $dto->getSocket(),
            $dto->getContactAddr()
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
            ->setSocket($dto->getSocket())
            ->setContactAddr($dto->getContactAddr())
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
            ->setSocket(self::getSocket())
            ->setContactAddr(self::getContactAddr())
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

        /** @var  $this */
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
