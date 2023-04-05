<?php

namespace Ivoz\Provider\Domain\Model\FeaturesRelCompany;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Feature\FeatureInterface;

/**
* FeaturesRelCompanyInterface
*/
interface FeaturesRelCompanyInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): FeaturesRelCompanyDto;

    /**
     * @internal use EntityTools instead
     * @param null|FeaturesRelCompanyInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?FeaturesRelCompanyDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param FeaturesRelCompanyDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): FeaturesRelCompanyDto;

    public function setCompany(?CompanyInterface $company = null): static;

    public function getCompany(): ?CompanyInterface;

    public function getFeature(): FeatureInterface;
}
