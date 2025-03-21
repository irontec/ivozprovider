<?php

namespace Ivoz\Kam\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Kam\Domain\Model\UsersAddress\UsersAddress;
use Ivoz\Kam\Domain\Model\UsersAddress\UsersAddressRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * UsersAddressDoctrineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UsersAddressDoctrineRepository extends ServiceEntityRepository implements UsersAddressRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsersAddress::class);
    }
}
