<?php

namespace Ivoz\Provider\Application\Service\DestinationRateGroup;

use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\Assembler\CustomEntityAssemblerInterface;
use Assert\Assertion;
use Ivoz\Core\Application\Service\Traits\FileContainerEntityAssemblerTrait;

class DestinationRateGroupAssembler implements CustomEntityAssemblerInterface
{
    use FileContainerEntityAssemblerTrait;

    /**
     * DestinationRateGroupAssembler constructor.
     *
     * @param StoragePathResolverCollection $storagePathResolver
     */
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
        Assertion::isInstanceOf($entity, DestinationRateGroupInterface::class);
        $entity->updateFromDto($dto, $fkTransformer);
        $this->handleEntityFiles($entity, $dto, $fkTransformer);
    }
}
