<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\CompanyRelGeoIPCountry;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Country\Country;

/**
* CompanyRelGeoIPCountryAbstract
* @codeCoverageIgnore
*/
abstract class CompanyRelGeoIPCountryAbstract
{
    use ChangelogTrait;

    /**
     * @var ?CompanyInterface
     * inversedBy relCountries
     */
    protected $company = null;

    /**
     * @var CountryInterface
     */
    protected $country;

    /**
     * Constructor
     */
    protected function __construct()
    {
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "CompanyRelGeoIPCountry",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): CompanyRelGeoIPCountryDto
    {
        return new CompanyRelGeoIPCountryDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|CompanyRelGeoIPCountryInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CompanyRelGeoIPCountryDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CompanyRelGeoIPCountryInterface::class);

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
     * @param CompanyRelGeoIPCountryDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CompanyRelGeoIPCountryDto::class);
        $country = $dto->getCountry();
        Assertion::notNull($country, 'getCountry value is null, but non null value was expected.');

        $self = new static();

        $self
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCountry($fkTransformer->transform($country));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CompanyRelGeoIPCountryDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CompanyRelGeoIPCountryDto::class);

        $country = $dto->getCountry();
        Assertion::notNull($country, 'getCountry value is null, but non null value was expected.');

        $this
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCountry($fkTransformer->transform($country));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CompanyRelGeoIPCountryDto
    {
        return self::createDto()
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setCountry(Country::entityToDto(self::getCountry(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'companyId' => self::getCompany()?->getId(),
            'countryId' => self::getCountry()->getId()
        ];
    }

    public function setCompany(?CompanyInterface $company = null): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyInterface
    {
        return $this->company;
    }

    protected function setCountry(CountryInterface $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getCountry(): CountryInterface
    {
        return $this->country;
    }
}
