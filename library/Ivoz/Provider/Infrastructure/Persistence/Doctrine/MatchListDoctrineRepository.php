<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Provider\Domain\Model\MatchList\MatchList;
use Ivoz\Provider\Domain\Model\MatchList\MatchListRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * MatchListDoctrineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 * @template-extends ServiceEntityRepository<MatchList>
 */
class MatchListDoctrineRepository extends ServiceEntityRepository implements MatchListRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MatchList::class);
    }

    public function getIdsByCompanyId(int $companyId): array
    {
        $qb = $this->createQueryBuilder('self');
        $expression = $qb->expr();

        $qb
            ->select('self.id')
            ->where(
                $expression->eq('self.company', $companyId)
            )
            ->andWhere(
                $expression->isNull('self.brand')
            );

        $result = $qb->getQuery()->getScalarResult();

        return array_column(
            $result,
            'id'
        );
    }
}
