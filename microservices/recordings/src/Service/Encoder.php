<?php

namespace Service;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;
use Ivoz\Provider\Domain\Model\Recording\RecordingDto;
use Ivoz\Provider\Domain\Model\Recording\RecordingInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\UsersCdr\UsersCdrInterface;
use Ivoz\Provider\Domain\Model\UsersCdr\UsersCdrRepository;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\Process\Process;

class Encoder
{
    /**
     * Recordings below this size in bytes will be skipped
     */
    const RECORDING_SIZE_MIN = 512;

    /**
     * Recording created this seconds ago will be ignored
     */
    const RECORDING_AGE_MIN = 10;

    public function __construct(
        private BillableCallRepository $billableCallRepository,
        private UsersCdrRepository $usersCdrRepository,
        private EntityTools $entityTools,
        private string $rawRecordingsDir,
        private Logger $logger
    ) {
    }

    public function processAction(): void
    {
        // Store statistics
        $stats = array(
            'deleted' => 0,
            'skipped' => 0,
            'encoded' => 0,
            'error' => 0
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
                if (!is_file($filenameabs)) {
                    continue;
                }

                // Ignore recent files
                $age = time() - filemtime($filenameabs);
                if ($age <= self::RECORDING_AGE_MIN) {
                    $this->logger->info(sprintf("[Recordings] Ignoring too young file %s [%d sec]\n", $filename, $age));
                    continue;
                }

                // Delete empty files
                if (filesize($filenameabs) < self::RECORDING_SIZE_MIN) {
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
            // FIXME This mutes a phpstan error until this microservice refactor
            $ddi = null;
            $user = null;

            // Store valid files
            if (preg_match("/\w+-\w+-(.*)-\w+-mix.wav/", $filename, $matches)) {
                $file = $matches[0];
                $callid = urldecode($matches[1]);
            } else {
                $this->logger->error(sprintf("[Recordings][ERROR] Unable to get info from filename %s\n", $filename));
                continue;
            }

            // Get Call-Id hash id
            $hashid = substr(md5($callid), 0, 8);

            // Get callid from file
            $this->logger->info(sprintf("[Recordings][%s] Checking file %s\n", $hashid, $file));

            // Look if the conversation with that id has ended
            $kamAccCdrs = [];
            $kamAccCdrs = array_merge(
                $kamAccCdrs,
                $this->billableCallRepository->findByCallid($callid)
            );

            if (empty($kamAccCdrs)) {
                $kamAccCdrs = array_merge(
                    $kamAccCdrs,
                    $this->usersCdrRepository->findByCallid($callid)
                );
            }

            if (empty($kamAccCdrs)) {
                $stats['skipped']++;
                $this->logger->info(sprintf(
                    "[Recordings][%s] Call with id = %s has not yet finished!\n",
                    $hashid,
                    $callid
                ));
                continue;
            }

            // Set recording filenames
            $convertWav = $this->rawRecordingsDir . $filename;
            $convertMp3 = $this->rawRecordingsDir . $hashid . ".mp3";
            $metadata = 'artist="' . $callid . '"';

            foreach ($kamAccCdrs as $kamAccCdr) {
                if ($kamAccCdr instanceof BillableCallInterface) {
                    $type = RecordingInterface::TYPE_DDI;
                    $direction = $kamAccCdr->getDirection();

                    if ($direction == 'outbound') {
                        // If call first leg, caller is who activated the recording
                        $recorder = $kamAccCdr->getCaller();
                    } else {
                        // If call second leg, callee is who activated the recording
                        $recorder = $kamAccCdr->getCallee();
                    }

                    // Check this ddi has recording enabled
                    $ddi = $kamAccCdr->getDdi();
                    if (is_null($ddi)) {
                        $stats['error']++;
                        $this->logger->error(
                            sprintf("[Recordings][%s] Unable to find DDI for %s\n", $hashid, $recorder)
                        );
                        continue;
                    }

                    if (!in_array($ddi->getRecordCalls(), array('all', $direction), true)) {
                        $stats['skipped']++;
                        $this->logger->info(
                            sprintf(
                                "[Recordings][%s] %s has no %s recording enabled. Skipping.\n",
                                $hashid,
                                $ddi,
                                $recorder
                            )
                        );
                        continue;
                    }
                } elseif ($kamAccCdr instanceof UsersCdrInterface) {
                    $type = RecordingInterface::TYPE_ONDEMAND;

                    $user = $kamAccCdr->getUser();
                    if (is_null($user)) {
                        $stats['skipped']++;
                        $this->logger->info(
                            sprintf("[Recordings][%s] Unable to find user. Skipping.\n", $hashid)
                        );
                        continue;
                    }

                    $recorder = $user->getExtensionNumber();
                } else {
                    // This should not even be possible
                    $this->logger->error(sprintf("[Recordings][ERROR] Invalid CDR entries for %s\n", $callid));
                    continue;
                }

                // Get company for this recording
                $company = $kamAccCdr->getCompany();
                if (! $company) {
                    $stats['error']++;
                    $this->logger->error(
                        sprintf(
                            "[Recordings][%s] Failed to get company for callid = %s\n",
                            $hashid,
                            $callid
                        )
                    );
                    continue;
                }

                // Convert .wav to .mp3
                $this->logger->info(sprintf("[Recordings][%s] Encoding to %s\n", $hashid, basename($convertMp3)));

                $convertProcess = new Process([
                    "/usr/bin/ffmpeg",
                    "-y",
                    "-i",
                    $convertWav,
                    "-metadata",
                    $metadata,
                    $convertMp3
                ]);

                try {
                    $convertProcess->setTimeout(120);
                    $convertProcess->mustRun();
                    $conversionError = $convertProcess->getExitCode() != 0;
                } catch (\Exception $e) {
                    $conversionError = true;
                }

                if ($conversionError) {
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
                    . str_replace('+', '', $recorder)
                    . '_'
                    . str_replace('+', '', $caller)
                    . '_'
                    . str_replace('+', '', $callee)
                    . '.mp3';

                $recordingDto
                    ->setCompanyId($company->getId())
                    ->setCalldate($callDate)
                    ->setType($type)
                    ->setRecorder($recorder)
                    ->setCallid($kamAccCdr->getCallid())
                    ->setDuration(ceil($duration))
                    ->setCaller($kamAccCdr->getCaller())
                    ->setCallee($kamAccCdr->getCallee())
                    ->setRecordedFileBaseName($baseName)
                    ->setRecordedFilePath($convertMp3);


                $isDdi = $type === RecordingInterface::TYPE_DDI && is_object($ddi);
                $isUser = $type === RecordingInterface::TYPE_ONDEMAND && is_object($user);

                if ($isDdi) {
                    $recordingDto->setDdiId(
                        $ddi->getId()
                    );
                } elseif ($isUser) {
                    $recordingDto->setUserId(
                        $user->getId()
                    );
                }

                // Store this Recording
                $recording = $this->entityTools->persistDto($recordingDto, null, true);
                $this->logger->info(
                    sprintf("[Recordings][%s] Create Recordings entry with id %s\n", $hashid, (string) $recording->getId())
                );
                $stats['encoded']++;
            }

            // Remove encoded files
            unlink($convertWav);
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
