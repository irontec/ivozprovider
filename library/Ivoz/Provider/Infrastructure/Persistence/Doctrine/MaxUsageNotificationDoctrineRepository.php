<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\MaxUsageNotification\MaxUsageNotification;
use Ivoz\Provider\Domain\Model\MaxUsageNotification\MaxUsageNotificationRepository;

/**
 * @template-extends ServiceEntityRepository<MaxUsageNotification>
 */
class MaxUsageNotificationDoctrineRepository extends ServiceEntityRepository implements MaxUsageNotificationRepository
{
    public function __construct(ManagerRegistry $registry)
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
