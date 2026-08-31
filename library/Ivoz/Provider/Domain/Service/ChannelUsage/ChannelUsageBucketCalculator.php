<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Service\ChannelUsage;

use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsageBucketAccumulator;
use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsageEvent;

/**
 * Turns a company's channel usage event stream into per-bucket metrics.
 *
 * Deliberately free of Redis, repositories and the clock: it is pure arithmetic over
 * events, which is what makes the interesting part of channel usage collection specable.
 *
 * @phpstan-type ChannelUsageBucket array{bucketTs: int, bucketEnd: int, peak: int, avgUsage: float, closingUsage: int, blockedByCompanyLimit: int, blockedByBrandLimit: int}
 */
class ChannelUsageBucketCalculator
{
    public const BUCKET_SIZE = 300;

    /**
     * Timestamp of the bucket a given instant falls into.
     */
    public function bucketStart(int $timestamp): int
    {
        return (int) (floor($timestamp / self::BUCKET_SIZE) * self::BUCKET_SIZE);
    }

    /**
     * Walk $events backwards from a known occupancy to recover the occupancy held before
     * any of them happened.
     *
     * The clamp at zero makes the result order-dependent, so events are sorted here rather
     * than trusting the order they were queued in.
     *
     * @param array<int, ChannelUsageEvent> $events
     */
    public function rewind(int $startOccupancy, array $events): int
    {
        $events = $this->sortByTimestamp($events);
        $occupancy = $startOccupancy;

        foreach (array_reverse($events) as $event) {
            if ($event->isAdmission()) {
                $occupancy = max(0, $occupancy - 1);
            } elseif ($event->isHangup()) {
                $occupancy++;
            }
            // Blocks are rejections: they never changed occupancy
        }

        return $occupancy;
    }

    /**
     * Replay $events forward from $openingOccupancy, emitting one entry per bucket touched.
     * Buckets with no events in between are emitted too, carrying occupancy over.
     *
     * @param array<int, ChannelUsageEvent> $events
     * @return array<int, ChannelUsageBucket>
     */
    public function calculate(array $events, int $openingOccupancy): array
    {
        if (empty($events)) {
            return [];
        }

        $events = $this->sortByTimestamp($events);

        $accumulator = new ChannelUsageBucketAccumulator(
            $this->bucketStart($events[0]->getTimestamp()),
            self::BUCKET_SIZE,
            $openingOccupancy
        );

        $buckets = [];

        foreach ($events as $event) {
            $eventBucket = $this->bucketStart($event->getTimestamp());

            while ($accumulator->getBucketTs() < $eventBucket) {
                $accumulator->seal();
                $buckets[] = $this->toBucket($accumulator);
                $accumulator = $accumulator->next();
            }

            $accumulator->accrueUntil($event->getTimestamp());

            if ($event->isAdmission()) {
                $accumulator->admit($event->getOccupancy());
            } elseif ($event->isHangup()) {
                $accumulator->hangup();
            } elseif ($event->isBlock()) {
                $accumulator->block($event->isBlockedByBrand());
            }
        }

        $accumulator->seal();
        $buckets[] = $this->toBucket($accumulator);

        return $buckets;
    }

    /**
     * A bucket in which nothing happened but $occupancy channels stayed up.
     *
     * @return ChannelUsageBucket
     */
    public function idleBucket(int $bucketTs, int $occupancy): array
    {
        return [
            'bucketTs' => $bucketTs,
            'bucketEnd' => $bucketTs + self::BUCKET_SIZE,
            'peak' => $occupancy,
            'avgUsage' => (float) $occupancy,
            'closingUsage' => $occupancy,
            'blockedByCompanyLimit' => 0,
            'blockedByBrandLimit' => 0
        ];
    }

    /**
     * @return ChannelUsageBucket
     */
    private function toBucket(ChannelUsageBucketAccumulator $accumulator): array
    {
        return [
            'bucketTs' => $accumulator->getBucketTs(),
            'bucketEnd' => $accumulator->getBucketEnd(),
            'peak' => $accumulator->getPeak(),
            'avgUsage' => $accumulator->getAverageUsage(),
            'closingUsage' => $accumulator->getOccupancy(),
            'blockedByCompanyLimit' => $accumulator->getBlockedByCompanyLimit(),
            'blockedByBrandLimit' => $accumulator->getBlockedByBrandLimit()
        ];
    }

    /**
     * @param array<int, ChannelUsageEvent> $events
     * @return array<int, ChannelUsageEvent>
     */
    private function sortByTimestamp(array $events): array
    {
        usort(
            $events,
            fn (ChannelUsageEvent $a, ChannelUsageEvent $b): int
                => $a->getTimestamp() <=> $b->getTimestamp()
        );

        return $events;
    }
}
