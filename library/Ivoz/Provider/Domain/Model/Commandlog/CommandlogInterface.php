<?php

namespace Ivoz\Provider\Domain\Model\Commandlog;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Event\CommandEventInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* CommandlogInterface
*/
interface CommandlogInterface extends EntityInterface
{
    /**
     * Get id
     * @codeCoverageIgnore
     * @return string
     */
    public function getId(): ?string;

    /**
     * @param \Ivoz\Core\Application\Event\CommandEventInterface $event
     * @return self
     */
    public static function fromEvent(CommandEventInterface $event);

    public static function createDto(string|int|null $id = null): CommandlogDto;

    /**
     * @internal use EntityTools instead
     * @param null|CommandlogInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CommandlogDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CommandlogDto;

    public function getRequestId(): string;

    public function getClass(): string;

    public function getMethod(): ?string;

    public function getArguments(): ?array;

    public function getAgent(): ?array;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getCreatedOn(): \DateTimeInterface;

    public function getMicrotime(): int;

    public function isInitialized(): bool;
}
