<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Provider\Domain\Model\Locution\Locution;
use Ivoz\Provider\Domain\Model\Locution\LocutionRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * LocutionDoctrineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 * @template-extends ServiceEntityRepository<Locution>
 */
class LocutionDoctrineRepository extends ServiceEntityRepository implements LocutionRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Locution::class);
    }
}
