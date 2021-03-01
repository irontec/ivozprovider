<?php

namespace Ivoz\Provider\Domain\Service\BillableCallHistoric;

use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;
use Ivoz\Provider\Domain\Model\BillableCallHistoric\BillableCallHistoricRepository;

class ImportFromBillableCalls
{
    const SYNC_CHUNK_SIZE = 500;
    const SLEEP_BETWEEN_LOOPS = 2;

    protected $billableCallRepository;
    protected $billableCallHistoricRepository;

    public function __construct(
        BillableCallRepository $billableCallRepository,
        BillableCallHistoricRepository $billableCallHistoricRepository
    ) {
        $this->billableCallRepository = $billableCallRepository;
        $this->billableCallHistoricRepository = $billableCallHistoricRepository;
    }

    /**
     * @return int affected rows
     */
    public function execute(): int
    {
        $affectedRows = 0;

        do {
            $fromId = $this->billableCallHistoricRepository->getMaxId();
            $untilDate = $this->getRotateUntilDate($fromId);
            $ids = $this->billableCallRepository->getIdsInRange(
                $fromId,
                $untilDate,
                self::SYNC_CHUNK_SIZE
            );

            if (empty($ids)) {
                return $affectedRows;
            }

            $affectedRows += $this
                ->billableCallHistoricRepository
                ->copyBillableCallsByIds(
                    $ids
                );

            sleep(self::SLEEP_BETWEEN_LOOPS);
        } while ($affectedRows > 0);

        return $affectedRows;
    }

    private function getRotateUntilDate(int $fromId): \DateTime
    {
        $utc =  new \DateTimeZone('UTC');
        $now = new \DateTime(null, $utc);
        $yearAgo = (clone $now)->modify('-1 year');
        $fromDate = $this->billableCallRepository->getMinStartTime($fromId);

        if ($fromDate >= $yearAgo) {
            return $yearAgo;
        }

        $rotateUntilDate = (clone $fromDate)->modify('+1 week');
        if ($rotateUntilDate > $yearAgo) {
            return $yearAgo;
        }

        return $rotateUntilDate;
    }
}
