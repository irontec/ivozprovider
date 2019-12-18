<?php

namespace Ivoz\Provider\Application\Service\Recording;

use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\Assembler\CustomEntityAssemblerInterface;
use Ivoz\Provider\Domain\Model\Recording\RecordingInterface;
use Assert\Assertion;
use Ivoz\Core\Application\Service\Traits\FileContainerEntityAssemblerTrait;

class RecordingAssembler implements CustomEntityAssemblerInterface
{
    use FileContainerEntityAssemblerTrait;

    public function __construct(
        StoragePathResolverCollection $storagePathResolver
    ) {
        $this->storagePathResolver = $storagePathResolver;
    }

    public function fromDto(
        DataTransferObjectInterface $recordingDto,
        EntityInterface $recording,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($recording, RecordingInterface::class);
        $recording->updateFromDto($recordingDto, $fkTransformer);
        $this->handleEntityFiles($recording, $recordingDto, $fkTransformer);
    }
}
