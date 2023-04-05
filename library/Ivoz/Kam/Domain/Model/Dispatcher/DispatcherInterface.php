<?php

namespace Ivoz\Kam\Domain\Model\Dispatcher;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface;

/**
* DispatcherInterface
*/
interface DispatcherInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): DispatcherDto;

    /**
     * @internal use EntityTools instead
     * @param null|DispatcherInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?DispatcherDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DispatcherDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): DispatcherDto;

    public function getSetid(): int;

    public function getDestination(): string;

    public function getFlags(): int;

    public function getPriority(): int;

    public function getAttrs(): string;

    public function getDescription(): string;

    public function getApplicationServer(): ApplicationServerInterface;
}
