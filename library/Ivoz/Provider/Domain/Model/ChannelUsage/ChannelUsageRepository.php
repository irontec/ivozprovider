<?php

namespace Ivoz\Provider\Domain\Model\ChannelUsage;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

/**
 * @extends ObjectRepository<ChannelUsageInterface>
 * @extends Selectable<int, ChannelUsageInterface>
 */
interface ChannelUsageRepository extends ObjectRepository, Selectable
{
    public function findOneByCompanyAndTimestamp(
        int $companyId,
        \DateTimeInterface $timestamp
    ): ?ChannelUsageInterface;

    /**
     * Existing buckets for a set of companies within a timestamp window.
     *
     * Lets a collector resolve a whole batch of buckets with a single query instead of one
     * lookup per row.
     *
     * @param array<int, int> $companyIds
     * @return array<int, ChannelUsageInterface>
     */
    public function findByCompaniesAndTimestampRange(
        array $companyIds,
        \DateTimeInterface $from,
        \DateTimeInterface $to
    ): array;

    public function purgeOlderThan(\DateTimeInterface $cutoff, int $limit): int;
}
