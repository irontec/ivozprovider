<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelSchedule;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * ConditionalRoutesConditionsRelCalendarDoctrineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 * @template-extends ServiceEntityRepository<ConditionalRoutesConditionsRelSchedule>
 */
class ConditionalRoutesConditionsRelScheduleDoctrineRepository extends ServiceEntityRepository implements ConditionalRoutesConditionsRelScheduleRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConditionalRoutesConditionsRelSchedule::class);
    }
}
