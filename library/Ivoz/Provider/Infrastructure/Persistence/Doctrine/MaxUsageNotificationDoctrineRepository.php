<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\MaxUsageNotification\MaxUsageNotification;
use Ivoz\Provider\Domain\Model\MaxUsageNotification\MaxUsageNotificationRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class MaxUsageNotificationDoctrineRepository extends ServiceEntityRepository implements MaxUsageNotificationRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MaxUsageNotification::class);
    }

    /**
     * @return CompanyInterface | null
     * @throws \Doctrine\ORM\Query\QueryException
     */
    public function findByCompany(CompanyInterface $company)
    {
        $qb = $this->createQueryBuilder('self');

        $qb
            ->select('self')
            ->addCriteria(
                CriteriaHelper::fromArray([
                    ['id', 'eq', $company->getId()],
                ])
            );

        return $qb->getQuery()->getOneOrNullResult();
    }
}
