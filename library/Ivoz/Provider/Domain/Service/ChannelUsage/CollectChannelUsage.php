<?php

namespace Ivoz\Provider\Domain\Service\ChannelUsage;

use Ivoz\Core\Domain\Model\Commandlog\Commandlog;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Core\Infrastructure\Persistence\Redis\RedisMasterFactory;
use Ivoz\Provider\Domain\Model\Brand\BrandRepository;
use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsage;
use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsageDto;
use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsageRepository;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Psr\Log\LoggerInterface;

class CollectChannelUsage
{
    const BUCKET_SIZE = 300;
    const RETENTION_DAYS = 30;
    const EVENT_QUEUE_KEY = 'chusage:events';
    const REDIS_DB = 1;
    const REDIS_SCAN_COUNT = 1000;
    const PERSIST_BATCH_SIZE = 100;
    const PURGE_BATCH_SIZE = 1000;
    const TRUNKS_KEY_PATTERN = 'trunks:*';

    public function __construct(
        private RedisMasterFactory $redisMasterFactory,
        private CompanyRepository $companyRepository,
        private BrandRepository $brandRepository,
        private ChannelUsageRepository $channelUsageRepository,
        private EntityTools $entityTools,
        private LoggerInterface $logger
    ) {
    }

    public function execute(): void
    {
        $redis = $this->redisMasterFactory->create(self::REDIS_DB);

        try {
            $anchorTime = time();
            $bucketStart = (int) (floor($anchorTime / self::BUCKET_SIZE) * self::BUCKET_SIZE);

            $anchor = $this->buildAnchor($redis);

            /** @var array<string> $rawEvents */
            $rawEvents = $redis->lrange(self::EVENT_QUEUE_KEY, 0, -1);
            $allEvents = $this->parseEvents($rawEvents);

            $processable = array_values(array_filter($allEvents, fn($e) => $e['ts'] < $bucketStart));
            $currentBucket = array_values(array_filter($allEvents, fn($e) => $e['ts'] >= $bucketStart));

            if (empty($processable) && empty($anchor)) {
                return;
            }

            $anchorCoherent = $this->isAnchorCoherent($anchor, $processable);
            if (!$anchorCoherent) {
                $this->logger->warning(
                    'ChannelUsage: anchor has 0 keys but recent A-events exist.'
                    . ' ivozprovider-realtime may be down. Skipping anchor reconciliation.'
                );
            }

            $companyBrandMap = $this->buildCompanyBrandMap($processable, $anchor);

            if (empty($companyBrandMap)) {
                return;
            }

            $maxCallsCompany = $this->loadCompanyMaxCalls(array_keys($companyBrandMap));
            $maxCallsBrand = $this->loadBrandMaxCalls(array_unique(array_values($companyBrandMap)));

            $rows = [];

            foreach ($companyBrandMap as $companyId => $brandId) {
                $companyCurrentEvents = $this->filterByCompany($currentBucket, $companyId);
                $companyProcessable = $this->filterByCompany($processable, $companyId);

                $anchorOcc = $anchor[$companyId]['occ'] ?? 0;

                $occAtBucketStart = $this->rewind($anchorOcc, $companyCurrentEvents);

                if (empty($companyProcessable)) {
                    if ($anchorCoherent && $occAtBucketStart > 0) {
                        $rows[] = $this->makeRow(
                            $brandId,
                            $companyId,
                            $bucketStart - self::BUCKET_SIZE,
                            $occAtBucketStart,
                            $occAtBucketStart,
                            $occAtBucketStart,
                            0,
                            0,
                            $maxCallsCompany[$companyId] ?? 0,
                            $maxCallsBrand[$brandId] ?? 0
                        );
                    }
                    continue;
                }

                $openingOcc = $this->rewind($occAtBucketStart, $companyProcessable);

                $bucketRows = $this->forwardPass(
                    $companyProcessable,
                    $openingOcc,
                    $brandId,
                    $companyId,
                    $maxCallsCompany[$companyId] ?? 0,
                    $maxCallsBrand[$brandId] ?? 0
                );

                $lastBucketEnd = 0;
                foreach ($bucketRows as $bucketRow) {
                    $lastBucketEnd = max($lastBucketEnd, $bucketRow['bucketEnd']);
                }

                // Fill empty trailing buckets up to bucketStart
                $lastEntry = end($bucketRows);
                if ($anchorCoherent && $lastBucketEnd > 0 && $lastBucketEnd < $bucketStart && $lastEntry !== false) {
                    $fillOcc = $lastEntry['row']['closingUsage'];
                    for ($ts = $lastBucketEnd; $ts < $bucketStart; $ts += self::BUCKET_SIZE) {
                        if ($fillOcc > 0) {
                            $rows[] = $this->makeRow(
                                $brandId,
                                $companyId,
                                $ts,
                                $fillOcc,
                                $fillOcc,
                                $fillOcc,
                                0,
                                0,
                                $maxCallsCompany[$companyId] ?? 0,
                                $maxCallsBrand[$brandId] ?? 0
                            );
                        }
                    }
                }

                foreach ($bucketRows as $bucketRow) {
                    $rows[] = $bucketRow['row'];
                }
            }

            if (!empty($rows)) {
                $this->persistRows($rows);
            }

            // LTRIM: remove processable events from queue (they are at the left/oldest end)
            $processableCount = count($processable);
            if ($processableCount > 0) {
                $redis->ltrim(self::EVENT_QUEUE_KEY, $processableCount, -1);
            }
        } finally {
            $redis->close();
        }

        $this->purgeOldRows();
    }

    /**
     * @return array<int, array{brandId: int, occ: int}>
     */
    private function buildAnchor(\Redis $redis): array
    {
        $anchor = [];
        $iterator = null;

        while (true) {
            $keys = $redis->scan($iterator, self::TRUNKS_KEY_PATTERN, self::REDIS_SCAN_COUNT);
            if ($keys === false) {
                break;
            }

            foreach ($keys as $key) {
                // trunks:b<brandId>:c<companyId>:ddi<ddiId>:cr<carrierId>:<callId>
                // trunks:b<brandId>:c<companyId>:ddi<ddiId>:dp<ddiProviderId>:<callId>
                if (!preg_match('/^trunks:b(\d+):c(\d+):/', (string) $key, $m)) {
                    continue;
                }
                $brandId = (int) $m[1];
                $companyId = (int) $m[2];
                if (!isset($anchor[$companyId])) {
                    $anchor[$companyId] = ['brandId' => $brandId, 'occ' => 0];
                }
                $anchor[$companyId]['occ']++;
            }

            if ($iterator === 0) {
                break;
            }
        }

        return $anchor;
    }

    /**
     * @param array<string> $rawEvents
     * @return array<array{type: string, ts: int, brandId: int, companyId: int, occ?: int, reason?: string}>
     */
    private function parseEvents(array $rawEvents): array
    {
        $events = [];
        foreach ($rawEvents as $raw) {
            $parts = explode(':', $raw);
            if (count($parts) < 4) {
                continue;
            }

            $type = $parts[0];
            $ts = (int) $parts[1];
            $brandId = (int) $parts[2];
            $companyId = (int) $parts[3];

            if (!in_array($type, ['A', 'H', 'B'], true) || $ts <= 0 || $brandId <= 0 || $companyId <= 0) {
                continue;
            }

            $event = ['type' => $type, 'ts' => $ts, 'brandId' => $brandId, 'companyId' => $companyId];

            if ($type === 'A' && isset($parts[4])) {
                $event['occ'] = (int) $parts[4];
            } elseif ($type === 'B' && isset($parts[4])) {
                $event['reason'] = $parts[4];
            }

            $events[] = $event;
        }

        return $events;
    }

    /**
     * Check if anchor is coherent (realtime service is up).
     * Incoherent = anchor has 0 keys but there are recent A events with occ > 0.
     *
     * @param array<int, array{brandId: int, occ: int}> $anchor
     * @param array<array{type: string, ts: int, brandId: int, companyId: int, occ?: int, reason?: string}> $processable
     */
    private function isAnchorCoherent(array $anchor, array $processable): bool
    {
        if (!empty($anchor)) {
            return true;
        }

        $recentThreshold = time() - 600;
        foreach ($processable as $event) {
            if ($event['type'] === 'A' && $event['ts'] >= $recentThreshold && ($event['occ'] ?? 0) > 0) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param array<array{type: string, ts: int, brandId: int, companyId: int, occ?: int, reason?: string}> $processable
     * @param array<int, array{brandId: int, occ: int}> $anchor
     * @return array<int, int> companyId => brandId
     */
    private function buildCompanyBrandMap(array $processable, array $anchor): array
    {
        $map = [];
        foreach ($anchor as $companyId => $info) {
            $map[$companyId] = $info['brandId'];
        }
        foreach ($processable as $event) {
            if (!isset($map[$event['companyId']])) {
                $map[$event['companyId']] = $event['brandId'];
            }
        }
        return $map;
    }

    /**
     * @param int[] $companyIds
     * @return array<int, int> companyId => maxCalls
     */
    private function loadCompanyMaxCalls(array $companyIds): array
    {
        $result = [];
        $companies = $this->companyRepository->findBy(['id' => $companyIds]);
        foreach ($companies as $company) {
            $result[(int) $company->getId()] = $company->getMaxCalls();
        }
        return $result;
    }

    /**
     * @param int[] $brandIds
     * @return array<int, int> brandId => maxCalls
     */
    private function loadBrandMaxCalls(array $brandIds): array
    {
        $result = [];
        $brands = $this->brandRepository->findBy(['id' => $brandIds]);
        foreach ($brands as $brand) {
            /** @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand */
            $result[(int) $brand->getId()] = $brand->getMaxCalls();
        }
        return $result;
    }

    /**
     * @param array<array{type:string, ts:int, brandId:int, companyId:int}> $events
     * @return array<array{type:string, ts:int, brandId:int, companyId:int}>
     */
    private function filterByCompany(array $events, int $companyId): array
    {
        return array_values(array_filter($events, fn($e) => $e['companyId'] === $companyId));
    }

    /**
     * Rewind from startOcc through events in reverse to get the occupancy before all events.
     * Events must be sorted oldest-first.
     *
     * @param array<array{type: string, ts: int, brandId: int, companyId: int, occ?: int, reason?: string}> $events
     */
    private function rewind(int $startOcc, array $events): int
    {
        $occ = $startOcc;
        foreach (array_reverse($events) as $event) {
            if ($event['type'] === 'A') {
                $occ = max(0, $occ - 1);
            } elseif ($event['type'] === 'H') {
                $occ++;
            }
            // B events do not change occupancy
        }
        return $occ;
    }

    /**
     * Forward pass: compute bucket records from events and opening occupancy.
     * Each entry pairs the persistable row with the bucket's end timestamp.
     *
     * @param array<array{type: string, ts: int, brandId: int, companyId: int, occ?: int, reason?: string}> $events
     * @return array<int, array{
     *   row: array{
     *     brandId: int,
     *     companyId: int,
     *     timestamp: \DateTimeInterface,
     *     peak: int,
     *     avgUsage: float,
     *     closingUsage: int,
     *     blockedByCompanyLimit: int,
     *     blockedByBrandLimit: int,
     *     maxCallsCompany: int,
     *     maxCallsBrand: int
     *   },
     *   bucketEnd: int
     * }>
     */
    private function forwardPass(
        array $events,
        int $openingOcc,
        int $brandId,
        int $companyId,
        int $maxCallsCompany,
        int $maxCallsBrand
    ): array {
        if (empty($events)) {
            return [];
        }

        usort($events, fn(array $a, array $b): int => (int) $a['ts'] - (int) $b['ts']);

        $rows = [];
        $currentOcc = $openingOcc;

        $firstBucket = (int) (floor($events[0]['ts'] / self::BUCKET_SIZE) * self::BUCKET_SIZE);
        $currentBucketTs = $firstBucket;
        $bucketEnd = $currentBucketTs + self::BUCKET_SIZE;

        $prevTs = $currentBucketTs;
        $peak = $currentOcc;
        $integral = 0.0;
        $blockedCompany = 0;
        $blockedBrand = 0;

        $finalizeAndReset = function () use (
            &$rows,
            &$prevTs,
            &$peak,
            &$integral,
            &$blockedCompany,
            &$blockedBrand,
            &$currentOcc,
            &$currentBucketTs,
            &$bucketEnd,
            $brandId,
            $companyId,
            $maxCallsCompany,
            $maxCallsBrand
        ): void {
            /** @var array<int, array{row: array{brandId: int, companyId: int, timestamp: \DateTimeInterface, peak: int, avgUsage: float, closingUsage: int, blockedByCompanyLimit: int, blockedByBrandLimit: int, maxCallsCompany: int, maxCallsBrand: int}, bucketEnd: int}> $rows */
            /** @var int $prevTs */
            /** @var int $peak */
            /** @var float $integral */
            /** @var int $blockedCompany */
            /** @var int $blockedBrand */
            /** @var int $currentOcc */
            /** @var int $currentBucketTs */
            /** @var int $bucketEnd */
            // Complete the bucket integral up to its end
            $integral += $currentOcc * ($bucketEnd - $prevTs);
            $avgUsage = $integral / self::BUCKET_SIZE;

            $rows[] = [
                'row' => $this->makeRow(
                    $brandId,
                    $companyId,
                    $currentBucketTs,
                    $peak,
                    $avgUsage,
                    $currentOcc,
                    $blockedCompany,
                    $blockedBrand,
                    $maxCallsCompany,
                    $maxCallsBrand
                ),
                'bucketEnd' => $bucketEnd,
            ];

            // Reset for next bucket
            $currentBucketTs = $bucketEnd;
            $bucketEnd = $currentBucketTs + self::BUCKET_SIZE;
            $prevTs = $currentBucketTs;
            $peak = $currentOcc;
            $integral = 0.0;
            $blockedCompany = 0;
            $blockedBrand = 0;
        };

        foreach ($events as $event) {
            // Advance through empty buckets before this event's bucket
            $eventBucket = (int) (floor($event['ts'] / self::BUCKET_SIZE) * self::BUCKET_SIZE);
            while ($currentBucketTs < $eventBucket) {
                $finalizeAndReset();
            }

            // Accumulate time within current bucket before this event
            /** @psalm-suppress UnusedVariable */
            $integral += $currentOcc * ($event['ts'] - $prevTs);
            $prevTs = $event['ts'];

            // Apply event
            if ($event['type'] === 'A') {
                $currentOcc = $event['occ'] ?? ($currentOcc + 1);
                $peak = max($peak, $currentOcc);
            } elseif ($event['type'] === 'H') {
                $currentOcc = max(0, $currentOcc - 1);
            } elseif ($event['type'] === 'B') {
                if (($event['reason'] ?? '') === 'brand') {
                    $blockedBrand++;
                } else {
                    $blockedCompany++;
                }
            }
        }

        // Finalize last bucket
        $finalizeAndReset();

        return $rows;
    }

    /**
     * @return array{brandId:int, companyId:int, timestamp:\DateTimeInterface, peak:int, avgUsage:float,
     *              closingUsage:int, blockedByCompanyLimit:int, blockedByBrandLimit:int,
     *              maxCallsCompany:int, maxCallsBrand:int}
     */
    private function makeRow(
        int $brandId,
        int $companyId,
        int $bucketTs,
        int $peak,
        float $avgUsage,
        int $closingUsage,
        int $blockedByCompanyLimit,
        int $blockedByBrandLimit,
        int $maxCallsCompany,
        int $maxCallsBrand
    ): array {
        return [
            'brandId' => $brandId,
            'companyId' => $companyId,
            'timestamp' => new \DateTime('@' . $bucketTs, new \DateTimeZone('UTC')),
            'peak' => $peak,
            'avgUsage' => $avgUsage,
            'closingUsage' => $closingUsage,
            'blockedByCompanyLimit' => $blockedByCompanyLimit,
            'blockedByBrandLimit' => $blockedByBrandLimit,
            'maxCallsCompany' => $maxCallsCompany,
            'maxCallsBrand' => $maxCallsBrand,
        ];
    }

    /**
     * @param array<array{
     *   brandId: int,
     *   companyId: int,
     *   timestamp: \DateTimeInterface,
     *   peak: int,
     *   avgUsage: float,
     *   closingUsage: int,
     *   maxCallsCompany: int,
     *   maxCallsBrand: int,
     *   blockedByCompanyLimit: int,
     *   blockedByBrandLimit: int
     * }> $rows
     */
    private function persistRows(array $rows): void
    {
        foreach (array_chunk($rows, self::PERSIST_BATCH_SIZE) as $chunk) {
            foreach ($chunk as $row) {
                $this->persistRow($row);
            }

            // Let errors bubble up: the event queue is only trimmed on success,
            // so the next run will reprocess and rewrite the very same buckets
            $this->entityTools->dispatchQueuedOperations();
            $this->entityTools->clearExcept(
                Commandlog::class
            );
        }
    }

    /**
     * @param array{
     *   brandId: int,
     *   companyId: int,
     *   timestamp: \DateTimeInterface,
     *   peak: int,
     *   avgUsage: float,
     *   closingUsage: int,
     *   maxCallsCompany: int,
     *   maxCallsBrand: int,
     *   blockedByCompanyLimit: int,
     *   blockedByBrandLimit: int
     * } $row
     */
    private function persistRow(array $row): void
    {
        $channelUsage = $this
            ->channelUsageRepository
            ->findOneByCompanyAndTimestamp(
                $row['companyId'],
                $row['timestamp']
            );

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

    private function purgeOldRows(): void
    {
        $utc = new \DateTimeZone('UTC');
        $cutoff = new \DateTime('now', $utc);
        $cutoff->modify(sprintf('-%d days', self::RETENTION_DAYS));

        do {
            $affected = $this->channelUsageRepository->purgeOlderThan($cutoff, self::PURGE_BATCH_SIZE);
            if ($affected > 0) {
                sleep(1);
            }
        } while ($affected >= self::PURGE_BATCH_SIZE);
    }
}
