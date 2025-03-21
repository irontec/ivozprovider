<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPattern;
use Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * OutgoingDdiRulesPatternDoctrineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 * @template-extends ServiceEntityRepository<OutgoingDdiRulesPattern>
 */
class OutgoingDdiRulesPatternDoctrineRepository extends ServiceEntityRepository implements OutgoingDdiRulesPatternRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OutgoingDdiRulesPattern::class);
    }
}
