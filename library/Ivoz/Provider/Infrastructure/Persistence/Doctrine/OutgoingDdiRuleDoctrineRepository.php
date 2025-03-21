<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRule;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * OutgoingDdiRuleDoctrineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 * @template-extends ServiceEntityRepository<OutgoingDdiRule>
 */
class OutgoingDdiRuleDoctrineRepository extends ServiceEntityRepository implements OutgoingDdiRuleRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OutgoingDdiRule::class);
    }
}
