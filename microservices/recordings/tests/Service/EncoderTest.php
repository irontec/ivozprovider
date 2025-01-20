<?php

namespace Test\Service;

use Composer\Pcre\PregTests\IsMatchTest;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Recording\Recording;
use Model\Mp3FileInfo;
use Model\RawRecordingInfo;
use Monolog\Handler\TestHandler;
use Monolog\Logger;
use Service\Encoder;
use Service\FileUnlinker;
use Service\RawRecordingInfoFactory;
use Service\RawRecordingProcessor;
use Service\RawRecordingsGetter;
use Service\RecordingEndedChecker;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EncoderTest extends KernelTestCase
{
    protected $serviceContainer;
    protected TestHandler $testHandler;
    protected Logger $logger;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->serviceContainer = $kernel->getContainer();
        $this->testHandler = new TestHandler();

        $this->logger = $this
            ->serviceContainer
            ->get('monolog.logger.recordings');

        $this->logger->setHandlers([$this->testHandler]);
        $this->setUpMockFileUnlinker();
        $this->setUpMockRecordingsGetter();
        $this->setUpMockRecordingEndedChecker();
        $this->setUpMockRecordingProcessor();
        $this->setUpMockEntityTools();
    }

    public function test_runner()
    {
        /** @var Encoder $encoder */
        $encoder = $this->serviceContainer->get('Service\Encoder');
        $encoder->processAction();

        $this->it_producess_info_log();
        $this->it_generates_correct_raw_recoding_info();
    }

    private function it_generates_correct_raw_recoding_info()
    {
        $rawRecordingInfoFactory = $this->createPartialMock(
            RawRecordingInfoFactory::class,
            [
                'getFileSize',
            ],
        );

        $wrongFileInfo = $rawRecordingInfoFactory->createRawRecordingInfo(
            '/recordings/wrong-file-name-mix.wav',
        );

        $this->assertNull($wrongFileInfo);

        $rawRecordingInfo = $rawRecordingInfoFactory->createRawRecordingInfo(
            '/recordings/ok-file-with-callid-name-mix.wav',
        );

        $this->assertNotNull($rawRecordingInfo);
        $this->assertEquals(
            'ok-file-with-callid-name-mix.wav',
            $rawRecordingInfo->getFileName(),
        );
        $this->assertEquals(
            '/recordings/ok-file-with-callid-name-mix.wav',
            $rawRecordingInfo->getFullName(),
        );
        $this->assertEquals(
            'with-callid',
            $rawRecordingInfo->getCallid(),
        );
    }

    private function it_producess_info_log()
    {

        $this->assertTrue($this->testHandler->hasInfoRecords());

        $records = $this->testHandler->getRecords();
        $logMessages = array_map(
            fn ($r) => $r['message'],
            $records,
        );

        $this->assertEquals(
            [
                "[Recordings] Processing 5 files in recording dir /opt/irontec/ivozprovider/storage/ivozprovider_model_recordings.originalfile/\n",
                "[Recordings][459f55f7] Checking file a5631aae-aa41-017cc7c8-eb38-4bbd-9318-524a274f7102-fc5cee56dc01-mix.wav\n",
                "[Recordings][459f55f7] +34123 [Ddi#1] has no +34633646464 recording enabled, but recording will be processed.\n",
                "[Recordings][459f55f7] Encoding to 459f55f7.mp3\n",
                "[Recordings][459f55f7] Create Recordings entry with id 1000\n",
                "[Recordings][5c772f5b] Checking file 4e0466c8-a64b-34676896565-fc5cee56dc74-mix.wav\n",
                "[Recordings][5c772f5b] Call with id = 34676896565 has not yet finished!\n",
                "[Recordings][8edac669] Checking file c00269fa-a64b-8297bdde-309cd49f%4010.10.1.125-fc5cee56dc74-mix.wav\n",
                "[Recordings][8edac669] Encoding to 8edac669.mp3\n",
                "[Recordings][8edac669] Create Recordings entry with id 1000\n",
                "[Recordings] Recording is not completed: still-recording-file-name-mix.wav\n",
                "[Recordings] Deleting empty file too-small-file-name-mix.wav\n",
                "[Recordings] Total 5 processed: 2 successful, 0 error, 1 deleted, 2 skipped.\n",
            ],
            $logMessages
        );
    }
    /**
     * @return void
     */
    private function setUpMockFileUnlinker(): void
    {
        $mockFileUnlinker = $this->createMock(FileUnlinker::class);

        $mockFileUnlinker->expects($this->exactly(3))
            ->method('execute')
            ->with(
                $this->callback(
                    fn ($arg) => basename($arg) != $arg
                )
            );

        $this->serviceContainer->set('Service\FileUnlinker', $mockFileUnlinker);
    }

    private function rawRecordingInfoMockFactory(string $file, int $size, int $age): RawRecordingInfo
    {
        $mock = $this->getMockBuilder(RawRecordingInfo::class)
            ->setConstructorArgs([$file])
            ->onlyMethods(['getSize'])
            ->getMock();

        $mock->method('getSize')->willReturn($size);

        return $mock;
    }

    private function setUpMockRecordingEndedChecker(): void
    {
        $mockRecordingEndedChecker = $this->createMock(
            RecordingEndedChecker::class
        );

        $mockRecordingEndedChecker->expects($this->exactly(5))
            ->method('execute')
            ->willReturnCallback(
                fn($file) => $file != '/recordings/still-recording-file-name-mix.wav'
            );

        $this->serviceContainer->set(
            'Service\RecordingEndedChecker',
            $mockRecordingEndedChecker,
        );
    }

    private function setUpMockRecordingsGetter(): void
    {
        $files = [
            new RawRecordingInfo(
                '/recordings/a5631aae-aa41-017cc7c8-eb38-4bbd-9318-524a274f7102-fc5cee56dc01-mix.wav',
                '017cc7c8-eb38-4bbd-9318-524a274f7102',
                Encoder::RECORDING_SIZE_MIN + 1
            ),
            new RawRecordingInfo(
                '/recordings/4e0466c8-a64b-34676896565-fc5cee56dc74-mix.wav',
                '34676896565',
                Encoder::RECORDING_SIZE_MIN + 1
            ),
            new RawRecordingInfo(
                '/recordings/c00269fa-a64b-8297bdde-309cd49f%4010.10.1.125-fc5cee56dc74-mix.wav',
                '8297bdde-309cd49f@10.10.1.125',
                Encoder::RECORDING_SIZE_MIN + 1
            ),
            new RawRecordingInfo(
                '/recordings/still-recording-file-name-mix.wav',
                'file',
                Encoder::RECORDING_SIZE_MIN + 1
            ),
            new RawRecordingInfo(
                '/recordings/too-small-file-name-mix.wav',
                'file',
                Encoder::RECORDING_SIZE_MIN - 1
            ),
        ];

        $mockRawRecordingsGetter = $this->createMock(
            RawRecordingsGetter::class
        );

        $mockRawRecordingsGetter->expects($this->once())
            ->method('getRawRecordings')
            ->willReturn($files);

        $this->serviceContainer->set('Service\RawRecordingsGetter', $mockRawRecordingsGetter);
    }

    private function setUpMockRecordingProcessor(): void
    {
        $mockRawRecordingProcessor = $this->createMock(
            RawRecordingProcessor::class
        );

        $mockMp3Info = $this->createMock(
            Mp3FileInfo::class
        );

        $mockMp3Info->expects($this->exactly(2))
            ->method('getLengthEstimate')
            ->willReturn(33);

        $mockRawRecordingProcessor->expects($this->exactly(2))
        ->method('execute')
        ->withAnyParameters()
        ->willReturn($mockMp3Info);

        $this->serviceContainer->set(
            'Service\RawRecordingProcessor',
            $mockRawRecordingProcessor,
        );
    }

    private function setUpMockEntityTools(): void
    {
        $mockEntityTools = $this->createMock(
            EntityTools::class
        );

        $recording = $this->createMock(Recording::class);
        $recording->expects($this->exactly(2))
            ->method('getId')
            ->willReturn(1000);

        $mockEntityTools->expects($this->exactly(2))
            ->method('persistDto')
            ->willReturn($recording);

        $this->serviceContainer->set(
            'Ivoz\Core\Domain\Service\EntityTools',
            $mockEntityTools,
        );
    }
}
