<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\CompanyRelGeoIPCountry;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var CompanyInterface | null
     * inversedBy relCountries
     */
    protected $company;

    /**
     * @var CountryInterface
     */
    protected $country;

    /**
     * Constructor
     */
    protected function __construct(

    ) {

    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "CompanyRelGeoIPCountry",
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
     * @return CompanyRelGeoIPCountryDto
     */
    public static function createDto($id = null)
    {
        return new CompanyRelGeoIPCountryDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param CompanyRelGeoIPCountryInterface|null $entity
     * @param int $depth
     * @return CompanyRelGeoIPCountryDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var CompanyRelGeoIPCountryDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CompanyRelGeoIPCountryDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CompanyRelGeoIPCountryDto::class);

        $self = new static(

        );

        $self
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCountry($fkTransformer->transform($dto->getCountry()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CompanyRelGeoIPCountryDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CompanyRelGeoIPCountryDto::class);

        $this
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCountry($fkTransformer->transform($dto->getCountry()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return CompanyRelGeoIPCountryDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setCountry(Country::entityToDto(self::getCountry(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'countryId' => self::getCountry()->getId()
        ];
    }

    public function setCompany(?CompanyInterface $company = null): static
    {
        $this->company = $company;

        /** @var  $this */
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
