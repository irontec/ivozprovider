<?php

namespace Ivoz\Provider\Domain\Model\VoicemailMessage;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailDto;
use Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessageDto;

/**
* VoicemailMessageDtoAbstract
* @codeCoverageIgnore
*/
abstract class VoicemailMessageDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var \DateTimeInterface|string|null
     */
    private $calldate = null;

    /**
     * @var string|null
     */
    private $folder = null;

    /**
     * @var string|null
     */
    private $caller = null;

    /**
     * @var int|null
     */
    private $duration = null;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var int|null
     */
    private $recordingFileFileSize = null;

    /**
     * @var string|null
     */
    private $recordingFileMimeType = null;

    /**
     * @var string|null
     */
    private $recordingFileBaseName = null;

    /**
     * @var int|null
     */
    private $metadataFileFileSize = null;

    /**
     * @var string|null
     */
    private $metadataFileMimeType = null;

    /**
     * @var string|null
     */
    private $metadataFileBaseName = null;

    /**
     * @var VoicemailDto | null
     */
    private $voicemail = null;

    /**
     * @var VoicemailMessageDto | null
     */
    private $astVoicemailMessage = null;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'calldate' => 'calldate',
            'folder' => 'folder',
            'caller' => 'caller',
            'duration' => 'duration',
            'id' => 'id',
            'recordingFile' => [
                'fileSize',
                'mimeType',
                'baseName',
            ],
            'metadataFile' => [
                'fileSize',
                'mimeType',
                'baseName',
            ],
            'voicemailId' => 'voicemail',
            'astVoicemailMessageId' => 'astVoicemailMessage'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'calldate' => $this->getCalldate(),
            'folder' => $this->getFolder(),
            'caller' => $this->getCaller(),
            'duration' => $this->getDuration(),
            'id' => $this->getId(),
            'recordingFile' => [
                'fileSize' => $this->getRecordingFileFileSize(),
                'mimeType' => $this->getRecordingFileMimeType(),
                'baseName' => $this->getRecordingFileBaseName(),
            ],
            'metadataFile' => [
                'fileSize' => $this->getMetadataFileFileSize(),
                'mimeType' => $this->getMetadataFileMimeType(),
                'baseName' => $this->getMetadataFileBaseName(),
            ],
            'voicemail' => $this->getVoicemail(),
            'astVoicemailMessage' => $this->getAstVoicemailMessage()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    public function setCalldate(\DateTimeInterface|string $calldate): static
    {
        $this->calldate = $calldate;

        return $this;
    }

    public function getCalldate(): \DateTimeInterface|string|null
    {
        return $this->calldate;
    }

    public function setFolder(string $folder): static
    {
        $this->folder = $folder;

        return $this;
    }

    public function getFolder(): ?string
    {
        return $this->folder;
    }

    public function setCaller(?string $caller): static
    {
        $this->caller = $caller;

        return $this;
    }

    public function getCaller(): ?string
    {
        return $this->caller;
    }

    public function setDuration(?int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setRecordingFileFileSize(?int $recordingFileFileSize): static
    {
        $this->recordingFileFileSize = $recordingFileFileSize;

        return $this;
    }

    public function getRecordingFileFileSize(): ?int
    {
        return $this->recordingFileFileSize;
    }

    public function setRecordingFileMimeType(?string $recordingFileMimeType): static
    {
        $this->recordingFileMimeType = $recordingFileMimeType;

        return $this;
    }

    public function getRecordingFileMimeType(): ?string
    {
        return $this->recordingFileMimeType;
    }

    public function setRecordingFileBaseName(?string $recordingFileBaseName): static
    {
        $this->recordingFileBaseName = $recordingFileBaseName;

        return $this;
    }

    public function getRecordingFileBaseName(): ?string
    {
        return $this->recordingFileBaseName;
    }

    public function setMetadataFileFileSize(?int $metadataFileFileSize): static
    {
        $this->metadataFileFileSize = $metadataFileFileSize;

        return $this;
    }

    public function getMetadataFileFileSize(): ?int
    {
        return $this->metadataFileFileSize;
    }

    public function setMetadataFileMimeType(?string $metadataFileMimeType): static
    {
        $this->metadataFileMimeType = $metadataFileMimeType;

        return $this;
    }

    public function getMetadataFileMimeType(): ?string
    {
        return $this->metadataFileMimeType;
    }

    public function setMetadataFileBaseName(?string $metadataFileBaseName): static
    {
        $this->metadataFileBaseName = $metadataFileBaseName;

        return $this;
    }

    public function getMetadataFileBaseName(): ?string
    {
        return $this->metadataFileBaseName;
    }

    public function setVoicemail(?VoicemailDto $voicemail): static
    {
        $this->voicemail = $voicemail;

        return $this;
    }

    public function getVoicemail(): ?VoicemailDto
    {
        return $this->voicemail;
    }

    public function setVoicemailId($id): static
    {
        $value = !is_null($id)
            ? new VoicemailDto($id)
            : null;

        return $this->setVoicemail($value);
    }

    public function getVoicemailId()
    {
        if ($dto = $this->getVoicemail()) {
            return $dto->getId();
        }

        return null;
    }

    public function setAstVoicemailMessage(?VoicemailMessageDto $astVoicemailMessage): static
    {
        $this->astVoicemailMessage = $astVoicemailMessage;

        return $this;
    }

    public function getAstVoicemailMessage(): ?VoicemailMessageDto
    {
        return $this->astVoicemailMessage;
    }

    public function setAstVoicemailMessageId($id): static
    {
        $value = !is_null($id)
            ? new VoicemailMessageDto($id)
            : null;

        return $this->setAstVoicemailMessage($value);
    }

    public function getAstVoicemailMessageId()
    {
        if ($dto = $this->getAstVoicemailMessage()) {
            return $dto->getId();
        }

        return null;
    }
}
