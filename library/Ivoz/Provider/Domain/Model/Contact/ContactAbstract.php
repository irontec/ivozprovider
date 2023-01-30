<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Contact;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Country\Country;

/**
* ContactAbstract
* @codeCoverageIgnore
*/
abstract class ContactAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var ?string
     */
    protected $lastname = null;

    /**
     * @var ?string
     */
    protected $email = null;

    /**
     * @var ?string
     */
    protected $workPhone = null;

    /**
     * @var ?string
     */
    protected $workPhoneE164 = null;

    /**
     * @var ?string
     */
    protected $mobilePhone = null;

    /**
     * @var ?string
     */
    protected $mobilePhoneE164 = null;

    /**
     * @var ?string
     */
    protected $otherPhone = null;

    /**
     * @var ?UserInterface
     * inversedBy contact
     */
    protected $user = null;

    /**
     * @var CompanyInterface
     * inversedBy contacts
     */
    protected $company;

    /**
     * @var ?CountryInterface
     */
    protected $workPhoneCountry = null;

    /**
     * @var ?CountryInterface
     */
    protected $mobilePhoneCountry = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $name
    ) {
        $this->setName($name);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Contact",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): ContactDto
    {
        return new ContactDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|ContactInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ContactDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ContactInterface::class);

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
     * @param ContactDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ContactDto::class);
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $self = new static(
            $name
        );

        $self
            ->setLastname($dto->getLastname())
            ->setEmail($dto->getEmail())
            ->setWorkPhone($dto->getWorkPhone())
            ->setWorkPhoneE164($dto->getWorkPhoneE164())
            ->setMobilePhone($dto->getMobilePhone())
            ->setMobilePhoneE164($dto->getMobilePhoneE164())
            ->setOtherPhone($dto->getOtherPhone())
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setCompany($fkTransformer->transform($company))
            ->setWorkPhoneCountry($fkTransformer->transform($dto->getWorkPhoneCountry()))
            ->setMobilePhoneCountry($fkTransformer->transform($dto->getMobilePhoneCountry()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ContactDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ContactDto::class);

        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $this
            ->setName($name)
            ->setLastname($dto->getLastname())
            ->setEmail($dto->getEmail())
            ->setWorkPhone($dto->getWorkPhone())
            ->setWorkPhoneE164($dto->getWorkPhoneE164())
            ->setMobilePhone($dto->getMobilePhone())
            ->setMobilePhoneE164($dto->getMobilePhoneE164())
            ->setOtherPhone($dto->getOtherPhone())
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setCompany($fkTransformer->transform($company))
            ->setWorkPhoneCountry($fkTransformer->transform($dto->getWorkPhoneCountry()))
            ->setMobilePhoneCountry($fkTransformer->transform($dto->getMobilePhoneCountry()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ContactDto
    {
        return self::createDto()
            ->setName(self::getName())
            ->setLastname(self::getLastname())
            ->setEmail(self::getEmail())
            ->setWorkPhone(self::getWorkPhone())
            ->setWorkPhoneE164(self::getWorkPhoneE164())
            ->setMobilePhone(self::getMobilePhone())
            ->setMobilePhoneE164(self::getMobilePhoneE164())
            ->setOtherPhone(self::getOtherPhone())
            ->setUser(User::entityToDto(self::getUser(), $depth))
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setWorkPhoneCountry(Country::entityToDto(self::getWorkPhoneCountry(), $depth))
            ->setMobilePhoneCountry(Country::entityToDto(self::getMobilePhoneCountry(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'name' => self::getName(),
            'lastname' => self::getLastname(),
            'email' => self::getEmail(),
            'workPhone' => self::getWorkPhone(),
            'workPhoneE164' => self::getWorkPhoneE164(),
            'mobilePhone' => self::getMobilePhone(),
            'mobilePhoneE164' => self::getMobilePhoneE164(),
            'otherPhone' => self::getOtherPhone(),
            'userId' => self::getUser()?->getId(),
            'companyId' => self::getCompany()->getId(),
            'workPhoneCountryId' => self::getWorkPhoneCountry()?->getId(),
            'mobilePhoneCountryId' => self::getMobilePhoneCountry()?->getId()
        ];
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 100, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
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

    protected function setEmail(?string $email = null): static
    {
        if (!is_null($email)) {
            Assertion::maxLength($email, 100, 'email value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->email = $email;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    protected function setWorkPhone(?string $workPhone = null): static
    {
        if (!is_null($workPhone)) {
            Assertion::maxLength($workPhone, 20, 'workPhone value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->workPhone = $workPhone;

        return $this;
    }

    public function getWorkPhone(): ?string
    {
        return $this->workPhone;
    }

    protected function setWorkPhoneE164(?string $workPhoneE164 = null): static
    {
        if (!is_null($workPhoneE164)) {
            Assertion::maxLength($workPhoneE164, 25, 'workPhoneE164 value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->workPhoneE164 = $workPhoneE164;

        return $this;
    }

    public function getWorkPhoneE164(): ?string
    {
        return $this->workPhoneE164;
    }

    protected function setMobilePhone(?string $mobilePhone = null): static
    {
        if (!is_null($mobilePhone)) {
            Assertion::maxLength($mobilePhone, 20, 'mobilePhone value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->mobilePhone = $mobilePhone;

        return $this;
    }

    public function getMobilePhone(): ?string
    {
        return $this->mobilePhone;
    }

    protected function setMobilePhoneE164(?string $mobilePhoneE164 = null): static
    {
        if (!is_null($mobilePhoneE164)) {
            Assertion::maxLength($mobilePhoneE164, 25, 'mobilePhoneE164 value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->mobilePhoneE164 = $mobilePhoneE164;

        return $this;
    }

    public function getMobilePhoneE164(): ?string
    {
        return $this->mobilePhoneE164;
    }

    protected function setOtherPhone(?string $otherPhone = null): static
    {
        if (!is_null($otherPhone)) {
            Assertion::maxLength($otherPhone, 25, 'otherPhone value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->otherPhone = $otherPhone;

        return $this;
    }

    public function getOtherPhone(): ?string
    {
        return $this->otherPhone;
    }

    public function setUser(?UserInterface $user = null): static
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    public function setCompany(CompanyInterface $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }

    protected function setWorkPhoneCountry(?CountryInterface $workPhoneCountry = null): static
    {
        $this->workPhoneCountry = $workPhoneCountry;

        return $this;
    }

    public function getWorkPhoneCountry(): ?CountryInterface
    {
        return $this->workPhoneCountry;
    }

    protected function setMobilePhoneCountry(?CountryInterface $mobilePhoneCountry = null): static
    {
        $this->mobilePhoneCountry = $mobilePhoneCountry;

        return $this;
    }

    public function getMobilePhoneCountry(): ?CountryInterface
    {
        return $this->mobilePhoneCountry;
    }
}
