<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHold;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * MusicOnHoldDoctrineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 * @template-extends ServiceEntityRepository<MusicOnHold>
 */
class MusicOnHoldDoctrineRepository extends ServiceEntityRepository implements MusicOnHoldRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MusicOnHold::class);
    }
}