<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\ChannelUsage;

/**
 * Mutable accumulator for a single channel usage bucket.
 *
 * Replaces what would otherwise be a by-reference closure over a handful of loose
 * counters: keeping the state in typed properties is what lets the calculator stay
 * statically analysable without suppressions.
 */
final class ChannelUsageBucketAccumulator
{
    private int $bucketEnd;
    private int $prevTs;
    private int $peak;
    private float $integral = 0.0;
    private int $blockedByCompanyLimit = 0;
    private int $blockedByBrandLimit = 0;

    public function __construct(
        private int $bucketTs,
        private int $bucketSize,
        private int $occupancy
    ) {
        $this->bucketEnd = $bucketTs + $bucketSize;
        $this->prevTs = $bucketTs;
        $this->peak = $occupancy;
    }

    public function getBucketTs(): int
    {
        return $this->bucketTs;
    }

    public function getBucketEnd(): int
    {
        return $this->bucketEnd;
    }

    public function getOccupancy(): int
    {
        return $this->occupancy;
    }

    public function getPeak(): int
    {
        return $this->peak;
    }

    public function getBlockedByCompanyLimit(): int
    {
        return $this->blockedByCompanyLimit;
    }

    public function getBlockedByBrandLimit(): int
    {
        return $this->blockedByBrandLimit;
    }

    /**
     * Time-weighted occupancy over the bucket, so a channel held for half the bucket
     * counts as half a channel.
     */
    public function getAverageUsage(): float
    {
        return $this->integral / $this->bucketSize;
    }

    /**
     * Accrue occupancy-time up to $ts. Timestamps must arrive in ascending order;
     * out-of-order input would subtract time, so the caller sorts beforehand.
     */
    public function accrueUntil(int $ts): void
    {
        if ($ts <= $this->prevTs) {
            return;
        }

        $this->integral += $this->occupancy * ($ts - $this->prevTs);
        $this->prevTs = $ts;
    }

    /**
     * An 'A' event: a channel was admitted. Kamailio ships the resulting occupancy,
     * which wins over our own running count when present.
     */
    public function admit(?int $occupancy): void
    {
        $this->occupancy = $occupancy ?? ($this->occupancy + 1);
        $this->peak = max($this->peak, $this->occupancy);
    }

    /**
     * An 'H' event: a counted channel was released.
     */
    public function hangup(): void
    {
        $this->occupancy = max(0, $this->occupancy - 1);
    }

    /**
     * A 'B' event: a call was rejected by a max-channel limit. Does not alter occupancy.
     */
    public function block(string $reason): void
    {
        if ($reason === 'brand') {
            $this->blockedByBrandLimit++;

            return;
        }

        $this->blockedByCompanyLimit++;
    }

    /**
     * Complete the integral up to the bucket's end. Call before reading getAverageUsage().
     */
    public function seal(): void
    {
        $this->accrueUntil($this->bucketEnd);
    }

    /**
     * Accumulator for the following bucket, carrying occupancy over as its opening value.
     */
    public function next(): self
    {
        return new self(
            $this->bucketEnd,
            $this->bucketSize,
            $this->occupancy
        );
    }
}
