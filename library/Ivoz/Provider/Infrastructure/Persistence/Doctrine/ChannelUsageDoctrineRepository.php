<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Core\Infrastructure\Domain\Service\DoctrineQueryRunner;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsage;
use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsageInterface;
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

    public function findOneByCompanyAndTimestamp(
        int $companyId,
        \DateTimeInterface $timestamp
    ): ?ChannelUsageInterface {
        $qb = $this
            ->createQueryBuilder('self');

        $criteria = CriteriaHelper::fromArray([
            ['company', 'eq', $companyId],
            ['timestamp', 'eq', $timestamp->format('Y-m-d H:i:s')]
        ]);

        $qb
            ->addCriteria($criteria)
            ->setMaxResults(1);

        /** @var ChannelUsageInterface | null $response */
        $response = $qb
            ->getQuery()
            ->getOneOrNullResult();

        return $response;
    }

    public function purgeOlderThan(\DateTimeInterface $cutoff, int $limit): int
    {
        $ids = $this->findIdsOlderThan($cutoff, $limit);

        if (empty($ids)) {
            return 0;
        }

        $qb = $this
            ->createQueryBuilder('self');

        $qb
            ->delete(
                $this->getEntityName(),
                'self'
            )
            ->where('self.id in (:ids)')
            ->setParameter(':ids', $ids);

        return $this->queryRunner->execute(
            $this->getEntityName(),
            $qb->getQuery()
        );
    }

    /**
     * @return int[]
     */
    private function findIdsOlderThan(\DateTimeInterface $cutoff, int $limit): array
    {
        $qb = $this
            ->createQueryBuilder('self');

        $criteria = CriteriaHelper::fromArray([
            ['timestamp', 'lt', $cutoff->format('Y-m-d H:i:s')]
        ]);

        $qb
            ->select('self.id')
            ->addCriteria($criteria)
            ->setMaxResults($limit);

        return array_map(
            'intval',
            array_column(
                $qb->getQuery()->getScalarResult(),
                'id'
            )
        );
    }
}
