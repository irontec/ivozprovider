<?php

namespace Ivoz\Provider\Domain\Model\IvrExcludedExtension;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;

/**
* IvrExcludedExtensionInterface
*/
interface IvrExcludedExtensionInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId(): ?int;

    public static function createDto(string|int|null $id = null): IvrExcludedExtensionDto;

    /**
     * @internal use EntityTools instead
     * @param null|IvrExcludedExtensionInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?IvrExcludedExtensionDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param IvrExcludedExtensionDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): IvrExcludedExtensionDto;

    public function setIvr(?IvrInterface $ivr = null): static;

    public function getIvr(): ?IvrInterface;

    public function getExtension(): ExtensionInterface;
}
