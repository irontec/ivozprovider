<?php

namespace Service;

use Model\RawRecordingInfo;

class RawRecordingInfoFactory
{
    protected const RECORDING_FILENAME_PATTERN = '/\w+-\w+-(.*)-\w+-mix.wav/';
    public function createRawRecordingInfo(string $fullFileName): ?RawRecordingInfo
    {
        $fileName = basename($fullFileName);

        if (preg_match(self::RECORDING_FILENAME_PATTERN, $fileName, $matches)) {
            $callid = urldecode($matches[1]);
        } else {
            return null;
        }

        return new RawRecordingInfo(
            $fullFileName,
            $callid,
            $this->getFileSize($fullFileName),
            $this->getFileAge($fullFileName),
        );
    }

    protected function getFileSize(string $fullFileName): int
    {
        return (int)filesize($fullFileName);
    }

    protected function getFileAge(string $fullFileName): int
    {
        return time() - filemtime($fullFileName);
    }
}
