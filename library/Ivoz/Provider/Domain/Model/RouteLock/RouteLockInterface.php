<?php

namespace Ivoz\Provider\Domain\Model\RouteLock;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
* RouteLockInterface
*/
interface RouteLockInterface extends LoggableEntityInterface
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
     * Return in current lock status is open
     *
     * @return boolean
     */
    public function isOpen();

    public static function createDto(string|int|null $id = null): RouteLockDto;

    /**
     * @internal use EntityTools instead
     * @param null|RouteLockInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?RouteLockDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): RouteLockDto;

    public function getName(): string;

    public function getDescription(): string;

    public function getOpen(): bool;

    public function getCompany(): CompanyInterface;

    public function isInitialized(): bool;
}
