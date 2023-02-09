<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackList;
use Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 *
 * @template-extends ServiceEntityRepository<ExternalCallFilterBlackList>
 */
class ExternalCallFilterBlackListDoctrineRepository extends ServiceEntityRepository implements ExternalCallFilterBlackListRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExternalCallFilterBlackList::class);
    }
}
