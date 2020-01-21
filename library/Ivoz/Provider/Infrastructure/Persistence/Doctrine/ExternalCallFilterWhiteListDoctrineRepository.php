<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteList;
use Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteListRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ExternalCallFilterWhiteListDoctrineRepository extends ServiceEntityRepository implements ExternalCallFilterWhiteListRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ExternalCallFilterWhiteList::class);
    }
}
