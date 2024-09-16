<?php

namespace Ivoz\Kam\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Kam\Domain\Model\UsersHtable\UsersHtable;
use Ivoz\Kam\Domain\Model\UsersHtable\UsersHtableRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * UsersHtableDoctrineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UsersHtableDoctrineRepository extends ServiceEntityRepository implements UsersHtableRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsersHtable::class);
    }
}