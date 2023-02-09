<?php

declare(strict_types=1);

namespace Ivoz\Ast\Domain\Model\VoicemailMessage;

class VoicemailMessage extends VoicemailMessageAbstract implements VoicemailMessageInterface
{
    use VoicemailMessageTrait;

    const VOICEMAIL_RECORDING_EXTENSION = "wav";

    const VOICEMAIL_METADATA_EXTENSION = "txt";

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVoicemailMessageFilePattern(): string
    {
        return sprintf(
            "msg%04d",
            $this->getMsgnum(),
        );
    }

    public function getRecordingFileBaseName(): string
    {
        return sprintf(
            "%s.%s",
            $this->getVoicemailMessageFilePattern(),
            self::VOICEMAIL_RECORDING_EXTENSION
        );
    }

    public function getRecordingFileName(): string
    {
        return sprintf(
            "%s/%s",
            $this->getDir(),
            $this->getRecordingFileBaseName()
        );
    }

    public function getMetadataFileBaseName(): string
    {
        return sprintf(
            "%s.%s",
            $this->getVoicemailMessageFilePattern(),
            self::VOICEMAIL_METADATA_EXTENSION
        );
    }

    public function getMetadataFileName(): string
    {
        return sprintf(
            "%s/%s",
            $this->getDir(),
            $this->getMetadataFileBaseName()
        );
    }
}
