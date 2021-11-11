<?php

namespace Ivoz\Cgr\Domain\Model\TpDestination;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Destination\DestinationInterface;

/**
* TpDestinationInterface
*/
interface TpDestinationInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): TpDestinationDto;

    /**
     * @internal use EntityTools instead
     * @param null|TpDestinationInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TpDestinationDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TpDestinationDto;

    public function getTpid(): string;

    public function getTag(): ?string;

    public function getPrefix(): string;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeInterface;

    public function setDestination(DestinationInterface $destination): static;

    public function getDestination(): DestinationInterface;

    public function isInitialized(): bool;
}
