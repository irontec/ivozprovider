<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Service\ChannelUsage;

use Ivoz\Core\Domain\Model\Commandlog\Commandlog;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsage;
use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsageDto;
use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsageInterface;
use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsageRepository;

/**
 * Writes computed channel usage buckets, creating or updating one row per company and bucket.
 *
 * @phpstan-type ChannelUsageRow array{brandId: int, companyId: int, timestamp: \DateTimeInterface, peak: int, avgUsage: float, closingUsage: int, blockedByCompanyLimit: int, blockedByBrandLimit: int, maxCallsCompany: int, maxCallsBrand: int}
 */
class ChannelUsageWriter
{
    public const PERSIST_BATCH_SIZE = 100;

    public function __construct(
        private ChannelUsageRepository $channelUsageRepository,
        private EntityTools $entityTools
    ) {
    }

    /**
     * @param array<int, ChannelUsageRow> $rows
     */
    public function write(array $rows): void
    {
        foreach (array_chunk($rows, self::PERSIST_BATCH_SIZE) as $chunk) {
            // One lookup for the whole chunk instead of one per row.
            $existing = $this->loadExisting($chunk);

            foreach ($chunk as $row) {
                $this->writeRow($row, $existing);
            }

            // Let errors bubble up: the caller only drains the event queue on success, so no
            // event is lost and the next run recomputes these buckets.
            //
            // Note this is at-least-once, not atomic: chunks already flushed stay committed,
            // and the rerun rewinds from a *fresh* anchor, so a rewritten bucket can differ
            // slightly from what a single clean run would have produced. The unique key on
            // (companyId, timestamp) keeps the shape right - one row per company per bucket -
            // which is what the historic is read for.
            $this->entityTools->dispatchQueuedOperations();
            $this->entityTools->clearExcept(
                Commandlog::class
            );
        }
    }

    /**
     * @param array<int, ChannelUsageRow> $rows
     * @return array<string, ChannelUsageInterface> "<companyId>|<Y-m-d H:i:s>" => entity
     */
    private function loadExisting(array $rows): array
    {
        $companyIds = array_values(
            array_unique(
                array_column($rows, 'companyId')
            )
        );

        $timestamps = array_column($rows, 'timestamp');

        if (empty($companyIds) || empty($timestamps)) {
            return [];
        }

        $existing = $this->channelUsageRepository->findByCompaniesAndTimestampRange(
            $companyIds,
            min($timestamps),
            max($timestamps)
        );

        $indexed = [];
        foreach ($existing as $channelUsage) {
            $indexed[$this->rowKey(
                (int) $channelUsage->getCompany()->getId(),
                $channelUsage->getTimestamp()
            )] = $channelUsage;
        }

        return $indexed;
    }

    /**
     * @param ChannelUsageRow $row
     * @param array<string, ChannelUsageInterface> $existing
     */
    private function writeRow(array $row, array $existing): void
    {
        $channelUsage = $existing[$this->rowKey($row['companyId'], $row['timestamp'])] ?? null;

        if ($channelUsage) {
            /** @var ChannelUsageDto $channelUsageDto */
            $channelUsageDto = $this->entityTools->entityToDto($channelUsage);
        } else {
            $channelUsageDto = ChannelUsage::createDto();
        }

        $channelUsageDto
            ->setBrandId($row['brandId'])
            ->setCompanyId($row['companyId'])
            ->setTimestamp($row['timestamp'])
            ->setPeak($row['peak'])
            ->setAvgUsage(round($row['avgUsage'], 2))
            ->setClosingUsage($row['closingUsage'])
            ->setMaxCallsCompany($row['maxCallsCompany'])
            ->setMaxCallsBrand($row['maxCallsBrand'])
            ->setBlockedByCompanyLimit($row['blockedByCompanyLimit'])
            ->setBlockedByBrandLimit($row['blockedByBrandLimit']);

        $this->entityTools->persistDto(
            $channelUsageDto,
            $channelUsage,
            false
        );
    }

    private function rowKey(int $companyId, \DateTimeInterface $timestamp): string
    {
        return $companyId . '|' . $timestamp->format('Y-m-d H:i:s');
    }
}
