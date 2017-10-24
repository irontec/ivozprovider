<?php

namespace Ivoz\Provider\Application\Service\Brand;

use Ivoz\Core\Application\Service\CommonStoragePathResolver;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandDTO;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Assert\Assertion;

class BrandDtoAssembler implements CustomDtoAssemblerInterface
{
    protected $logoPathResolver;

    public function __construct(
        string $localStoragePath,
        string $basePath
    ) {
        $this->logoPathResolver = new CommonStoragePathResolver(
            $localStoragePath,
            $basePath
        );
    }

    public function toDTO(EntityInterface $entity)
    {
        Assertion::isInstanceOf($entity, BrandInterface::class);

        /** @var BrandDTO $dto */
        $dto = $entity->toDTO();
        $id = $entity->getId();

        if (!$id) {
            return $dto;
        }

        $dto->setLogoPath(
            $this->logoPathResolver->getFilePath($entity)
        );

        return $dto;
    }
}