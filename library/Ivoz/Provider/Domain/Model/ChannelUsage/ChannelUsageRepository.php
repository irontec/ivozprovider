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

    public function purgeOlderThan(\DateTimeInterface $cutoff, int $limit): int;
}
