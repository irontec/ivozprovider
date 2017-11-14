<?php

namespace Ivoz\Provider\Application\Service\Brand;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\Assembler\CustomEntityAssemblerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Assert\Assertion;
use Ivoz\Core\Application\Service\Traits\FileContainerEntityAssemblerTrait;


class BrandAssembler implements CustomEntityAssemblerInterface
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
    public function fromDTO(DataTransferObjectInterface $dto, EntityInterface $entity)
    {
        Assertion::isInstanceOf($entity, BrandInterface::class);
        $entity->updateFromDTO($dto);
        $this->handleEntityFiles($entity, $dto);
    }
}