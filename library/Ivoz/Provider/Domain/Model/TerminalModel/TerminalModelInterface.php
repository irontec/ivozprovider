<?php

namespace Ivoz\Provider\Domain\Model\TerminalModel;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\TerminalManufacturer\TerminalManufacturerInterface;

/**
* TerminalModelInterface
*/
interface TerminalModelInterface extends LoggableEntityInterface
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
     * {@inheritDoc}
     */
    public function setIden(string $iden): static;

    /**
     * {@inheritdoc}
     */
    public function setGenericTemplate(?string $genericTemplate = null): static;

    /**
     * {@inheritdoc}
     */
    public function setSpecificTemplate(?string $specificTemplate = null): static;

    public static function createDto(string|int|null $id = null): TerminalModelDto;

    /**
     * @internal use EntityTools instead
     * @param null|TerminalModelInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TerminalModelDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TerminalModelDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TerminalModelDto;

    public function getIden(): string;

    public function getName(): string;

    public function getDescription(): string;

    public function getGenericTemplate(): ?string;

    public function getSpecificTemplate(): ?string;

    public function getGenericUrlPattern(): ?string;

    public function getSpecificUrlPattern(): ?string;

    public function getTerminalManufacturer(): TerminalManufacturerInterface;
}
