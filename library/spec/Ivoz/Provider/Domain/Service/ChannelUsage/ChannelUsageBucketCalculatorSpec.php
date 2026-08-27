<?php

namespace spec\Ivoz\Provider\Domain\Service\ChannelUsage;

use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsageEvent;
use Ivoz\Provider\Domain\Service\ChannelUsage\ChannelUsageBucketCalculator;
use PhpSpec\ObjectBehavior;

class ChannelUsageBucketCalculatorSpec extends ObjectBehavior
{
    /**
     * 2026-01-01 00:00:00 UTC, already bucket-aligned (divisible by 300).
     */
    private const BUCKET = 1767225600;

    function it_is_initializable()
    {
        $this->shouldHaveType(ChannelUsageBucketCalculator::class);
    }

    function it_floors_timestamps_to_their_bucket()
    {
        $this->bucketStart(self::BUCKET + 1)->shouldBe(self::BUCKET);
        $this->bucketStart(self::BUCKET + 299)->shouldBe(self::BUCKET);
        $this->bucketStart(self::BUCKET + 300)->shouldBe(self::BUCKET + 300);
    }

    function it_rewinds_admissions_and_hangups_to_the_prior_occupancy()
    {
        // Two calls came up and one dropped, so before all this there was 1 channel up.
        $events = [
            $this->admitted(self::BUCKET + 10, 2),
            $this->admitted(self::BUCKET + 20, 3),
            $this->hangup(self::BUCKET + 30),
        ];

        $this->rewind(2, $events)->shouldBe(1);
    }

    function it_ignores_blocked_events_when_rewinding()
    {
        $events = [
            $this->blocked(self::BUCKET + 10, 'company'),
            $this->blocked(self::BUCKET + 20, 'brand'),
        ];

        $this->rewind(5, $events)->shouldBe(5);
    }

    function it_rewinds_the_same_regardless_of_the_order_events_were_queued_in()
    {
        $ordered = [
            $this->admitted(self::BUCKET + 10, 1),
            $this->hangup(self::BUCKET + 20),
            $this->admitted(self::BUCKET + 30, 1),
        ];

        $shuffled = [
            $ordered[2],
            $ordered[0],
            $ordered[1],
        ];

        // The clamp at zero makes this order-sensitive unless the calculator sorts first,
        // and the queue does not guarantee timestamp order.
        $this->rewind(1, $ordered)->shouldBe(0);
        $this->rewind(1, $shuffled)->shouldBe(0);
    }

    function it_never_rewinds_below_zero()
    {
        $events = [
            $this->admitted(self::BUCKET + 10, 1),
            $this->admitted(self::BUCKET + 20, 2),
        ];

        $this->rewind(0, $events)->shouldBe(0);
    }

    function it_returns_no_buckets_without_events()
    {
        $this->calculate([], 0)->shouldBe([]);
    }

    function it_computes_peak_average_and_closing_usage()
    {
        // One channel up for the second half of the bucket only.
        $events = [
            $this->admitted(self::BUCKET + 150, 1),
        ];

        $this
            ->calculate($events, 0)
            ->shouldBeLike([
                $this->bucket(self::BUCKET, 1, 0.5, 1),
            ]);
    }

    function it_carries_occupancy_into_untouched_buckets()
    {
        // A channel comes up in the first bucket and is still up two buckets later:
        // the bucket in between saw no events at all but must not be a hole.
        $events = [
            $this->admitted(self::BUCKET, 1),
            $this->hangup(self::BUCKET + 600),
        ];

        $this
            ->calculate($events, 0)
            ->shouldBeLike([
                $this->bucket(self::BUCKET, 1, 1.0, 1),
                $this->bucket(self::BUCKET + 300, 1, 1.0, 1),
                $this->bucket(self::BUCKET + 600, 1, 0.0, 0),
            ]);
    }

    function it_counts_blocked_calls_per_limit_without_touching_occupancy()
    {
        $events = [
            $this->blocked(self::BUCKET + 10, 'company'),
            $this->blocked(self::BUCKET + 20, 'brand'),
            $this->blocked(self::BUCKET + 30, 'company'),
        ];

        $this
            ->calculate($events, 2)
            ->shouldBeLike([
                $this->bucket(self::BUCKET, 2, 2.0, 2, 2, 1),
            ]);
    }

    function it_trusts_the_occupancy_reported_by_kamailio_over_its_own_count()
    {
        // Kamailio ships the resulting occupancy, which wins over our running count.
        $events = [
            $this->admitted(self::BUCKET + 10, 7),
        ];

        $this
            ->calculate($events, 0)
            ->shouldBeLike([
                $this->bucket(self::BUCKET, 7, 2030 / 300, 7),
            ]);
    }

    function it_sorts_events_before_replaying_them()
    {
        $shuffled = [
            $this->hangup(self::BUCKET + 200),
            $this->admitted(self::BUCKET + 100, 1),
        ];

        // Replayed in the wrong order the hangup would clamp to 0 and the admission would
        // leave the bucket closing at 1 instead of 0.
        $this
            ->calculate($shuffled, 0)
            ->shouldBeLike([
                $this->bucket(self::BUCKET, 1, 100 / 300, 0),
            ]);
    }

    function it_builds_idle_buckets_holding_a_steady_occupancy()
    {
        $this
            ->idleBucket(self::BUCKET, 3)
            ->shouldBeLike(
                $this->bucket(self::BUCKET, 3, 3.0, 3)
            );
    }

    /**
     * @return array<string, int|float>
     */
    private function bucket(
        $bucketTs,
        $peak,
        $avgUsage,
        $closingUsage,
        $blockedByCompanyLimit = 0,
        $blockedByBrandLimit = 0
    ) {
        return [
            'bucketTs' => $bucketTs,
            'bucketEnd' => $bucketTs + 300,
            'peak' => $peak,
            'avgUsage' => $avgUsage,
            'closingUsage' => $closingUsage,
            'blockedByCompanyLimit' => $blockedByCompanyLimit,
            'blockedByBrandLimit' => $blockedByBrandLimit
        ];
    }

    private function admitted($ts, $occ)
    {
        return ChannelUsageEvent::fromWire('A:' . $ts . ':1:2:' . $occ);
    }

    private function hangup($ts)
    {
        return ChannelUsageEvent::fromWire('H:' . $ts . ':1:2');
    }

    private function blocked($ts, $reason)
    {
        return ChannelUsageEvent::fromWire('B:' . $ts . ':1:2:' . $reason);
    }
}
