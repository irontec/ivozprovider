<?php

namespace Ivoz\Provider\Application\Service\Recording;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Recording\RecordingDto;
use Ivoz\Provider\Domain\Model\Recording\RecordingInterface;

class RecordingDtoAssembler implements CustomDtoAssemblerInterface
{
    public function __construct(
        private StoragePathResolverCollection $storagePathResolver
    ) {
    }

    /**
     * @param RecordingInterface $recording
     * @throws \Exception
     */
    public function toDto(EntityInterface $recording, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($recording, RecordingInterface::class);

        /** @var RecordingDTO $dto */
        $dto = $recording->toDto($depth);
        $id = $recording->getId();

        if (!$id) {
            return $dto;
        }

        if ($recording->getRecordedFile()->getFileSize()) {
            $pathResolver = $this
                ->storagePathResolver
                ->getPathResolver('RecordedFile');

            $pathResolver->setOriginalFileName(
                $recording->getRecordedFile()->getBaseName()
            );

            $dto->setRecordedFilePath(
                $pathResolver->getFilePath($recording)
            );
        }

        return $dto;
    }
}
