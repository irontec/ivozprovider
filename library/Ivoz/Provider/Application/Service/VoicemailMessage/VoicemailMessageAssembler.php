<?php

namespace Ivoz\Provider\Application\Service\VoicemailMessage;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\Service\Assembler\CustomEntityAssemblerInterface;
use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Application\Service\Traits\FileContainerEntityAssemblerTrait;
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
