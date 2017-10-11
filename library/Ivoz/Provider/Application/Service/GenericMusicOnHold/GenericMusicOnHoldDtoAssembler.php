<?php

namespace Ivoz\Provider\Application\Service\GenericMusicOnHold;

use Ivoz\Core\Application\Service\StoragePathResolver;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\DtoAssemblerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandDTO;
use Assert\Assertion;
use Ivoz\Provider\Domain\Model\GenericMusicOnHold\GenericMusicOnHoldInterface;

class GenericMusicOnHoldDtoAssembler implements DtoAssemblerInterface
{
    protected $originalFilePathResolver;
    protected $encodedFilePathResolver;

    public function __construct(
        string $localStoragePath,
        string $originalBasePath,
        string $encodedBasePath
    ) {
        $this->originalFilePathResolver = new StoragePathResolver(
            $localStoragePath,
            $originalBasePath,
            true
        );

        $this->encodedFilePathResolver = new StoragePathResolver(
            $localStoragePath,
            $encodedBasePath,
            true
        );
    }

    public function toDTO(EntityInterface $entity)
    {
        Assertion::isInstanceOf($entity, GenericMusicOnHoldInterface::class);

        /** @var BrandDTO $dto */
        $dto = $entity->toDTO();
        $id = $entity->getId();

        if (!$id) {
            return $dto;
        }

        $dto->setOriginalFilePath(
            $this->originalFilePathResolver->getFilePath($id)
        );

        $dto->setEncodedFilePath(
            $this->encodedFilePathResolver->getFilePath($id)
        );

        return $dto;
    }
}