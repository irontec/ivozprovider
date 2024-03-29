<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTag;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * RoutingTagDoctrineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 * @template-extends ServiceEntityRepository<RoutingTag>
 */
class RoutingTagDoctrineRepository extends ServiceEntityRepository implements RoutingTagRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RoutingTag::class);
    }


    /**
     * @param int $companyId
     * @return RoutingTagInterface[]
     * @see KlearCustomTarificatorController
     */
    public function findByCompanyId(int $companyId)
    {
        $qb = $this->createQueryBuilder('self');
        $query = $qb
            ->select('self')
            ->innerJoin('self.relCompanies', 'companyRelRoutingTag')
            ->where(
                $qb->expr()->eq('companyRelRoutingTag.company', $companyId)
            )
            ->getQuery();

        return $query->getResult();
    }
}
