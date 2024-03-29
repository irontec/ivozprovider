<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelSchedule;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * ExternalCallFilterRelScheduleDoctrineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 * @template-extends ServiceEntityRepository<ExternalCallFilterRelSchedule>
 */
class ExternalCallFilterRelScheduleDoctrineRepository extends ServiceEntityRepository implements ExternalCallFilterRelScheduleRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExternalCallFilterRelSchedule::class);
    }
}
