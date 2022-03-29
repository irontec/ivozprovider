<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\VoicemailMessage;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\VoicemailMessage\RecordingFile;
use Ivoz\Provider\Domain\Model\VoicemailMessage\MetadataFile;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\Voicemail\Voicemail;
use Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessage;

/**
* VoicemailMessageAbstract
* @codeCoverageIgnore
*/
abstract class VoicemailMessageAbstract
{
    use ChangelogTrait;

    /**
     * @var \DateTime
     */
    protected $calldate;

    /**
     * @var string
     */
    protected $folder;

    /**
     * @var ?string
     */
    protected $caller = null;

    /**
     * @var ?int
     */
    protected $duration = null;

    /**
     * @var RecordingFile
     */
    protected $recordingFile;

    /**
     * @var MetadataFile
     */
    protected $metadataFile;

    /**
     * @var ?VoicemailInterface
     */
    protected $voicemail = null;

    /**
     * @var ?\Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessageInterface
     */
    protected $astVoicemailMessage = null;

    /**
     * Constructor
     */
    protected function __construct(
        \DateTimeInterface|string $calldate,
        string $folder,
        RecordingFile $recordingFile,
        MetadataFile $metadataFile
    ) {
        $this->setCalldate($calldate);
        $this->setFolder($folder);
        $this->recordingFile = $recordingFile;
        $this->metadataFile = $metadataFile;
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "VoicemailMessage",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): VoicemailMessageDto
    {
        return new VoicemailMessageDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|VoicemailMessageInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?VoicemailMessageDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, VoicemailMessageInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param VoicemailMessageDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, VoicemailMessageDto::class);
        $calldate = $dto->getCalldate();
        Assertion::notNull($calldate, 'getCalldate value is null, but non null value was expected.');
        $folder = $dto->getFolder();
        Assertion::notNull($folder, 'getFolder value is null, but non null value was expected.');

        $recordingFile = new RecordingFile(
            $dto->getRecordingFileFileSize(),
            $dto->getRecordingFileMimeType(),
            $dto->getRecordingFileBaseName()
        );

        $metadataFile = new MetadataFile(
            $dto->getMetadataFileFileSize(),
            $dto->getMetadataFileMimeType(),
            $dto->getMetadataFileBaseName()
        );

        $self = new static(
            $calldate,
            $folder,
            $recordingFile,
            $metadataFile
        );

        $self
            ->setCaller($dto->getCaller())
            ->setDuration($dto->getDuration())
            ->setVoicemail($fkTransformer->transform($dto->getVoicemail()))
            ->setAstVoicemailMessage($fkTransformer->transform($dto->getAstVoicemailMessage()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param VoicemailMessageDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, VoicemailMessageDto::class);

        $calldate = $dto->getCalldate();
        Assertion::notNull($calldate, 'getCalldate value is null, but non null value was expected.');
        $folder = $dto->getFolder();
        Assertion::notNull($folder, 'getFolder value is null, but non null value was expected.');

        $recordingFile = new RecordingFile(
            $dto->getRecordingFileFileSize(),
            $dto->getRecordingFileMimeType(),
            $dto->getRecordingFileBaseName()
        );

        $metadataFile = new MetadataFile(
            $dto->getMetadataFileFileSize(),
            $dto->getMetadataFileMimeType(),
            $dto->getMetadataFileBaseName()
        );

        $this
            ->setCalldate($calldate)
            ->setFolder($folder)
            ->setCaller($dto->getCaller())
            ->setDuration($dto->getDuration())
            ->setRecordingFile($recordingFile)
            ->setMetadataFile($metadataFile)
            ->setVoicemail($fkTransformer->transform($dto->getVoicemail()))
            ->setAstVoicemailMessage($fkTransformer->transform($dto->getAstVoicemailMessage()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): VoicemailMessageDto
    {
        return self::createDto()
            ->setCalldate(self::getCalldate())
            ->setFolder(self::getFolder())
            ->setCaller(self::getCaller())
            ->setDuration(self::getDuration())
            ->setRecordingFileFileSize(self::getRecordingFile()->getFileSize())
            ->setRecordingFileMimeType(self::getRecordingFile()->getMimeType())
            ->setRecordingFileBaseName(self::getRecordingFile()->getBaseName())
            ->setMetadataFileFileSize(self::getMetadataFile()->getFileSize())
            ->setMetadataFileMimeType(self::getMetadataFile()->getMimeType())
            ->setMetadataFileBaseName(self::getMetadataFile()->getBaseName())
            ->setVoicemail(Voicemail::entityToDto(self::getVoicemail(), $depth))
            ->setAstVoicemailMessage(VoicemailMessage::entityToDto(self::getAstVoicemailMessage(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'calldate' => self::getCalldate(),
            'folder' => self::getFolder(),
            'caller' => self::getCaller(),
            'duration' => self::getDuration(),
            'recordingFileFileSize' => self::getRecordingFile()->getFileSize(),
            'recordingFileMimeType' => self::getRecordingFile()->getMimeType(),
            'recordingFileBaseName' => self::getRecordingFile()->getBaseName(),
            'metadataFileFileSize' => self::getMetadataFile()->getFileSize(),
            'metadataFileMimeType' => self::getMetadataFile()->getMimeType(),
            'metadataFileBaseName' => self::getMetadataFile()->getBaseName(),
            'voicemailId' => self::getVoicemail()?->getId(),
            'astVoicemailMessageId' => self::getAstVoicemailMessage()?->getId()
        ];
    }

    protected function setCalldate(string|\DateTimeInterface $calldate): static
    {

        /** @var \Datetime */
        $calldate = DateTimeHelper::createOrFix(
            $calldate,
            null
        );

        if ($this->isInitialized() && $this->calldate == $calldate) {
            return $this;
        }

        $this->calldate = $calldate;

        return $this;
    }

    public function getCalldate(): \DateTime
    {
        return clone $this->calldate;
    }

    protected function setFolder(string $folder): static
    {
        Assertion::maxLength($folder, 64, 'folder value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->folder = $folder;

        return $this;
    }

    public function getFolder(): string
    {
        return $this->folder;
    }

    protected function setCaller(?string $caller = null): static
    {
        if (!is_null($caller)) {
            Assertion::maxLength($caller, 128, 'caller value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->caller = $caller;

        return $this;
    }

    public function getCaller(): ?string
    {
        return $this->caller;
    }

    protected function setDuration(?int $duration = null): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function getRecordingFile(): RecordingFile
    {
        return $this->recordingFile;
    }

    protected function setRecordingFile(RecordingFile $recordingFile): static
    {
        $isEqual = $this->recordingFile->equals($recordingFile);
        if ($isEqual) {
            return $this;
        }

        $this->recordingFile = $recordingFile;
        return $this;
    }

    public function getMetadataFile(): MetadataFile
    {
        return $this->metadataFile;
    }

    protected function setMetadataFile(MetadataFile $metadataFile): static
    {
        $isEqual = $this->metadataFile->equals($metadataFile);
        if ($isEqual) {
            return $this;
        }

        $this->metadataFile = $metadataFile;
        return $this;
    }

    protected function setVoicemail(?VoicemailInterface $voicemail = null): static
    {
        $this->voicemail = $voicemail;

        return $this;
    }

    public function getVoicemail(): ?VoicemailInterface
    {
        return $this->voicemail;
    }

    protected function setAstVoicemailMessage(?\Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessageInterface $astVoicemailMessage = null): static
    {
        $this->astVoicemailMessage = $astVoicemailMessage;

        return $this;
    }

    public function getAstVoicemailMessage(): ?\Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessageInterface
    {
        return $this->astVoicemailMessage;
    }
}
