<?php

namespace Ivoz\Provider\Domain\Model\RouteLock;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
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

    /**
     * Return the DeviceName used to create Hints
     */
    public function getHintDeviceName(): string;

    public static function createDto(string|int|null $id = null): RouteLockDto;

    /**
     * @internal use EntityTools instead
     * @param null|RouteLockInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?RouteLockDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RouteLockDto $dto
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
}
