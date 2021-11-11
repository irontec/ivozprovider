<?php

namespace Ivoz\Provider\Domain\Model\Codec;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* CodecInterface
*/
interface CodecInterface extends LoggableEntityInterface
{
    public const TYPE_AUDIO = 'audio';

    public const TYPE_VIDEO = 'video';

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

    public static function createDto(string|int|null $id = null): CodecDto;

    /**
     * @internal use EntityTools instead
     * @param null|CodecInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CodecDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CodecDto;

    public function getType(): string;

    public function getIden(): string;

    public function getName(): string;

    public function isInitialized(): bool;
}
