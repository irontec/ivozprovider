<?php

namespace Test\Service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RecordingEndedCheckerTest extends KernelTestCase
{
    protected $serviceContainer;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->serviceContainer = $kernel->getContainer();
    }

    public function test_runer()
    {
        $this->it_detects_opened_for_writing_file();
        $this->it_detectects_opened_for_read_file();
        $this->it_detects_unopened_file();
        $this->it_launch_exception_on_wrong_file();
    }

    private function it_detects_opened_for_writing_file()
    {
        $file = tempnam('/tmp', 'test');

        $this->assertNotFalse(
            $file,
            'Create temporary file failed'
        );

        $fd = fopen($file, 'w');

        $this->assertNotFalse(
            $fd,
            'Open for writing temporary file failed'
        );

        $checker = $this->serviceContainer->get('Service\RecordingEndedChecker');

        $this->assertFalse(
            $checker->execute($file)
        );

        fclose($fd);
        unlink($file);
    }

    private function it_detectects_opened_for_read_file()
    {
        $file = tempnam('/tmp', 'test');

        $this->assertNotFalse(
            $file,
            'Create temporary file failed'
        );

        $fd = fopen($file, 'r');

        $this->assertNotFalse(
            $fd,
            'Open for reading temporary file failed'
        );

        $checker = $this->serviceContainer->get('Service\RecordingEndedChecker');

        $this->assertTrue(
            $checker->execute($file)
        );

        fclose($fd);
        unlink($file);
    }

    private function it_detects_unopened_file()
    {
        $file = tempnam('/tmp', 'test');

        $this->assertNotFalse(
            $file,
            'Create temporary file failed'
        );

        $checker = $this->serviceContainer->get('Service\RecordingEndedChecker');

        $this->assertTrue(
            $checker->execute($file)
        );

        unlink($file);
    }

    private function it_launch_exception_on_wrong_file()
    {
        $file = tempnam('/tmp', 'test');
        unlink($file);

        $checker = $this->serviceContainer->get('Service\RecordingEndedChecker');

        $this->expectExceptionCode(404);
        $checker->execute($file);
    }
}
