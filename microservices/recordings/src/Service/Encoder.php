<?php

namespace Service;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;
use Ivoz\Provider\Domain\Model\Recording\RecordingDto;
use Ivoz\Provider\Domain\Model\Recording\RecordingInterface;
use Ivoz\Provider\Domain\Model\UsersCdr\UsersCdrDto;
use Ivoz\Provider\Domain\Model\UsersCdr\UsersCdrInterface;
use Ivoz\Provider\Domain\Model\UsersCdr\UsersCdrRepository;
use Model\RawRecordingInfo;
use Symfony\Bridge\Monolog\Logger;

class Encoder
{
    /**
     * Recordings below this size in bytes will be skipped
     */
    const RECORDING_SIZE_MIN = 512;

    /**
     * @var array{
     *     deleted: int,
     *     skipped: int,
     *     encoded: int,
     *     error: int
     * }
     */
    private array $stats = [
        'deleted' => 0,
        'skipped' => 0,
        'encoded' => 0,
        'error' => 0
    ];

    public function __construct(
        private BillableCallRepository $billableCallRepository,
        private UsersCdrRepository $usersCdrRepository,
        private EntityTools $entityTools,
        private string $rawRecordingsDir,
        private Logger $logger,
        private RawRecordingProcessor $rawRecordingProcessor,
        private RawRecordingsGetter $fileGetter,
        private FileUnlinker $fileUnlinker,
        private RecordingEndedChecker $recordingEndedChecker,
    ) {
    }

    public function processAction(): void
    {
        $recordings = $this->fileGetter->getRawRecordings();

        $this->logger->info(
            sprintf(
                "[Recordings] Processing %d files in recording dir %s\n",
                count($recordings),
                $this->rawRecordingsDir
            )
        );

        foreach ($recordings as $rawRecordingInfo) {
            if (!$this->isProcessableFile($rawRecordingInfo)) {
                continue;
            }

            $this->logger->info(sprintf(
                "[Recordings][%s] Checking file %s\n",
                $rawRecordingInfo->getHashid(),
                $rawRecordingInfo->getFileName()
            ));

            $kamAccCdr = $this->getAccCdr($rawRecordingInfo);

            if (is_null($kamAccCdr)) {
                continue;
            }

            $recordingDto = $this->processAccCdr($kamAccCdr, $rawRecordingInfo);

            if (!is_null($recordingDto)) {
                $this->storeRecording($recordingDto);
            }

            $this->fileUnlinker->execute(
                $rawRecordingInfo->getFullName()
            );
        }

        $this->logSummary();
    }

    private function processAccCdr(BillableCallInterface|UsersCdrInterface $accCdr, RawRecordingInfo $rawRecordingInfo): ?RecordingDto
    {
        $convertWav = $this->rawRecordingsDir . $rawRecordingInfo->getFileName();
        $convertMp3 = $this->rawRecordingsDir . $rawRecordingInfo->getHashid() . ".mp3";
        $metadata = 'artist="' . $rawRecordingInfo->getCallid() . '"';

        if ($accCdr instanceof BillableCallInterface) {
            $recordingDto = $this->getRecordingFromBillableCall($accCdr);
            if (is_null($recordingDto)) {
                return null;
            }
            $recordingDto
                ->setBillableCallId(
                    $accCdr->getId()
                );
        } elseif ($accCdr instanceof UsersCdrInterface) {
            $recordingDto = $this->getRecordingFromUserCdr($accCdr);
            if (is_null($recordingDto)) {
                return null;
            }

            $recordingDto
                ->setUsersCdrId(
                    $accCdr->getId()
                );
        } else {
            // This should not even be possible
            $this->logger->error(sprintf(
                "[Recordings][ERROR] Invalid CDR entries for %s\n",
                $rawRecordingInfo->getCallid()
            ));
            return null;
        }

        $this->logger->info(sprintf(
            "[Recordings][%s] Encoding to %s\n",
            $rawRecordingInfo->getHashid(),
            basename($convertMp3)
        ));

        $duration = $this->convertToMp3(
            $rawRecordingInfo,
            $convertWav,
            $metadata,
            $convertMp3
        );

        if ($duration === 0.0) {
            return null;
        }

        $recordingDto->setDuration(ceil($duration));
        $recordingDto->setRecordedFilePath($convertMp3);

        return $recordingDto;
    }

    private function convertToMp3(RawRecordingInfo $rawRecordingInfo, string $convertWav, string $metadata, string $convertMp3): float
    {
        try {
            $mp3info = $this
                ->rawRecordingProcessor
                ->execute($convertWav, $metadata, $convertMp3);
        } catch (\Exception $e) {
            $this->stats['error']++;
            $this->logger->info(sprintf(
                "[Recordings][%s] Failed to convert audio: %s\n",
                $rawRecordingInfo->getHashid(),
                $e->getMessage()
            ));

            return 0;
        }

        return ceil($mp3info->getLengthEstimate());
    }

    private function getRecordingFromBillableCall(BillableCallInterface $billableCall): ?RecordingDto
    {
        $type = RecordingInterface::TYPE_DDI;
        $direction = $billableCall->getDirection();

        $recorder = $direction == 'outbound'
            ? $billableCall->getCaller()
            : $billableCall->getCallee();

        $hashid = $this->getHashId(
            $billableCall->getCallid()
        );

        $ddi = $billableCall->getDdi();
        if (is_null($ddi)) {
            $this->stats['error']++;
            $this->logger->error(
                sprintf("[Recordings][%s] Unable to find DDI for %s\n", $hashid, $recorder)
            );
            return null;
        }

        if (!in_array($ddi->getRecordCalls(), array('all', $direction), true)) {
            $this->logger->info(
                sprintf(
                    "[Recordings][%s] %s has no %s recording enabled, but recording will be processed.\n",
                    $hashid,
                    $ddi,
                    $recorder
                )
            );
        }

        $callid = $billableCall->getCallid();

        $company = $billableCall->getCompany();
        if (! $company) {
            $this->stats['error']++;
            $this->logger->error(
                sprintf(
                    "[Recordings][%s] Failed to get company for callid = %s\n",
                    $hashid,
                    $callid
                )
            );
            return null;
        }

        $baseName = $this->getBaseName(
            $billableCall,
            $type,
            $recorder
        );

        $callDate = $billableCall->getStartTime();

        $recordingDto = new RecordingDto();
        $recordingDto
            ->setCompanyId($company->getId())
            ->setCalldate($callDate)
            ->setType($type)
            ->setRecorder($recorder)
            ->setCallid($callid)
            ->setCaller($billableCall->getCaller())
            ->setCallee($billableCall->getCallee())
            ->setRecordedFileBaseName($baseName)
            ->setDdiId($ddi->getId());

        return $recordingDto;
    }

    private function getRecordingFromUserCdr(UsersCdrInterface $usersCdr): ?RecordingDto
    {
        $type = RecordingInterface::TYPE_ONDEMAND;
        $callid = $usersCdr->getCallid();

        $user = $usersCdr->getUser();
        if (is_null($user)) {
            $this->stats['skipped']++;
            $this->logger->info(
                sprintf("[Recordings][%s] Unable to find user. Skipping.\n", $this->getHashId($callid))
            );
            return null;
        }
        $recorder = $user->getExtensionNumber();

        $baseName = $this->getBaseName(
            $usersCdr,
            $type,
            $recorder
        );

        $callDate = $usersCdr->getStartTime();

        $recordingDto = new RecordingDto();
        $recordingDto
            ->setCompanyId($usersCdr->getCompany()?->getId())
            ->setCalldate($callDate)
            ->setType($type)
            ->setRecorder($recorder)
            ->setCallid($callid)
            ->setCaller($usersCdr->getCaller())
            ->setCallee($usersCdr->getCallee())
            ->setRecordedFileBaseName($baseName)
            ->setUserId($user->getId());

        return $recordingDto;
    }

    private function getHashId(string $callid): string
    {
        return substr(md5($callid), 0, 8);
    }

    private function storeRecording(RecordingDto $recordingDto): void
    {
        $hashid = $this->getHashId($recordingDto->getCallid());
        $recording = $this->entityTools->persistDto($recordingDto, null, true);
        $this->logger->info(
            sprintf("[Recordings][%s] Create Recordings entry with id %s\n", $hashid, (string)$recording->getId())
        );
        $this->stats['encoded']++;
    }

    private function getBaseName(BillableCallInterface | UsersCdrInterface $cdr, string $type, string $recorder): string
    {
        $callDate = $cdr->getStartTime();
        $caller = $cdr->getCaller();
        $callee = $cdr->getCallee();

        return
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
    }

    private function getAccCdr(RawRecordingInfo $rawRecordingInfo): null|UsersCdrInterface|BillableCallInterface
    {
        $billableCall = $this
            ->billableCallRepository
            ->findLastByCallidAndDirection(
                $rawRecordingInfo->getCallid(),
                $rawRecordingInfo->getDirection(),
            );

        if (!is_null($billableCall)) {
            return $billableCall;
        }

        $usersCdr = $this
            ->usersCdrRepository
            ->findLastByCallidAndDirection(
                $rawRecordingInfo->getCallid(),
                $rawRecordingInfo->getDirection(),
            );

        if (!is_null($usersCdr)) {
            return $usersCdr;
        }

        $this->stats['skipped']++;
        $this->logger->info(sprintf(
            "[Recordings][%s] Call with id = %s has not yet finished!\n",
            $rawRecordingInfo->getHashid(),
            $rawRecordingInfo->getCallid(),
        ));

        return null;
    }

    private function isProcessableFile(RawRecordingInfo $rawRecordingInfo): bool
    {
        $isRecordingEnded = $this
            ->recordingEndedChecker
            ->execute($rawRecordingInfo->getFullName());

        if (!$isRecordingEnded) {
            $this->logger->info(sprintf(
                "[Recordings] Recording is not completed: %s\n",
                $rawRecordingInfo->getFileName()
            ));
            $this->stats['skipped']++;

            return false;
        }

        $isTooSmall = $rawRecordingInfo->getSize() <= self::RECORDING_SIZE_MIN;
        if ($isTooSmall) {
            $this->logger->info(sprintf(
                "[Recordings] Deleting empty file %s\n",
                $rawRecordingInfo->getFileName()
            ));
            $this->fileUnlinker->execute(
                $rawRecordingInfo->getFullName()
            );

            $this->stats['deleted']++;
            return false;
        }

        return true;
    }

    private function logSummary(): void
    {

        $total = $this->stats['encoded']
            + $this->stats['error']
            + $this->stats['deleted']
            + $this->stats['skipped'];

        $summary = sprintf(
            "[Recordings] Total %d processed: %d successful, %d error, %d deleted, %d skipped.\n",
            $total,
            $this->stats['encoded'],
            $this->stats['error'],
            $this->stats['deleted'],
            $this->stats['skipped']
        );

        $this->logger->info($summary);
    }
}
