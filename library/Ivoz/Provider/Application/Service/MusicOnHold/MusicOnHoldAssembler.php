<?php

namespace Ivoz\Provider\Application\Service\MusicOnHold;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\CustomEntityAssemblerInterface;
use Ivoz\Core\Application\Service\Traits\FileContainerEntityAssemblerTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Assert\Assertion;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface;
use Ivoz\Provider\Application\Service\GenericMusicOnHold\StoragePathResolver;

class MusicOnHoldAssembler implements CustomEntityAssemblerInterface
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
            'OriginalFile',
            $originalFilePathResolver
        );

        $encodedFilePathResolver = new StoragePathResolver(
            $localStoragePath,
            $encodedBasePath
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
        Assertion::isInstanceOf($entity, MusicOnHoldInterface::class);
        $entity->updateFromDTO($dto);
        $this->handleEntityFiles($entity, $dto);
    }
}