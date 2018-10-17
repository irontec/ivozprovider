<?php

namespace Recording;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrRepository;
use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrRepository;
use Ivoz\Provider\Domain\Model\Recording\RecordingDto;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\Process\Process;

class Encoder
{
    /**
     * @var TrunksCdrRepository
     */
    protected $trunksCdrRepository;

    /**
     * @var UsersCdrRepository
     */
    protected $usersCdrRepository;

    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var string
     */
    protected $rawRecordingsDir;

    /**
     * @var Logger
     */
    protected $logger;

    public function __construct(
        TrunksCdrRepository $trunksCdrRepository,
        UsersCdrRepository $usersCdrRepository,
        EntityPersisterInterface $entityPersister,
        string $rawRecordingsDir,
        Logger $logger
    ) {
        $this->trunksCdrRepository = $trunksCdrRepository;
        $this->usersCdrRepository = $usersCdrRepository;
        $this->entityPersister = $entityPersister;
        $this->rawRecordingsDir = $rawRecordingsDir;
        $this->logger = $logger;
    }

    public function processAction()
    {
        // Store statistics
        $stats = array(
            'deleted' => 0,
            'skipped' => 0,
            'encoded' => 0,
            'error'   => 0
        );

        // Ignore process when recordings folder does not exist
        if (!is_dir($this->rawRecordingsDir)) {
            return;
        }

        // Get a list of pending recordings
        $files = array();
        if ($dir = opendir($this->rawRecordingsDir)) {
            while (false !== ($filename = readdir($dir))) {
                // Absolute path to file
                $filenameabs = $this->rawRecordingsDir . $filename;

                // Only handle files
                if (!is_file($filenameabs))
                    continue;

                // Delete empty files
                if (filesize($filenameabs) === 0) {
                    $stats['deleted']++;
                    $this->logger->info(sprintf("[Recordings] Deleting empty file %s\n", $filename));
                    unlink($this->rawRecordingsDir . $filename);
                    continue;
                }

                // Check if this file is .rtp
                if (substr($filename, -8) == "-mix.wav") {
                    array_push($files, $filename);
                }
           }
        }

        $this->logger->info(
            sprintf("[Recordings] Processing %d files in recording dir %s\n", count($files), $this->rawRecordingsDir)
        );

        // Check each recording file
        foreach ($files as $filename) {

            // Store valid files
            if (preg_match("/(.*)-\w+-mix.wav/", $filename, $matches)) {
                $file = $matches[0];
                $callid = urldecode($matches[1]);
            } else {
                $this->logger->error(sprintf("[Recordings][ERROR] Unable to get info from filename %s\n", $filename));
                continue;
            }

            // Get Call-Id hash id
            $hashid = substr(md5($callid),0,8);

            // Get callid from file
            $this->logger->info(sprintf("[Recordings][%s] Checking file %s\n", $hashid, $file));

            // Look if the converstation with that id has ended
            /** @var TrunksCdrInterface $kamAccCdr */
            $kamAccCdr = $this->trunksCdrRepository->findOneByCallid($callid);
            if ($kamAccCdr) {
                $type = 'ddi';
                if ($kamAccCdr->getXcallid()) {
                    // If call first leg, caller is who activated the recording
                    $recorder = $kamAccCdr->getCaller();
                } else {
                    // If call second leg, callee is who activated the recording
                    $recorder = $kamAccCdr->getCallee();
                }
            } else {
                $kamAccCdr = $this->usersCdrRepository->findOneByCallid($callid);
                if ($kamAccCdr) {
                    $type = 'ondemand';
                    if ($kamAccCdr->getXcallid()) {
                        // If call second leg, callee is who activated the recording
                        $recorder = $kamAccCdr->getCallee();
                    } else {
                        // If call first leg, caller is who activated the recording
                        $recorder = $kamAccCdr->getCaller();
                    }
                } else {
                    $stats['skipped']++;
                    $this->logger->info(sprintf("[Recordings][%s] Call with id = %s has not yet finished!\n", $hashid, $callid));
                    continue;
                }
            }

            // Convert .wav to .mp3
            $convertWav = $this->rawRecordingsDir . $filename;
            $convertMp3 = $this->rawRecordingsDir . $callid . ".mp3";
            $metadata = 'artist="'. $callid .'"';
            $this->logger->info(sprintf("[Recordings][%s] Encoding to %s\n", $hashid, basename($convertMp3)));

            $convertProcess = new Process([
                "/usr/bin/avconv",
                "-y",
                "-i",
                $convertWav,
                "-metadata",
                $metadata,
                $convertMp3
            ]);
            $convertProcess->mustRun();

            if ($convertProcess->getExitCode() != 0) {
                $stats['error']++;
                $this->logger->error(
                    sprintf(
                        "[Recordings][%s] Failed to convert audio: Command was %s\n",
                        $hashid,
                        $convertProcess->getCommandLine()
                    )
                );
                continue;
            }

            // Get created mp3 information
            $mp3info = new \Zend_Media_Mpeg_Abs($convertMp3);
            $duration = $mp3info->getLengthEstimate();

            // Create an entry in Recordings table with the file
            $recordingDto = new RecordingDto();

            // Get company and brand for this recording
            $company = $kamAccCdr->getCompany();

            $callDate = $kamAccCdr->getStartTime();
            $caller = $kamAccCdr->getCaller();
            $callee = $kamAccCdr->getCallee();

            $baseName =
                $callDate->format('YmdHis')
                . '_'
                . $type
                . '-'
                . $recorder
                . '_'
                . str_replace('+', '', $caller)
                . '_'
                . str_replace('+', '', $callee)
                . '.mp3';

            $recordingDto->setCompanyId($company->getId())
                ->setCalldate($callDate)
                ->setType($type)
                ->setRecorder($recorder)
                ->setCallid($kamAccCdr->getCallid())
                ->setDuration($duration)
                ->setCaller($kamAccCdr->getCaller())
                ->setCallee($kamAccCdr->getCallee())
                ->setRecordedFileBaseName($baseName)
                ->setRecordedFilePath($convertMp3);

            // Store this Recording
            $recording = $this->entityPersister->persistDto($recordingDto, null, true);
            $this->logger->info(
                sprintf("[Recordings][%s] Create Recordings entry with id %s\n", $hashid, $recording->getId())
            );

            // Remove encoded files
            unlink($convertWav);
            $stats['encoded']++;
       }

        // Total processed calls
        $total = $stats['encoded'] + $stats['error'] + $stats['deleted'] + $stats['skipped'];
        $summary = sprintf(
            "[Recordings] Total %d processed: %d successful, %d error, %d deleted, %d skipped.\n",
            $total,
            $stats['encoded'],
            $stats['error'],
            $stats['deleted'],
            $stats['skipped']
        );

        $this->logger->info($summary);
    }

}
