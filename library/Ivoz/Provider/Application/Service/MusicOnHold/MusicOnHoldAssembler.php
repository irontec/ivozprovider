<?php

namespace Ivoz\Provider\Application\Service\MusicOnHold;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\CustomEntityAssemblerInterface;
use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Application\Service\Traits\FileContainerEntityAssemblerTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Assert\Assertion;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface;

class MusicOnHoldAssembler implements CustomEntityAssemblerInterface
{
    use FileContainerEntityAssemblerTrait;

    public function __construct(
        StoragePathResolverCollection $storagePathResolver
    ) {
        $this->storagePathResolver = $storagePathResolver;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @param EntityInterface $entity
     */
    public function fromDto(
        DataTransferObjectInterface $dto,
        EntityInterface $entity,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($entity, MusicOnHoldInterface::class);
        $entity->updateFromDto($dto, $fkTransformer);
        $this->handleEntityFiles($entity, $dto, $fkTransformer);
    }
}
