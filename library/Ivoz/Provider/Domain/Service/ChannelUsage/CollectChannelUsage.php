<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Service\ChannelUsage;

use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Job\ChannelUsageEventQueueInterface;
use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsageEvent;

/**
 * Collects channel usage into closed 5-minute buckets.
 *
 * Reads a bounded slice of the event queue, splits it into buckets that are already closed
 * and the one still open, hands the arithmetic to the row builder and the rows to the writer,
 * and only then consumes what it read.
 */
class CollectChannelUsage
{
    /**
     * Upper bound on how much of the queue a single run pulls into memory. A backlog larger
     * than this is drained over consecutive runs rather than risking the collector's memory.
     */
    public const MAX_ENTRIES_PER_RUN = 50000;

    public function __construct(
        private ChannelUsageEventQueueInterface $eventQueue,
        private TrunksClientInterface $trunksClient,
        private ChannelUsageEventParser $eventParser,
        private ChannelUsageBucketCalculator $calculator,
        private ChannelUsageRowBuilder $rowBuilder,
        private ChannelUsageWriter $channelUsageWriter
    ) {
    }

    public function execute(): void
    {
        $now = time();
        $bucketStart = $this->calculator->bucketStart($now);

        $rawEntries = $this->eventQueue->readPending(self::MAX_ENTRIES_PER_RUN);
        $entryCount = count($rawEntries);

        $anchor = $this->trunksClient->getActiveCallsGroupedByCompany();
        $events = $this->eventParser->parse($rawEntries);

        $processable = [];
        $deferred = [];
        foreach ($events as $event) {
            if ($event->happenedBefore($bucketStart)) {
                $processable[] = $event;
                continue;
            }

            $deferred[] = $event;
        }

        if (!empty($processable) || !empty($anchor)) {
            $rows = $this->rowBuilder->build(
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
            array_map(
                fn (ChannelUsageEvent $event): string => $event->getWire(),
                $deferred
            )
        );
    }
}
