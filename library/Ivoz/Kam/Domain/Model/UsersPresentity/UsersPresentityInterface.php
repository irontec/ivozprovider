<?php

namespace Ivoz\Kam\Domain\Model\UsersPresentity;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* UsersPresentityInterface
*/
interface UsersPresentityInterface extends EntityInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId(): ?int;

    public static function createDto(string|int|null $id = null): UsersPresentityDto;

    /**
     * @internal use EntityTools instead
     * @param null|UsersPresentityInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?UsersPresentityDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UsersPresentityDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): UsersPresentityDto;

    public function getUsername(): string;

    public function getDomain(): string;

    public function getEvent(): string;

    public function getEtag(): string;

    public function getExpires(): int;

    public function getReceivedTime(): int;

    public function getBody(): string;

    public function getSender(): string;

    public function getPriority(): int;

    public function getRuid(): ?string;

    public function isInitialized(): bool;
}
