<?php

namespace Ivoz\Provider\Domain\Model\VoicemailMessage;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Core\Domain\Service\TempFile;

/**
* VoicemailMessageInterface
*/
interface VoicemailMessageInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     */
    public function getId(): ?int;

    public static function createDto(string|int|null $id = null): VoicemailMessageDto;

    /**
     * @internal use EntityTools instead
     * @param null|VoicemailMessageInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?VoicemailMessageDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param VoicemailMessageDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): VoicemailMessageDto;

    public function getCalldate(): \DateTime;

    public function getFolder(): string;

    public function getCaller(): ?string;

    public function getDuration(): ?int;

    public function getRecordingFile(): RecordingFile;

    public function getMetadataFile(): MetadataFile;

    public function getVoicemail(): ?VoicemailInterface;

    public function getAstVoicemailMessage(): ?\Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessageInterface;

    public function isInitialized(): bool;
}
