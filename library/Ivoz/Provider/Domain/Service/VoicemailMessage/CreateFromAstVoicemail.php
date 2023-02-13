<?php

namespace Ivoz\Provider\Domain\Service\VoicemailMessage;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessageInterface as AstVoicemailMessageInterface;
use Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessageDto as AstVoicemailMessageDto;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailDto;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\VoicemailMessage\VoicemailMessage;
use Ivoz\Provider\Domain\Model\VoicemailMessage\VoicemailMessageInterface;

class CreateFromAstVoicemail
{
    public function __construct(
        private EntityTools $entityTools,
    ) {
    }

    /**
     * @param AstVoicemailMessageInterface $astVoicemailMessage
     * @param VoicemailInterface $voicemail
     * @return VoicemailMessageInterface
     */
    public function execute(
        AstVoicemailMessageInterface $astVoicemailMessage,
        VoicemailInterface $voicemail
    ) {
        $voicemailMessageDto = VoicemailMessage::createDto();

        /** @var AstVoicemailMessageDto $astVoicemailMessageDto */
        $astVoicemailMessageDto = $this->entityTools->entityToDto(
            $astVoicemailMessage
        );

        /** @var VoicemailDto $voicemailDto */
        $voicemailDto = $this->entityTools->entityToDto(
            $voicemail
        );

        $calldate = new \DateTime();
        $calldate->setTimestamp($astVoicemailMessage->getOrigtime());

        $recordingFileFullName = $astVoicemailMessage->getRecordingFileName();
        $recordingFileSize = 0;
        if (file_exists($recordingFileFullName)) {
            $recordingFileSize = (int) filesize($recordingFileFullName);
        }

        $recordingFileBaseName = sprintf(
            "Voicemail Recording - %s - %s.wav",
            $voicemail->getName(),
            $calldate->format('Y-m-d H:i:s'),
        );

        $folder = basename($astVoicemailMessage->getDir());

        $voicemailMessageDto
            ->setCaller(
                $astVoicemailMessage->getCallerid()
            )->setCalldate(
                $calldate
            )->setFolder(
                $folder
            )->setDuration(
                $astVoicemailMessage->getDuration()
            )->setRecordingFileFileSize(
                $recordingFileSize
            )->setRecordingFileMimeType(
                "audio/x-wav; charset=binary"
            )->setRecordingFileBaseName(
                $recordingFileBaseName
            )->setMetadataFileBaseName(
                $astVoicemailMessage->getMetadataFileBaseName()
            )->setMetadataFileMimeType(
                "text/plain; charset=UTF-8"
            )->setVoicemail(
                $voicemailDto
            )->setAstVoicemailMessage(
                $astVoicemailMessageDto
            );

        /** @var VoicemailMessageInterface $voicemailMessage */
        $voicemailMessage = $this->entityTools->persistDto(
            $voicemailMessageDto,
        );

        return $voicemailMessage;
    }
}
