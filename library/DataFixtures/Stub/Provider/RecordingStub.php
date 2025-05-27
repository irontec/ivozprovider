<?php

namespace DataFixtures\Stub\Provider;

use DataFixtures\Stub\StubTrait;
use Ivoz\Provider\Domain\Model\Recording\Recording;
use Ivoz\Provider\Domain\Model\Recording\RecordingDto;

class RecordingStub
{
    use StubTrait;

    protected function getEntityName(): string
    {
        return Recording::class;
    }

    protected function load()
    {
        $dto = (new RecordingDto(1))
            ->setCallid('7602fd7f-4153-4475-9100-d89ff70cdf76')
            ->setCalldate(new \DateTime('2017-01-05 00:15:15', new \DateTimeZone('UTC')))
            ->setType('ondemand')
            ->setDuration(3)
            ->setCaller('34946002020')
            ->setCallee('34946002021')
            ->setRecordedFileFileSize(4280)
            ->setRecordedFileMimeType('audio/mpeg; charset=binary')
            ->setRecordedFileBaseName("7602fd7f-4153-4475-9100-d89ff70cdf76.0.mp3")
            ->setCompanyId(1);

        $this->append($dto);

        $dto = (new RecordingDto(2))
            ->setCallid('fb504426-4e3c-11ef-af02-fc5cee56dc74')
            ->setCalldate(new \DateTime('2017-01-05 00:15:15', new \DateTimeZone('UTC')))
            ->setType('ondemand')
            ->setDuration(5)
            ->setCaller('34946002020')
            ->setCallee('34946002021')
            ->setRecordedFileFileSize(3276)
            ->setRecordedFileMimeType('audio/mpeg; charset=binary')
            ->setRecordedFileBaseName("fb504426-4e3c-11ef-af02-fc5cee56dc74.0.mp3")
            ->setCompanyId(1)
            ->setUserId(1)
            ->setUsersCdrId(2)
            ->setBillableCallId(2);

        $this->append($dto);

        $dto = (new RecordingDto(3))
            ->setCallid('032f4836-4e3d-11ef-951b-fc5cee56dc74')
            ->setCalldate(new \DateTime('2017-01-05 00:15:15', new \DateTimeZone('UTC')))
            ->setType('ddi')
            ->setDuration(2)
            ->setCaller('34946002020')
            ->setCallee('34946002021')
            ->setRecordedFileFileSize(4234)
            ->setRecordedFileMimeType('audio/mpeg; charset=binary')
            ->setRecordedFileBaseName("032f4836-4e3d-11ef-951b-fc5cee56dc74.0.mp3")
            ->setCompanyId(1)
            ->setDdiId(1);

        $this->append($dto);
    }
}
