<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPattern;
use Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPatternRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @template-extends ServiceEntityRepository<MatchListPattern>
 */
class MatchListPatternDoctrineRepository extends ServiceEntityRepository implements MatchListPatternRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MatchListPattern::class);
    }
}
