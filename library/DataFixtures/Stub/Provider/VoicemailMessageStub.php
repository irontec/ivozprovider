<?php

namespace DataFixtures\Stub\Provider;

use DataFixtures\Stub\StubTrait;
use Ivoz\Provider\Domain\Model\VoicemailMessage\VoicemailMessage;
use Ivoz\Provider\Domain\Model\VoicemailMessage\VoicemailMessageDto;

class VoicemailMessageStub
{
    use StubTrait;

    protected function getEntityName(): string
    {
        return VoicemailMessage::class;
    }

    protected function load()
    {
        $dto = (new VoicemailMessageDto(1))
            ->setCalldate(new \DateTime('2022-03-31 12:08:43', new \DateTimeZone('UTC')))
            ->setCaller("Alice <101>")
            ->setFolder("INBOX")
            ->setDuration(4)
            ->setRecordingFileFileSize(65324)
            ->setRecordingFileMimeType('audio/x-wav; charset=binary')
            ->setRecordingFileBaseName('Voicemail Recording - Alice Allison - 2022-03-31 12:08:43.wav')
            ->setVoicemailId(
                1
            )
            ->setAstVoicemailMessageId(
                1
            );
        $this->append($dto);

        $dto = (new VoicemailMessageDto(2))
            ->setCalldate(new \DateTime('2022-03-31 14:27:27', new \DateTimeZone('UTC')))
            ->setCaller("Alice <101>")
            ->setFolder("INBOX")
            ->setDuration(9)
            ->setRecordingFileFileSize(145324)
            ->setRecordingFileMimeType('audio/x-wav; charset=binary')
            ->setRecordingFileBaseName('Voicemail Recording - Bob Bobson - 2022-03-31 14:27:27.wav')
            ->setVoicemailId(
                2
            )
            ->setAstVoicemailMessageId(
                2
            );
        $this->append($dto);

        $dto = (new VoicemailMessageDto(3))
            ->setCalldate(new \DateTime('2022-03-31 14:41:22', new \DateTimeZone('UTC')))
            ->setCaller("Alice <101>")
            ->setFolder("Old")
            ->setDuration(11)
            ->setRecordingFileFileSize(176044)
            ->setRecordingFileMimeType('audio/x-wav; charset=binary')
            ->setRecordingFileBaseName('Voicemail Recording - Bob Bobson - 2022-03-31 14:41:22.wav')
            ->setVoicemailId(
                2
            )
            ->setAstVoicemailMessageId(
                3
            );
        $this->append($dto);
    }
}
