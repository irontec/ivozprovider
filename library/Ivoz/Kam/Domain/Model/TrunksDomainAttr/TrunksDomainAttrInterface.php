<?php

namespace Ivoz\Kam\Domain\Model\TrunksDomainAttr;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* TrunksDomainAttrInterface
*/
interface TrunksDomainAttrInterface extends EntityInterface
{
    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    public static function createDto(string|int|null $id = null): TrunksDomainAttrDto;

    /**
     * @internal use EntityTools instead
     * @param null|TrunksDomainAttrInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TrunksDomainAttrDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TrunksDomainAttrDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TrunksDomainAttrDto;

    public function getDid(): string;

    public function getName(): string;

    public function getType(): int;

    public function getValue(): string;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getLastModified(): \DateTimeInterface;

    public function isInitialized(): bool;
}
