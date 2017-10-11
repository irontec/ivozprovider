<?php

namespace Ivoz\Provider\Application\Service\GenericMusicOnHold;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\StoragePathResolver;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\EntityAssemblerInterface;
use Assert\Assertion;
use Ivoz\Core\Application\Service\Traits\FileContainerAssemblerEntityTrait;
use Ivoz\Provider\Domain\Model\GenericMusicOnHold\GenericMusicOnHoldInterface;

class GenericMusicOnHoldAssembler implements EntityAssemblerInterface
{
    use FileContainerAssemblerEntityTrait;

    public function __construct(
        string $localStoragePath,
        string $originalBasePath,
        string $encodedBasePath
    ) {
        $originalFilePathResolver = new StoragePathResolver(
            $localStoragePath,
            $originalBasePath,
            true
        );

        $this->setPathResolver(
            'originalFile',
            $originalFilePathResolver
        );

        $encodedFilePathResolver = new StoragePathResolver(
            $localStoragePath,
            $encodedBasePath,
            true
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