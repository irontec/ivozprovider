<?php

namespace Ivoz\Provider\Application\Service\Brand;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\StoragePathResolver;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\EntityAssemblerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Assert\Assertion;
use Ivoz\Core\Application\Service\Traits\FileContainerAssemblerEntityTrait;

class BrandAssembler implements EntityAssemblerInterface
{
    use FileContainerAssemblerEntityTrait;

    protected $logoPathResolver;

    public function __construct(
        string $localStoragePath,
        string $basePath
    ) {
        $this->logoPathResolver = new StoragePathResolver(
            $localStoragePath,
            $basePath
        );
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @param EntityInterface $entity
     */
    public function fromDTO(DataTransferObjectInterface $dto, EntityInterface $entity)
    {
        Assertion::isInstanceOf($entity, BrandInterface::class);
        $entity->updateFromDTO($dto);

        foreach ($entity->getFileObjects() as $objName) {
            $this->handleFile($dto, $entity, $objName);
        }
    }
}