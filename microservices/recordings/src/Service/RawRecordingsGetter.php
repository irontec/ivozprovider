<?php

namespace Service;

use Model\RawRecordingInfo;
use Symfony\Bridge\Monolog\Logger;

class RawRecordingsGetter
{
    public function __construct(
        protected readonly string $rawRecordingsDir,
        protected readonly RawRecordingInfoFactory $rawRecordingInfoFactory,
        protected readonly Logger $logger,
    ) {
    }

    /**
     * @return RawRecordingInfo[]
     */
    public function getRawRecordings(): array
    {
        $files = [];

        if (!is_dir($this->rawRecordingsDir)) {
            return $files;
        }

        $dir = opendir($this->rawRecordingsDir);
        if (!$dir) {
            return [];
        }

        while (false !== ($filename = readdir($dir))) {
            if (!str_ends_with($filename, "-mix.wav")) {
                continue;
            }

            $absoluteFilename = sprintf(
                "%s%s",
                $this->rawRecordingsDir,
                $filename
            );

            $newRecording = $this
                ->rawRecordingInfoFactory
                ->createRawRecordingInfo(
                    $absoluteFilename
                );

            if (is_null($newRecording)) {
                $this->logger->error(sprintf(
                    "[Recordings][ERROR] Unable to get info from filename %s\n",
                    $filename,
                ));
                continue;
            }

            $files[] = $newRecording;
        }

        return $files;
    }
}
