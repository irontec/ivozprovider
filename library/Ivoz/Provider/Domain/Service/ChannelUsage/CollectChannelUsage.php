<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Service\ChannelUsage;

use Ivoz\Provider\Domain\Job\ChannelUsageEventQueueInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandRepository;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Psr\Log\LoggerInterface;

/**
 * Collects channel usage into closed 5-minute buckets.
 *
 * Reads the event queue through a port, reconstructs each company's occupancy by rewinding
 * from the live realtime anchor back to the start of the oldest closed bucket, then replays
 * forward to obtain peak, time-weighted average and closing occupancy per bucket.
 *
 * @phpstan-type ChannelUsageEvent array{type: string, ts: int, brandId: int, companyId: int, occ: int|null, reason: string, raw: string}
 * @phpstan-type ChannelUsageRow array{brandId: int, companyId: int, timestamp: \DateTimeInterface, peak: int, avgUsage: float, closingUsage: int, blockedByCompanyLimit: int, blockedByBrandLimit: int, maxCallsCompany: int, maxCallsBrand: int}
 */
class CollectChannelUsage
{
    /**
     * Upper bound on how much of the queue a single run pulls into memory. A backlog larger
     * than this is drained over consecutive runs rather than risking the collector's memory.
     */
    public const MAX_ENTRIES_PER_RUN = 50000;

    /**
     * Ceiling on gap filling (a day's worth of buckets). Without it, a backlog whose newest
     * event is old would emit one row per bucket for every 5 minutes elapsed since.
     */
    public const MAX_TRAILING_BUCKETS = 288;

    /**
     * An empty anchor is only trustworthy if no call was admitted recently: otherwise the
     * realtime service is presumably down and its keyspace lies.
     */
    private const ANCHOR_COHERENCE_WINDOW = 600;

    public function __construct(
        private ChannelUsageEventQueueInterface $eventQueue,
        private ChannelUsageEventParser $eventParser,
        private ChannelUsageBucketCalculator $calculator,
        private CompanyRepository $companyRepository,
        private BrandRepository $brandRepository,
        private ChannelUsageWriter $channelUsageWriter,
        private LoggerInterface $logger
    ) {
    }

    public function execute(): void
    {
        $now = time();
        $bucketStart = $this->calculator->bucketStart($now);

        $rawEntries = $this->eventQueue->readPending(self::MAX_ENTRIES_PER_RUN);
        $entryCount = count($rawEntries);

        $anchor = $this->eventQueue->getActiveChannelsByCompany();
        $events = $this->eventParser->parse($rawEntries);

        $processable = [];
        $deferred = [];
        foreach ($events as $event) {
            if ($event['ts'] < $bucketStart) {
                $processable[] = $event;
                continue;
            }

            $deferred[] = $event;
        }

        if (!empty($processable) || !empty($anchor)) {
            $rows = $this->buildRows(
                $processable,
                $deferred,
                $anchor,
                $bucketStart,
                $now
            );

            if (!empty($rows)) {
                $this->channelUsageWriter->write($rows);
            }
        }

        // Only once the rows above are durably written: a failure leaves the queue intact so
        // the next run recomputes the very same buckets.
        $this->drainQueue($entryCount, $deferred);
    }

    /**
     * Consume the window that was read, putting back the events whose bucket is still open.
     *
     * The queue is trimmed by the number of *raw entries read*, never by the number of events
     * parsed: malformed entries are dropped by the parser and would otherwise shift the
     * offset permanently.
     *
     * @param array<int, ChannelUsageEvent> $deferred
     */
    private function drainQueue(int $entryCount, array $deferred): void
    {
        if ($entryCount < 1) {
            return;
        }

        // Everything we read still belongs to the open bucket: leave the queue untouched.
        if (count($deferred) === $entryCount) {
            return;
        }

        // Not atomic: a crash between the two loses the open-bucket events, which costs at
        // most the current bucket's precision for the affected companies. The reverse order
        // would trade that for double counting, which corrupts closed buckets instead.
        $this->eventQueue->discardProcessed($entryCount);
        $this->eventQueue->requeue(
            array_column($deferred, 'raw')
        );
    }

    /**
     * @param array<int, ChannelUsageEvent> $processable
     * @param array<int, ChannelUsageEvent> $deferred
     * @param array<int, array{brandId: int, occ: int}> $anchor
     * @return array<int, ChannelUsageRow>
     */
    private function buildRows(
        array $processable,
        array $deferred,
        array $anchor,
        int $bucketStart,
        int $now
    ): array {
        $companyBrandMap = $this->buildCompanyBrandMap($processable, $anchor);

        if (empty($companyBrandMap)) {
            return [];
        }

        $anchorCoherent = $this->isAnchorCoherent($anchor, $processable, $now);
        if (!$anchorCoherent) {
            $this->logger->warning(
                'ChannelUsage: anchor has 0 keys but recent A-events exist.'
                . ' ivozprovider-realtime may be down. Skipping anchor reconciliation.'
            );
        }

        $maxCallsCompany = $this->loadCompanyMaxCalls(
            array_keys($companyBrandMap)
        );
        $maxCallsBrand = $this->loadBrandMaxCalls(
            array_unique(array_values($companyBrandMap))
        );

        $rows = [];

        foreach ($companyBrandMap as $companyId => $brandId) {
            $limits = [
                'maxCallsCompany' => $maxCallsCompany[$companyId] ?? 0,
                'maxCallsBrand' => $maxCallsBrand[$brandId] ?? 0
            ];

            $companyDeferred = $this->filterByCompany($deferred, $companyId);
            $companyProcessable = $this->filterByCompany($processable, $companyId);

            $anchorOccupancy = $anchor[$companyId]['occ'] ?? 0;

            // The anchor is a *live* snapshot: rewind it past the still-open bucket first.
            $occupancyAtBucketStart = $this->calculator->rewind(
                $anchorOccupancy,
                $companyDeferred
            );

            if (empty($companyProcessable)) {
                if ($anchorCoherent && $occupancyAtBucketStart > 0) {
                    $rows[] = $this->toRow(
                        $this->calculator->idleBucket(
                            $bucketStart - ChannelUsageBucketCalculator::BUCKET_SIZE,
                            $occupancyAtBucketStart
                        ),
                        $brandId,
                        $companyId,
                        $limits
                    );
                }

                continue;
            }

            $openingOccupancy = $this->calculator->rewind(
                $occupancyAtBucketStart,
                $companyProcessable
            );

            $buckets = $this->calculator->calculate(
                $companyProcessable,
                $openingOccupancy
            );

            foreach ($buckets as $bucket) {
                $rows[] = $this->toRow($bucket, $brandId, $companyId, $limits);
            }

            $rows = array_merge(
                $rows,
                $this->fillTrailingBuckets(
                    $buckets,
                    $bucketStart,
                    $anchorCoherent,
                    $brandId,
                    $companyId,
                    $limits
                )
            );
        }

        return $rows;
    }

    /**
     * Buckets between the last event and the current open bucket got no events at all, but
     * the channels that were up stayed up: emit them so the history has no holes.
     *
     * @param array<int, array{bucketTs: int, bucketEnd: int, peak: int, avgUsage: float, closingUsage: int, blockedByCompanyLimit: int, blockedByBrandLimit: int}> $buckets
     * @param array{maxCallsCompany: int, maxCallsBrand: int} $limits
     * @return array<int, ChannelUsageRow>
     */
    private function fillTrailingBuckets(
        array $buckets,
        int $bucketStart,
        bool $anchorCoherent,
        int $brandId,
        int $companyId,
        array $limits
    ): array {
        $lastBucket = end($buckets);

        if (!$anchorCoherent || $lastBucket === false) {
            return [];
        }

        $occupancy = $lastBucket['closingUsage'];

        if ($occupancy < 1) {
            return [];
        }

        $rows = [];
        for ($ts = $lastBucket['bucketEnd']; $ts < $bucketStart; $ts += ChannelUsageBucketCalculator::BUCKET_SIZE) {
            if (count($rows) >= self::MAX_TRAILING_BUCKETS) {
                $this->logger->warning(
                    sprintf(
                        'ChannelUsage: stopped filling idle buckets for company %d after %d of them.'
                        . ' The queue backlog looks older than the gap filling is meant to cover.',
                        $companyId,
                        self::MAX_TRAILING_BUCKETS
                    )
                );

                break;
            }

            $rows[] = $this->toRow(
                $this->calculator->idleBucket($ts, $occupancy),
                $brandId,
                $companyId,
                $limits
            );
        }

        return $rows;
    }

    /**
     * @param array{bucketTs: int, bucketEnd: int, peak: int, avgUsage: float, closingUsage: int, blockedByCompanyLimit: int, blockedByBrandLimit: int} $bucket
     * @param array{maxCallsCompany: int, maxCallsBrand: int} $limits
     * @return ChannelUsageRow
     */
    private function toRow(array $bucket, int $brandId, int $companyId, array $limits): array
    {
        return [
            'brandId' => $brandId,
            'companyId' => $companyId,
            'timestamp' => new \DateTime(
                '@' . $bucket['bucketTs'],
                new \DateTimeZone('UTC')
            ),
            'peak' => $bucket['peak'],
            'avgUsage' => $bucket['avgUsage'],
            'closingUsage' => $bucket['closingUsage'],
            'blockedByCompanyLimit' => $bucket['blockedByCompanyLimit'],
            'blockedByBrandLimit' => $bucket['blockedByBrandLimit'],
            'maxCallsCompany' => $limits['maxCallsCompany'],
            'maxCallsBrand' => $limits['maxCallsBrand']
        ];
    }

    /**
     * @param array<int, array{brandId: int, occ: int}> $anchor
     * @param array<int, ChannelUsageEvent> $processable
     */
    private function isAnchorCoherent(array $anchor, array $processable, int $now): bool
    {
        if (!empty($anchor)) {
            return true;
        }

        $recentThreshold = $now - self::ANCHOR_COHERENCE_WINDOW;

        foreach ($processable as $event) {
            $isRecentAdmission =
                $event['type'] === ChannelUsageEventParser::TYPE_ADMITTED
                && $event['ts'] >= $recentThreshold
                && ($event['occ'] ?? 0) > 0;

            if ($isRecentAdmission) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param array<int, ChannelUsageEvent> $processable
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
     * @param array<int, int> $companyIds
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
     * @param array<int, int> $brandIds
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
     * @param array<int, ChannelUsageEvent> $events
     * @return array<int, ChannelUsageEvent>
     */
    private function filterByCompany(array $events, int $companyId): array
    {
        return array_values(
            array_filter(
                $events,
                fn (array $event): bool => $event['companyId'] === $companyId
            )
        );
    }
}
