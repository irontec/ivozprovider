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
    /**
     * @param array<array{
     *   brandId: int,
     *   companyId: int,
     *   timestamp: \DateTimeInterface,
     *   peak: int,
     *   avgUsage: float,
     *   closingUsage: int,
     *   maxCallsCompany: int,
     *   maxCallsBrand: int,
     *   blockedByCompanyLimit: int,
     *   blockedByBrandLimit: int
     * }> $rows
     * @return int affected rows
     */
    public function upsertBatch(array $rows): int;

    public function purgeOlderThan(\DateTimeInterface $cutoff, int $limit): int;
}
