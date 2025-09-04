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
        $this->it_detects_incoming_recording();
        $this->it_detects_ended_recording();
    }

    private function it_detects_incoming_recording()
    {
        $file = tempnam('/tmp', 'test');
        $this->assertNotFalse(
            $file,
            'Create temporary file failed'
        );

        $this->assertNotFalse(
            file_put_contents($file . '.meta', 'dummy'),
            'Creating temporary file failed'
        );

        $checker = $this->serviceContainer->get('Service\RecordingEndedChecker');

        $this->assertFalse(
            $checker->execute(basename($file) . '-mix.wav')
        );
    }

    private function it_detects_ended_recording()
    {
        $checker = $this->serviceContainer->get('Service\RecordingEndedChecker');

        $this->assertTrue(
            $checker->execute(basename('dummy-file-name-mix.wav'))
        );
    }
}
