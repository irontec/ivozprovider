<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelGeoIPCountry;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;

/**
* CompanyRelGeoIPCountryInterface
*/
interface CompanyRelGeoIPCountryInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    public static function createDto(string|int|null $id = null): CompanyRelGeoIPCountryDto;

    /**
     * @internal use EntityTools instead
     * @param null|CompanyRelGeoIPCountryInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CompanyRelGeoIPCountryDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CompanyRelGeoIPCountryDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CompanyRelGeoIPCountryDto;

    public function setCompany(?CompanyInterface $company = null): static;

    public function getCompany(): ?CompanyInterface;

    public function getCountry(): CountryInterface;
}
