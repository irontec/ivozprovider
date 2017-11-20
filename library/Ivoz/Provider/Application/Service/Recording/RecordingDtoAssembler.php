<?php

namespace Ivoz\Provider\Application\Service\Recording;

use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Provider\Domain\Model\Recording\RecordingDTO;
use Ivoz\Provider\Domain\Model\Recording\RecordingInterface;
use Assert\Assertion;

class RecordingDtoAssembler implements CustomDtoAssemblerInterface
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
     * @param RecordingInterface $entity
     * @return RecordingDTO
     */
    public function toDTO(EntityInterface $entity)
    {
        Assertion::isInstanceOf($entity, RecordingInterface::class);

        /** @var RecordingDTO $dto */
        $dto = $entity->toDTO();
        $id = $entity->getId();

        if (!$id) {
            return $dto;
        }

        if ($entity->getRecordedFile()->getFileSize()) {
            $pathResolver = $this
                ->storagePathResolver
                ->getPathResolver('RecordedFile');

            $dto->setRecordedFilePath(
                $pathResolver->getFilePath($entity)
            );
        }

        return $dto;
    }
}