<?php

namespace Ivoz\Provider\Application\Service\Locution;

use Ivoz\Core\Application\Service\CommonStoragePathResolver;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Assert\Assertion;
use Ivoz\Provider\Domain\Model\Locution\LocutionDTO;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;

class LocutionDtoAssembler implements CustomDtoAssemblerInterface
{
    /**
     * @var CommonStoragePathResolver
     */
    protected $originalFilePathResolver;

    /**
     * @var CommonStoragePathResolver
     */
    protected $encodedFilePathResolver;

    public function __construct(
        string $localStoragePath,
        string $originalFileBasePath,
        string $encodedFileBasePath
    ) {
        $this->originalFilePathResolver = new CommonStoragePathResolver(
            $localStoragePath,
            $originalFileBasePath,
            false,
            true
        );

        $this->encodedFilePathResolver = new CommonStoragePathResolver(
            $localStoragePath,
            $encodedFileBasePath,
            false,
            true
        );
    }

    /**
     * @param LocutionInterface $entity
     * @return LocutionDTO
     */
    public function toDTO(EntityInterface $entity)
    {
        Assertion::isInstanceOf($entity, LocutionInterface::class);

        /** @var LocutionDTO $dto */
        $dto = $entity->toDTO();
        $id = $entity->getId();

        if (!$id) {
            return $dto;
        }

        $this->originalFilePathResolver->setOriginalFileName(
            $entity->getOriginalFile()->getBaseName()
        );
        $dto->setOriginalFilepath(
            $this->originalFilePathResolver->getFilePath($entity)
        );

        $this->encodedFilePathResolver->setOriginalFileName(
            $entity->getEncodedFile()->getBaseName()
        );
        $dto->setEncodedFilepath(
            $this->encodedFilePathResolver->getFilePath($entity)
        );

        return $dto;
    }
}