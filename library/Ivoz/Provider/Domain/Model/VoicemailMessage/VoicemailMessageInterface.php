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
interface VoicemailMessageInterface extends LoggableEntityInterface, FileContainerInterface
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

    /**
     * @return array
     */
    public function getFileObjects(?int $filter = null): array;

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

    /**
     * @return void
     */
    public function addTmpFile(string $fldName, TempFile $file);

    /**
     * @throws \Exception
     * @return void
     */
    public function removeTmpFile(TempFile $file);

    /**
     * @return \Ivoz\Core\Domain\Service\TempFile[]
     */
    public function getTempFiles();

    /**
     * @var string $fldName
     * @return null | \Ivoz\Core\Domain\Service\TempFile
     */
    public function getTempFileByFieldName($fldName);
}
