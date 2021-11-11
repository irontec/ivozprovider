<?php

namespace Ivoz\Provider\Domain\Model\ConferenceRoom;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
* ConferenceRoomInterface
*/
interface ConferenceRoomInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): ConferenceRoomDto;

    /**
     * @internal use EntityTools instead
     * @param null|ConferenceRoomInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ConferenceRoomDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ConferenceRoomDto;

    public function getName(): string;

    public function getPinProtected(): bool;

    public function getPinCode(): ?string;

    public function getMaxMembers(): int;

    public function getCompany(): CompanyInterface;

    public function isInitialized(): bool;
}
