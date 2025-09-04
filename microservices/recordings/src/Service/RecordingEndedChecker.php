<?php

namespace Service;

class RecordingEndedChecker
{
    public function __construct(
        private string $recorderIncomingPath,
    ) {
    }

    public function execute(string $fileName): bool
    {
        $incomingFileName = str_replace(
            '-mix.wav',
            '.meta',
            $fileName
        );

        $fp = sprintf(
            '%s/%s',
            $this->recorderIncomingPath,
            $incomingFileName,
        );

        $fileExists = file_exists(
            $fp,
        );

        return !$fileExists;
    }
}
