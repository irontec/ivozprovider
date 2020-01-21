<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPattern;
use Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPatternRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class MatchListPatternDoctrineRepository extends ServiceEntityRepository implements MatchListPatternRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MatchListPattern::class);
    }
}
