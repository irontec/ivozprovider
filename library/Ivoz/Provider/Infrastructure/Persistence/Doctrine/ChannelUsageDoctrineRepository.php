<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NativeQuery;
use Ivoz\Core\Infrastructure\Domain\Service\DoctrineQueryRunner;
use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsage;
use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsageRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * ChannelUsageDoctrineRepository
 *
 * @template-extends ServiceEntityRepository<ChannelUsage>
 */
class ChannelUsageDoctrineRepository extends ServiceEntityRepository implements ChannelUsageRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private DoctrineQueryRunner $queryRunner
    ) {
        parent::__construct($registry, ChannelUsage::class);
    }

    public function upsertBatch(array $rows): int
    {
        if (empty($rows)) {
            return 0;
        }

        $placeholders = [];
        $values = [];
        foreach ($rows as $row) {
            $placeholders[] = '(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $values[] = $row['brandId'];
            $values[] = $row['companyId'];
            $values[] = $row['timestamp']->format('Y-m-d H:i:s');
            $values[] = $row['peak'];
            $values[] = round($row['avgUsage'], 2);
            $values[] = $row['closingUsage'];
            $values[] = $row['maxCallsCompany'];
            $values[] = $row['maxCallsBrand'];
            $values[] = $row['blockedByCompanyLimit'];
            $values[] = $row['blockedByBrandLimit'];
        }

        $sql = sprintf(
            'INSERT INTO ChannelUsages'
            . ' (brandId, companyId, timestamp, peak, avgUsage, closingUsage,'
            . ' maxCallsCompany, maxCallsBrand, blockedByCompanyLimit, blockedByBrandLimit)'
            . ' VALUES %s'
            . ' ON DUPLICATE KEY UPDATE'
            . ' peak = VALUES(peak),'
            . ' avgUsage = VALUES(avgUsage),'
            . ' closingUsage = VALUES(closingUsage),'
            . ' maxCallsCompany = VALUES(maxCallsCompany),'
            . ' maxCallsBrand = VALUES(maxCallsBrand),'
            . ' blockedByCompanyLimit = VALUES(blockedByCompanyLimit),'
            . ' blockedByBrandLimit = VALUES(blockedByBrandLimit)',
            implode(', ', $placeholders)
        );

        $query = (new NativeQuery($this->_em))->setSQL($sql);
        foreach ($values as $idx => $value) {
            $query->setParameter($idx + 1, $value);
        }

        return $this->queryRunner->execute(ChannelUsage::class, $query);
    }

    public function purgeOlderThan(\DateTimeInterface $cutoff, int $limit): int
    {
        $sql = sprintf(
            'DELETE FROM ChannelUsages WHERE timestamp < ? LIMIT %d',
            $limit
        );

        $query = (new NativeQuery($this->_em))
            ->setSQL($sql)
            ->setParameter(1, $cutoff->format('Y-m-d H:i:s'));

        return $this->queryRunner->execute(ChannelUsage::class, $query);
    }
}
