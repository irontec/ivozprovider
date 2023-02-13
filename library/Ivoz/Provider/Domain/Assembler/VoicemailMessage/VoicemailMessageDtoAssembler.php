<?php

namespace Ivoz\Provider\Domain\Assembler\VoicemailMessage;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\VoicemailMessage\VoicemailMessageInterface;

class VoicemailMessageDtoAssembler implements CustomDtoAssemblerInterface
{
    public function __construct(
        private StoragePathResolverCollection $storagePathResolver
    ) {
    }

    /**
     * @param VoicemailMessageInterface $voicemailMessage
     * @throws \Exception
     */
    public function toDto(EntityInterface $voicemailMessage, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($voicemailMessage, VoicemailMessageInterface::class);

        $dto = $voicemailMessage->toDto($depth);
        $id = $voicemailMessage->getId();

        if (!$id) {
            return $dto;
        }

        /* RecordingFile */
        $pathResolver = $this
            ->storagePathResolver
            ->getPathResolver('RecordingFile');

        $pathResolver->setOriginalFileName(
            $voicemailMessage->getRecordingFile()->getBaseName()
        );

        $dto->setRecordingFilePath(
            $pathResolver->getFilePath($voicemailMessage)
        );

        /* MetadataFile */
        $pathResolver = $this
            ->storagePathResolver
            ->getPathResolver('MetadataFile');

        $pathResolver->setOriginalFileName(
            $voicemailMessage->getMetadataFile()->getBaseName()
        );

        $dto->setMetadataFilePath(
            $pathResolver->getFilePath($voicemailMessage)
        );

        return $dto;
    }
}
