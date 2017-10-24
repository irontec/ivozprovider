<?php

namespace Ivoz\Provider\Application\Service\Locution;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\Assembler\CustomEntityAssemblerInterface;
use Assert\Assertion;
use Ivoz\Core\Application\Service\Traits\FileContainerEntityAssemblerTrait;
use Ivoz\Core\Application\Service\CommonStoragePathResolver;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;


class LocutionAssembler implements CustomEntityAssemblerInterface
{
    use FileContainerEntityAssemblerTrait;

    /**
     * LocutionAssembler constructor.
     * @param string $localStoragePath
     * @param string $originalFileBasePath
     * @param string $encodedFileBasePath
     */
    public function __construct(
        string $localStoragePath,
        string $originalFileBasePath,
        string $encodedFileBasePath
    ) {
        $originalFilePathResolver = new CommonStoragePathResolver(
            $localStoragePath,
            $originalFileBasePath,
            false,
            true
        );

        $this->setPathResolver(
            'OriginalFile',
            $originalFilePathResolver
        );

        $encodedFilePathResolver = new CommonStoragePathResolver(
            $localStoragePath,
            $originalFileBasePath,
            false,
            true
        );

        $this->setPathResolver(
            'EncodedFile',
            $encodedFilePathResolver
        );
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @param EntityInterface $entity
     */
    public function fromDTO(DataTransferObjectInterface $dto, EntityInterface $entity)
    {
        Assertion::isInstanceOf($entity, LocutionInterface::class);
        $entity->updateFromDTO($dto);
        $this->handleEntityFiles($entity, $dto);
    }
}