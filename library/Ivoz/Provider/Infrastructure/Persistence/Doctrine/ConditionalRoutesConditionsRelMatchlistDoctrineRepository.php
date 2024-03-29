<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlist;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * ConditionalRoutesConditionsRelCalendarDoctrineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 * @template-extends ServiceEntityRepository<ConditionalRoutesConditionsRelMatchlist>
 */
class ConditionalRoutesConditionsRelMatchlistDoctrineRepository extends ServiceEntityRepository implements ConditionalRoutesConditionsRelMatchlistRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConditionalRoutesConditionsRelMatchlist::class);
    }
}
