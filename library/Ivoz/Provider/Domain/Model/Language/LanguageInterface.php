<?php

namespace Ivoz\Provider\Domain\Model\Language;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* LanguageInterface
*/
interface LanguageInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): LanguageDto;

    /**
     * @internal use EntityTools instead
     * @param null|LanguageInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?LanguageDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param LanguageDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): LanguageDto;

    public function getIden(): string;

    public function getName(): Name;
}
