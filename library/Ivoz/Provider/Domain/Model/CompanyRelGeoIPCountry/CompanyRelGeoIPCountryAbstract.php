<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelGeoIPCountry;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * CompanyRelGeoIPCountryAbstract
 * @codeCoverageIgnore
 */
abstract class CompanyRelGeoIPCountryAbstract
{
    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    protected $country;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct()
    {
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
     * @param null $id
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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CompanyRelGeoIPCountryDto::class);

        $self = new static();

        $self
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCountry($fkTransformer->transform($dto->getCountry()))
        ;

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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setCountry(\Ivoz\Provider\Domain\Model\Country\Country::entityToDto(self::getCountry(), $depth));
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
    // @codeCoverageIgnoreStart

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company | null
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set country
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $country
     *
     * @return static
     */
    protected function setCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getCountry()
    {
        return $this->country;
    }

    // @codeCoverageIgnoreEnd
}
