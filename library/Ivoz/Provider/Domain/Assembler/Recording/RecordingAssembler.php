<?php

namespace Ivoz\Provider\Domain\Assembler\Recording;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomEntityAssemblerInterface;
use Ivoz\Core\Domain\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Service\Traits\FileContainerEntityAssemblerTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Recording\RecordingInterface;

class RecordingAssembler implements CustomEntityAssemblerInterface
{
    use FileContainerEntityAssemblerTrait;

    public function __construct(
        StoragePathResolverCollection $storagePathResolver
    ) {
        $this->storagePathResolver = $storagePathResolver;
    }

    /**
     * @return void
     */
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
