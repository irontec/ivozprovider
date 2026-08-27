<?php

namespace Ivoz\Provider\Infrastructure\Redis\Job;

use Ivoz\Core\Infrastructure\Persistence\Redis\RedisMasterFactory;
use Ivoz\Provider\Domain\Job\ChannelUsageEventQueueInterface;

class ChannelUsageEventQueue implements ChannelUsageEventQueueInterface
{
    /**
     * The db kamtrunks pushes to, per its ndb_redis server config.
     */
    public const REDIS_DB = 1;

    public function __construct(
        private RedisMasterFactory $redisMasterFactory
    ) {
    }

    /**
     * @return array<int, string>
     */
    public function readPending(int $maxEntries): array
    {
        if ($maxEntries < 1) {
            return [];
        }

        $redis = $this->redisMasterFactory->create(self::REDIS_DB);

        try {
            /** @var array<int, string>|false $entries */
            $entries = $redis->lrange(
                self::QUEUE_KEY,
                0,
                $maxEntries - 1
            );
        } finally {
            $redis->close();
        }

        return is_array($entries)
            ? $entries
            : [];
    }

    public function discardProcessed(int $entryCount): void
    {
        if ($entryCount < 1) {
            return;
        }

        $redis = $this->redisMasterFactory->create(self::REDIS_DB);

        try {
            $redis->ltrim(
                self::QUEUE_KEY,
                $entryCount,
                -1
            );
        } finally {
            $redis->close();
        }
    }

    /**
     * @param array<int, string> $rawEntries
     */
    public function requeue(array $rawEntries): void
    {
        if (empty($rawEntries)) {
            return;
        }

        $redis = $this->redisMasterFactory->create(self::REDIS_DB);

        try {
            foreach ($rawEntries as $rawEntry) {
                $redis->rpush(
                    self::QUEUE_KEY,
                    $rawEntry
                );
            }
        } finally {
            $redis->close();
        }
    }
}
