<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Provider\Domain\Model\MaxUsageNotification\MaxUsageNotification;
use Ivoz\Provider\Domain\Model\MaxUsageNotification\MaxUsageNotificationRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class MaxUsageNotificationDoctrineRepository extends ServiceEntityRepository implements MaxUsageNotificationRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MaxUsageNotification::class);
    }
}
