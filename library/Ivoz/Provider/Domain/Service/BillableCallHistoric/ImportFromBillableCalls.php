<?php

namespace Ivoz\Provider\Domain\Service\BillableCallHistoric;

use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;
use Ivoz\Provider\Domain\Model\BillableCallHistoric\BillableCallHistoricRepository;
use Psr\Log\LoggerInterface;

class ImportFromBillableCalls
{
    const SYNC_CHUNK_SIZE = 500;
    const SLEEP_BETWEEN_LOOPS = 2;

    public function __construct(
        private BillableCallRepository $billableCallRepository,
        private BillableCallHistoricRepository $billableCallHistoricRepository,
        private LoggerInterface $logger
    ) {
    }

    /**
     * @return int affected rows
     */
    public function execute(): int
    {
        $affectedRowsSum = 0;

        do {
            $fromId = $this->billableCallHistoricRepository->getMaxId();
            if (!isset($untilId)) {
                $untilId = $this->getRotateUntilId(
                    $fromId
                );
            }

            $infoMsg = sprintf(
                'About migrate %d calls from #%d until #%d',
                self::SYNC_CHUNK_SIZE,
                $fromId,
                $untilId
            );
            $this->logger->info($infoMsg);

            $ids = $this->billableCallRepository->getIdsInRange(
                $fromId,
                $untilId,
                self::SYNC_CHUNK_SIZE
            );

            if (empty($ids)) {
                return $affectedRowsSum;
            }

            $affectedRows = $this
                ->billableCallHistoricRepository
                ->copyBillableCallsByIds(
                    $ids
                );

            $affectedRowsSum += $affectedRows;

            sleep(self::SLEEP_BETWEEN_LOOPS);
        } while ($affectedRows > 0);

        return $affectedRowsSum;
    }

    private function getRotateUntilId(int $fromId): int
    {
        $utc =  new \DateTimeZone('UTC');
        $now = new \DateTime(null, $utc);
        $yearAgo = (clone $now)->modify('-1 year');

        $fromDate = $this->billableCallRepository->getMinStartTime($fromId);

        $rotateUntilDate = (clone $fromDate)->modify('+1 week');
        if ($rotateUntilDate > $yearAgo) {
            $rotateUntilDate = $yearAgo;
        }

        $maxId = $this->billableCallRepository->getMaxIdUntilDate($fromId, $rotateUntilDate);

        return $maxId;
    }
}
