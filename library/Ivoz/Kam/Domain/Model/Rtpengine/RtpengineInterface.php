<?php

namespace Ivoz\Kam\Domain\Model\Rtpengine;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;

/**
* RtpengineInterface
*/
interface RtpengineInterface extends LoggableEntityInterface
{
    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    public function setMediaRelaySet(?MediaRelaySetInterface $mediaRelaySet = null): static;

    public static function createDto(string|int|null $id = null): RtpengineDto;

    /**
     * @internal use EntityTools instead
     * @param null|RtpengineInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?RtpengineDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RtpengineDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): RtpengineDto;

    public function getSetid(): int;

    public function getUrl(): string;

    public function getWeight(): int;

    public function getDisabled(): bool;

    public function getStamp(): \DateTime;

    public function getDescription(): ?string;

    public function getMediaRelaySet(): ?MediaRelaySetInterface;
}
