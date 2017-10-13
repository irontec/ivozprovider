<?php

namespace Ivoz\Provider\Application\Service\GenericMusicOnHold;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\CustomEntityAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Assert\Assertion;
use Ivoz\Core\Application\Service\Traits\FileContainerEntityAssemblerTrait;
use Ivoz\Provider\Domain\Model\GenericMusicOnHold\GenericMusicOnHoldInterface;

class GenericMusicOnHoldAssembler implements CustomEntityAssemblerInterface
{
    use FileContainerEntityAssemblerTrait;

    public function __construct(
        string $localStoragePath,
        string $originalBasePath,
        string $encodedBasePath
    ) {
        $originalFilePathResolver = new StoragePathResolver(
            $localStoragePath,
            $originalBasePath
        );

        $this->setPathResolver(
            'originalFile',
            $originalFilePathResolver
        );

        $encodedFilePathResolver = new StoragePathResolver(
            $localStoragePath,
            $encodedBasePath
        );

        $this->setPathResolver(
            'encodedFile',
            $encodedFilePathResolver
        );
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @param EntityInterface $entity
     */
    public function fromDTO(DataTransferObjectInterface $dto, EntityInterface $entity)
    {
        Assertion::isInstanceOf($entity, GenericMusicOnHoldInterface::class);
        $entity->updateFromDTO($dto);
        $this->handleEntityFiles($entity, $dto);
    }
}