<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Provider\Domain\Model\FixedCost\FixedCost;
use Ivoz\Provider\Domain\Model\FixedCost\FixedCostRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * FixedCostDoctrineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 * @template-extends ServiceEntityRepository<FixedCost>
 */
class FixedCostDoctrineRepository extends ServiceEntityRepository implements FixedCostRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FixedCost::class);
    }
}
