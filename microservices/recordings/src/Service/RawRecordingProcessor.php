<?php

namespace Service;

use Model\Mp3FileInfo;
use Symfony\Component\Process\Process;

class RawRecordingProcessor
{
    public function execute(string $convertWav, string $metadata, string $convertMp3): Mp3FileInfo
    {
        $convertProcess = new Process([
            "/usr/bin/ffmpeg",
            "-y",
            "-i",
            $convertWav,
            "-metadata",
            $metadata,
            $convertMp3
        ]);

        $convertProcess->setTimeout(120);
        $convertProcess->mustRun();
        $conversionError = $convertProcess->getExitCode() != 0;

        if ($conversionError) {
            throw new \RuntimeException(
                sprintf('Command was %s', $convertProcess->getCommandLine()),
            );
        }

        return new Mp3FileInfo(
            new \Zend_Media_Mpeg_Abs($convertMp3)
        );
    }
}
