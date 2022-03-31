<?php

namespace Ivoz\Provider\Domain\Model\VoicemailMessage;

class VoicemailMessageDto extends VoicemailMessageDtoAbstract
{
    /** @var ?string */
    private $recordingFilePath;

    /** @var ?string */
    private $metadataFilePath;

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'folder' => 'folder',
                'calldate' => 'calldate',
                'caller' => 'caller',
                'duration' => 'duration',
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }

    /**
     * @return self
     */
    public function setRecordingFilePath(string $path)
    {
        $this->recordingFilePath = $path;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getRecordingFilePath()
    {
        return $this->recordingFilePath;
    }

    /**
     * @return self
     */
    public function setMetadataFilePath(string $path)
    {
        $this->metadataFilePath = $path;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getMetadataFilePath()
    {
        return $this->metadataFilePath;
    }

    /**
     * @return string[]
     *
     * @psalm-return array{0: string, 1: string}
     */
    public function getFileObjects(): array
    {
        return [
            'recordingFile',
            'metadataFile',
        ];
    }
}
