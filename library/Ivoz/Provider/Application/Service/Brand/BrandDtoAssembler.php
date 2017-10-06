<?php

namespace Ivoz\Provider\Application\Service\Brand;

use Ivoz\Core\Application\Service\StoragePathResolver;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\DtoAssemblerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandDTO;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Assert\Assertion;

class BrandDtoAssembler implements DtoAssemblerInterface
{
    protected $logoPathResolver;

    public function __construct(
        string $localStoragePath
    ) {
        $this->logoPathResolver = new StoragePathResolver(
            $localStoragePath,
            'ivozprovider_model_brands.logo'
        );
    }

    public function toDTO(EntityInterface $entity)
    {
        Assertion::isInstanceOf($entity, BrandInterface::class);

        /**
         * @var BrandDTO $dto
         */
        $dto = $entity->toDTO();
        $id = $entity->getId();

        if (!$id) {
            return $dto;
        }

        $dto->setLogoPath(
            $this->logoPathResolver->getFilePath($id)
        );

        return $dto;
    }
}