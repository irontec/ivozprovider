<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Service\ChannelUsage;

use Ivoz\Provider\Domain\Model\Brand\BrandRepository;
use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsageEvent;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Psr\Log\LoggerInterface;

/**
 * Builds the persistable channel usage rows for every company seen in a collection run.
 *
 * Owns the per-company bookkeeping around the pure calculator: who the buckets belong to,
 * which limits applied, whether the live anchor can be trusted, and filling the buckets that
 * elapsed with no events at all.
 *
 * @phpstan-type ChannelUsageRow array{brandId: int, companyId: int, timestamp: \DateTimeInterface, peak: int, avgUsage: float, closingUsage: int, blockedByCompanyLimit: int, blockedByBrandLimit: int, maxCallsCompany: int, maxCallsBrand: int}
 * @phpstan-type ChannelUsageBucket array{bucketTs: int, bucketEnd: int, peak: int, avgUsage: float, closingUsage: int, blockedByCompanyLimit: int, blockedByBrandLimit: int}
 */
class ChannelUsageRowBuilder
{
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
        private ChannelUsageBucketCalculator $calculator,
        private CompanyRepository $companyRepository,
        private BrandRepository $brandRepository,
        private LoggerInterface $logger
    ) {
    }

    /**
     * @param array<int, ChannelUsageEvent> $processable events of buckets already closed
     * @param array<int, ChannelUsageEvent> $deferred events of the bucket still open
     * @param array<int, array{brandId: int, occ: int}> $anchor live occupancy per company
     * @return array<int, ChannelUsageRow>
     */
    public function build(
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

            $rows = array_merge(
                $rows,
                $this->buildCompanyRows(
                    $companyId,
                    $brandId,
                    $limits,
                    $this->filterByCompany($processable, $companyId),
                    $this->filterByCompany($deferred, $companyId),
                    $anchor[$companyId]['occ'] ?? 0,
                    $anchorCoherent,
                    $bucketStart
                )
            );
        }

        return $rows;
    }

    /**
     * @param array{maxCallsCompany: int, maxCallsBrand: int} $limits
     * @param array<int, ChannelUsageEvent> $processable
     * @param array<int, ChannelUsageEvent> $deferred
     * @return array<int, ChannelUsageRow>
     */
    private function buildCompanyRows(
        int $companyId,
        int $brandId,
        array $limits,
        array $processable,
        array $deferred,
        int $anchorOccupancy,
        bool $anchorCoherent,
        int $bucketStart
    ): array {
        // The anchor is a *live* snapshot: rewind it past the still-open bucket first.
        $occupancyAtBucketStart = $this->calculator->rewind(
            $anchorOccupancy,
            $deferred
        );

        if (empty($processable)) {
            if (!$anchorCoherent || $occupancyAtBucketStart < 1) {
                return [];
            }

            // Nothing happened, but channels are up: record the bucket that just closed.
            return [
                $this->toRow(
                    $this->calculator->idleBucket(
                        $bucketStart - ChannelUsageBucketCalculator::BUCKET_SIZE,
                        $occupancyAtBucketStart
                    ),
                    $brandId,
                    $companyId,
                    $limits
                )
            ];
        }

        $openingOccupancy = $this->calculator->rewind(
            $occupancyAtBucketStart,
            $processable
        );

        $buckets = $this->calculator->calculate($processable, $openingOccupancy);

        $rows = [];
        foreach ($buckets as $bucket) {
            $rows[] = $this->toRow($bucket, $brandId, $companyId, $limits);
        }

        return array_merge(
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

    /**
     * Buckets between the last event and the current open bucket got no events at all, but
     * the channels that were up stayed up: emit them so the history has no holes.
     *
     * @param array<int, ChannelUsageBucket> $buckets
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
     * @param ChannelUsageBucket $bucket
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
                $event->isAdmission()
                && $event->getTimestamp() >= $recentThreshold
                && ($event->getOccupancy() ?? 0) > 0;

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
            if (!isset($map[$event->getCompanyId()])) {
                $map[$event->getCompanyId()] = $event->getBrandId();
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
                fn (ChannelUsageEvent $event): bool => $event->belongsTo($companyId)
            )
        );
    }
}
