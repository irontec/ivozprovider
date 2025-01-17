<?php

namespace Service;

class RecordingEndedChecker
{
    public function __construct(
        private string $recorderCmd,
    ) {
    }

    public function execute(string $fullFilename): bool
    {
        if (!file_exists($fullFilename)) {
            throw new \RuntimeException(
                'File not found: ' . $fullFilename,
                404
            );
        }

        $results = $this->lsof($fullFilename);

        if (empty($results)) {
            return true;
        }

        foreach ($results as $result) {
            $isWriting = $result['mode'] === 'w' || $result['mode'] === 'u';
            if ($isWriting) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return array<array{'pid': string,'mode': string}>
     */
    private function lsof(string $fullFilename): array
    {
        $columnCount = 2;
        $command = sprintf(
            'lsof -F a -a -c %s %s 2>/dev/null',
            $this->recorderCmd,
            $fullFilename,
        );

        /**
         * @var array<string> $lsofOutput
         */
        $lsofOutput = [];
        $statusCode = -1;
        exec(
            $command,
            $lsofOutput,
            $statusCode
        );

        $cmdNotFound = $statusCode === 127;

        if ($cmdNotFound) {
            throw new \RuntimeException(
                'Error executing lsof command',
                500
            );
        }

        $noMatchFound = $statusCode !== 0;
        if ($noMatchFound) {
            return [];
        }

        return array_map(
            fn(array $line) => [
                'pid' => substr((string)$line[0], 1),
                'mode' => substr((string)$line[1], 1),
            ],
            array_chunk($lsofOutput, $columnCount),
        );
    }
}
