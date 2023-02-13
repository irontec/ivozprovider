<?php

namespace Ivoz\Provider\Domain\Assembler\VoicemailMessage;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomEntityAssemblerInterface;
use Ivoz\Core\Domain\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Service\Traits\FileContainerEntityAssemblerTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\VoicemailMessage\VoicemailMessageDto;
use Ivoz\Provider\Domain\Model\VoicemailMessage\VoicemailMessageInterface;

class VoicemailMessageAssembler implements CustomEntityAssemblerInterface
{
    use FileContainerEntityAssemblerTrait;

    public function __construct(
        StoragePathResolverCollection $storagePathResolver
    ) {
        $this->storagePathResolver = $storagePathResolver;
    }

    /**
     * @param VoicemailMessageDto $voicemailMessageDto
     * @param VoicemailMessageInterface $voicemailMessage
     * @param ForeignKeyTransformerInterface $fkTransformer
     * @return void
     * @throws \Assert\AssertionFailedException
     */
    public function fromDto(
        DataTransferObjectInterface $voicemailMessageDto,
        EntityInterface $voicemailMessage,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($voicemailMessage, VoicemailMessageInterface::class);
        $voicemailMessage->updateFromDto($voicemailMessageDto, $fkTransformer);
        $this->handleEntityFiles($voicemailMessage, $voicemailMessageDto, $fkTransformer);
    }
}
