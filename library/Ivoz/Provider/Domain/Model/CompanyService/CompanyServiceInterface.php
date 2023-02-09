<?php

namespace Ivoz\Provider\Domain\Model\CompanyService;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Service\ServiceInterface;

/**
* CompanyServiceInterface
*/
interface CompanyServiceInterface extends LoggableEntityInterface
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

    /**
     * {@inheritDoc}
     */
    public function setCode(string $code): static;

    public static function createDto(string|int|null $id = null): CompanyServiceDto;

    /**
     * @internal use EntityTools instead
     * @param null|CompanyServiceInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CompanyServiceDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CompanyServiceDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CompanyServiceDto;

    public function getCode(): string;

    public function setCompany(CompanyInterface $company): static;

    public function getCompany(): CompanyInterface;

    public function getService(): ServiceInterface;

    public function isInitialized(): bool;
}
