<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Service\ChannelUsage;

use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsageRepository;
use Psr\Log\LoggerInterface;

/**
 * Channel usage retention: drops buckets older than the retention window.
 *
 * Split out of CollectChannelUsage because retention is a rule of its own, with its own
 * failure mode: a purge that cannot keep up must not stop usage from being collected.
 */
class PurgeOldChannelUsage
{
    public const RETENTION_DAYS = 30;
    public const PURGE_BATCH_SIZE = 1000;

    /**
     * Bounds a single run so a large backlog is drained over several runs instead of
     * holding the job (and its DB load) for an unpredictable amount of time.
     */
    public const MAX_BATCHES_PER_RUN = 50;

    public function __construct(
        private ChannelUsageRepository $channelUsageRepository,
        private LoggerInterface $logger
    ) {
    }

    /**
     * @return int rows deleted
     */
    public function execute(): int
    {
        $cutoff = new \DateTime(
            'now',
            new \DateTimeZone('UTC')
        );
        $cutoff->modify(
            sprintf('-%d days', self::RETENTION_DAYS)
        );

        $deleted = 0;

        for ($batch = 0; $batch < self::MAX_BATCHES_PER_RUN; $batch++) {
            $affected = $this->channelUsageRepository->purgeOlderThan(
                $cutoff,
                self::PURGE_BATCH_SIZE
            );

            $deleted += $affected;

            if ($affected < self::PURGE_BATCH_SIZE) {
                return $deleted;
            }
        }

        $this->logger->warning(
            sprintf(
                'ChannelUsage: purge hit its %d batch limit after deleting %d rows,'
                . ' remaining rows will be dropped on the next run.',
                self::MAX_BATCHES_PER_RUN,
                $deleted
            )
        );

        return $deleted;
    }
}
