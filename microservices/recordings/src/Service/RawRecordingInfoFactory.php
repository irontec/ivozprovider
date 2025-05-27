<?php

namespace Service;

use Model\RawRecordingInfo;

class RawRecordingInfoFactory
{
    protected const RECORDING_FILENAME_PATTERN = '/\w+-(outbound|inbound)-(.*)-\w+-mix.wav/';
    public function createRawRecordingInfo(string $fullFileName): ?RawRecordingInfo
    {
        $fileName = basename($fullFileName);

        if (preg_match(self::RECORDING_FILENAME_PATTERN, $fileName, $matches)) {
            $callid = urldecode($matches[2]);
            $direction = $matches[1];
        } else {
            return null;
        }

        return new RawRecordingInfo(
            $fullFileName,
            $callid,
            $direction,
            $this->getFileSize($fullFileName),
        );
    }

    protected function getFileSize(string $fullFileName): int
    {
        return (int)filesize($fullFileName);
    }
}
