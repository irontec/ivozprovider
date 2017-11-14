<?php

namespace Ivoz\Provider\Application\Service\BrandUrl;

use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Provider\Domain\Model\BrandUrl\BrandUrlDTO;
use Ivoz\Provider\Domain\Model\BrandUrl\BrandUrlInterface;
use Assert\Assertion;

class BrandUrlDtoAssembler implements CustomDtoAssemblerInterface
{
    /**
     * @var StoragePathResolverCollection
     */
    protected $storagePathResolver;

    public function __construct(
        StoragePathResolverCollection $storagePathResolver
    ) {
        $this->storagePathResolver = $storagePathResolver;
    }


    /**
     * @param BrandUrlInterface $entity
     * @return BrandUrlDTO
     */
    public function toDTO(EntityInterface $entity)
    {
        Assertion::isInstanceOf($entity, BrandUrlInterface::class);

        /** @var BrandDTO $dto */
        $dto = $entity->toDTO();
        $id = $entity->getId();

        if (!$id) {
            return $dto;
        }

        if ($entity->getLogo()->getFileSize()) {
            $pathResolver = $this
                ->storagePathResolver
                ->getPathResolver('Logo');

            $dto->setLogoPath(
                $pathResolver->getFilePath($entity)
            );
        }

        return $dto;
    }
}