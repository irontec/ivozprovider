<?php

namespace Ivoz\Provider\Domain\Job;

interface ChannelUsageEventQueueInterface
{
    public const QUEUE_KEY = 'chusage:events';

    /**
     * Read up to $maxEntries raw entries from the head of the queue, without removing them.
     *
     * Entries are returned verbatim: parsing (and discarding malformed ones) is the caller's
     * job, so that the number of entries actually consumed stays decoupled from the number of
     * events successfully parsed.
     *
     * @return array<int, string>
     */
    public function readPending(int $maxEntries): array;

    /**
     * Remove exactly $entryCount raw entries from the head of the queue.
     *
     * Must be called only after the caller has durably processed them, and always with the
     * count of *raw entries read*, never with a count of parsed events.
     */
    public function discardProcessed(int $entryCount): void;

    /**
     * Append raw entries back to the tail of the queue.
     *
     * Used for entries that were read but belong to a bucket that is still open, so they are
     * re-processed on a later run. Consumers sort by timestamp, so the tail position is safe.
     *
     * @param array<int, string> $rawEntries
     */
    public function requeue(array $rawEntries): void;
}
