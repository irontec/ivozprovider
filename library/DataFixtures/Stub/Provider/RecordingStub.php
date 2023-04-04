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
    }
}
