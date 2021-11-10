<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Administrator;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Timezone\Timezone;

/**
* AdministratorAbstract
* @codeCoverageIgnore
*/
abstract class AdministratorAbstract
{
    use ChangelogTrait;

    protected $username;

    /**
     * comment: password
     */
    protected $pass;

    protected $email = '';

    protected $active = true;

    protected $internal = false;

    protected $restricted = false;

    protected $name;

    protected $lastname;

    /**
     * @var BrandInterface | null
     */
    protected $brand;

    /**
     * @var CompanyInterface | null
     */
    protected $company;

    /**
     * @var TimezoneInterface | null
     */
    protected $timezone;

    /**
     * Constructor
     */
    protected function __construct(
        string $username,
        string $pass,
        string $email,
        bool $active,
        bool $internal,
        bool $restricted
    ) {
        $this->setUsername($username);
        $this->setPass($pass);
        $this->setEmail($email);
        $this->setActive($active);
        $this->setInternal($internal);
        $this->setRestricted($restricted);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Administrator",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): AdministratorDto
    {
        return new AdministratorDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|AdministratorInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?AdministratorDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, AdministratorInterface::class);

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
     * @param AdministratorDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, AdministratorDto::class);

        $self = new static(
            $dto->getUsername(),
            $dto->getPass(),
            $dto->getEmail(),
            $dto->getActive(),
            $dto->getInternal(),
            $dto->getRestricted()
        );

        $self
            ->setName($dto->getName())
            ->setLastname($dto->getLastname())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setTimezone($fkTransformer->transform($dto->getTimezone()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param AdministratorDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, AdministratorDto::class);

        $this
            ->setUsername($dto->getUsername())
            ->setPass($dto->getPass())
            ->setEmail($dto->getEmail())
            ->setActive($dto->getActive())
            ->setInternal($dto->getInternal())
            ->setRestricted($dto->getRestricted())
            ->setName($dto->getName())
            ->setLastname($dto->getLastname())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setTimezone($fkTransformer->transform($dto->getTimezone()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): AdministratorDto
    {
        return self::createDto()
            ->setUsername(self::getUsername())
            ->setPass(self::getPass())
            ->setEmail(self::getEmail())
            ->setActive(self::getActive())
            ->setInternal(self::getInternal())
            ->setRestricted(self::getRestricted())
            ->setName(self::getName())
            ->setLastname(self::getLastname())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setTimezone(Timezone::entityToDto(self::getTimezone(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'username' => self::getUsername(),
            'pass' => self::getPass(),
            'email' => self::getEmail(),
            'active' => self::getActive(),
            'internal' => self::getInternal(),
            'restricted' => self::getRestricted(),
            'name' => self::getName(),
            'lastname' => self::getLastname(),
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'timezoneId' => self::getTimezone() ? self::getTimezone()->getId() : null
        ];
    }

    protected function setUsername(string $username): static
    {
        Assertion::maxLength($username, 65, 'username value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->username = $username;

        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    protected function setPass(string $pass): static
    {
        Assertion::maxLength($pass, 80, 'pass value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->pass = $pass;

        return $this;
    }

    public function getPass(): string
    {
        return $this->pass;
    }

    protected function setEmail(string $email): static
    {
        Assertion::maxLength($email, 100, 'email value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->email = $email;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    protected function setActive(bool $active): static
    {
        $this->active = $active;

        return $this;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    protected function setInternal(bool $internal): static
    {
        $this->internal = $internal;

        return $this;
    }

    public function getInternal(): bool
    {
        return $this->internal;
    }

    protected function setRestricted(bool $restricted): static
    {
        $this->restricted = $restricted;

        return $this;
    }

    public function getRestricted(): bool
    {
        return $this->restricted;
    }

    protected function setName(?string $name = null): static
    {
        if (!is_null($name)) {
            Assertion::maxLength($name, 100, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    protected function setLastname(?string $lastname = null): static
    {
        if (!is_null($lastname)) {
            Assertion::maxLength($lastname, 100, 'lastname value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->lastname = $lastname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    protected function setBrand(?BrandInterface $brand = null): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandInterface
    {
        return $this->brand;
    }

    protected function setCompany(?CompanyInterface $company = null): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyInterface
    {
        return $this->company;
    }

    protected function setTimezone(?TimezoneInterface $timezone = null): static
    {
        $this->timezone = $timezone;

        return $this;
    }

    public function getTimezone(): ?TimezoneInterface
    {
        return $this->timezone;
    }
}
