<?php

namespace Ivoz\Provider\Domain\Model\InvoiceNumberSequence;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;

/**
* InvoiceNumberSequenceInterface
*/
interface InvoiceNumberSequenceInterface extends LoggableEntityInterface
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
     * Update and return latest value
     *
     * @return string
     */
    public function nextval(): ?string;

    public static function createDto(string|int|null $id = null): InvoiceNumberSequenceDto;

    /**
     * @internal use EntityTools instead
     * @param null|InvoiceNumberSequenceInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?InvoiceNumberSequenceDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param InvoiceNumberSequenceDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): InvoiceNumberSequenceDto;

    public function getName(): string;

    public function getPrefix(): string;

    public function getSequenceLength(): int;

    public function getIncrement(): int;

    public function getLatestValue(): ?string;

    public function getIteration(): int;

    public function getVersion(): int;

    public function getBrand(): BrandInterface;
}
