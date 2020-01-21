<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackList;
use Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ExternalCallFilterBlackListDoctrineRepository extends ServiceEntityRepository implements ExternalCallFilterBlackListRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ExternalCallFilterBlackList::class);
    }
}
