<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSet;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * TransformationRuleSetDoctrineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 * @template-extends ServiceEntityRepository<TransformationRuleSet>
 */
class TransformationRuleSetDoctrineRepository extends ServiceEntityRepository implements TransformationRuleSetRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TransformationRuleSet::class);
    }

    /**
     * @param int $brandId
     * @return array
     */
    public function getIdsByBrandId(int $brandId): array
    {
        $qb = $this->createQueryBuilder('self');
        $expression = $qb->expr();

        $qb
            ->select('self.id')
            ->where(
                $expression->eq('self.brand', $brandId)
            );

        $result = $qb->getQuery()->getScalarResult();

        return array_column(
            $result,
            'id'
        );
    }
}
