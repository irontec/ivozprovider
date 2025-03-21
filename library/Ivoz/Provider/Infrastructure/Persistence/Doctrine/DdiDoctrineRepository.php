<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * DdiDoctrineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 * @template-extends ServiceEntityRepository<Ddi>
 */
class DdiDoctrineRepository extends ServiceEntityRepository implements DdiRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ddi::class);
    }

    /**
     * @param string $ddiE164
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    public function findOneByDdiE164($ddiE164)
    {
        /** @var DdiInterface $response */
        $response = $this->findOneBy([
            "ddie164" => $ddiE164
        ]);

        return $response;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    public function findOneByDdiAndCountry(string $ddi, int $countryId)
    {
        /** @var DdiInterface $response */
        $response = $this->findOneBy([
            'ddi' => $ddi,
            'country' => $countryId
        ]);

        return $response;
    }

    public function countByCompany(int $companyId): int
    {
        $qb = $this->createQueryBuilder('self');

        return $qb
            ->select('count(self.id)')
            ->where($qb->expr()->eq('self.company', $companyId))
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countByCompanyAndCountry(int $companyId, int $countryId): int
    {
        $qb = $this->createQueryBuilder('self');

        return $qb
            ->select('count(self.id)')
            ->where($qb->expr()->eq('self.company', $companyId))
            ->andWhere($qb->expr()->eq('self.country', $countryId))
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countByCompanyAndNotCountry(int $companyId, int $countryId): int
    {
        $qb = $this->createQueryBuilder('self');

        return $qb
            ->select('count(self.id)')
            ->where($qb->expr()->eq('self.company', $companyId))
            ->andWhere($qb->expr()->neq('self.country', $countryId))
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countByBrand(int $brandId): int
    {
        $qb = $this->createQueryBuilder('self');
        $expression = $qb->expr();

        $qb
            ->select('COUNT(self.id) as count')
            ->where(
                $expression->eq(
                    'self.brand',
                    $brandId
                )
            );

        $result = $qb
            ->getQuery()
            ->getSingleResult();

        return $result['count'];
    }
}
