<?php

namespace Ivoz\Provider\Infrastructure\Redis\Job;

use Ivoz\Core\Infrastructure\Persistence\Redis\RedisMasterFactory;
use Ivoz\Provider\Domain\Job\ChannelUsageEventQueueInterface;
use Psr\Log\LoggerInterface;

class ChannelUsageEventQueue implements ChannelUsageEventQueueInterface
{
    public const REDIS_DB = 1;
    public const REDIS_SCAN_COUNT = 1000;
    public const TRUNKS_KEY_PATTERN = 'trunks:*';

    /**
     * trunks:b<brandId>:c<companyId>:ddi<ddiId>:cr<carrierId>:<callId>
     * trunks:b<brandId>:c<companyId>:ddi<ddiId>:dp<ddiProviderId>:<callId>
     */
    private const TRUNKS_KEY_REGEXP = '/^trunks:b(\d+):c(\d+):/';

    public function __construct(
        private RedisMasterFactory $redisMasterFactory,
        private LoggerInterface $logger
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

    /**
     * @return array<int, array{brandId: int, occ: int}>
     */
    public function getActiveChannelsByCompany(): array
    {
        $activeChannels = [];
        $redis = $this->redisMasterFactory->create(self::REDIS_DB);

        try {
            /** @var int|null $scanIterator */
            $scanIterator = null;

            while (true) {
                $keys = $redis->scan(
                    $scanIterator,
                    self::TRUNKS_KEY_PATTERN,
                    self::REDIS_SCAN_COUNT
                );

                if (!is_array($keys)) {
                    break;
                }

                foreach ($keys as $key) {
                    $matches = [];
                    if (!preg_match(self::TRUNKS_KEY_REGEXP, (string) $key, $matches)) {
                        continue;
                    }

                    $brandId = (int) $matches[1];
                    $companyId = (int) $matches[2];

                    if (!isset($activeChannels[$companyId])) {
                        $activeChannels[$companyId] = [
                            'brandId' => $brandId,
                            'occ' => 0
                        ];
                    }

                    $activeChannels[$companyId]['occ']++;
                }

                if ($scanIterator === 0) {
                    break;
                }
            }

            return $activeChannels;
        } catch (\Exception $e) {
            $this->logger->error(
                'ChannelUsage: unable to scan the realtime keyspace: ' . $e->getMessage()
            );

            return [];
        } finally {
            $redis->close();
        }
    }
}
