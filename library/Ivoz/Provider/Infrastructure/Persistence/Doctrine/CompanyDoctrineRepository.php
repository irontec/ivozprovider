<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * CompanyDoctrineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 * @template-extends ServiceEntityRepository<Company>
 */
class CompanyDoctrineRepository extends ServiceEntityRepository implements CompanyRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Company::class);
    }

    /**
     * @inheritdoc
     */
    public function findIdsByBrandId($id)
    {
        $qb = $this->createQueryBuilder('self');
        $expression = $qb->expr();

        $qb
            ->select('self.id')
            ->where(
                $expression->eq('self.brand', $id)
            );

        $result = $qb
            ->getQuery()
            ->getScalarResult();

        return array_map(
            function ($row): int {
                return (int) $row['id'];
            },
            $result
        );
    }

    /**
     * Used by brand API access controls
     * @inheritdoc
     * @see \Ivoz\Provider\Domain\Model\Company\CompanyRepository::getSupervisedCompanyIdsByAdmin
     */
    public function getSupervisedCompanyIdsByAdmin(AdministratorInterface $admin): array
    {
        if (!$admin->isBrandAdmin()) {
            throw new \DomainException('User must be brand admin');
        }

        $qb = $this->createQueryBuilder('self');
        $expression = $qb->expr();

        $qb
            ->select('self.id')
            ->where(
                $expression->eq('self.brand', $admin->getBrand()->getId())
            );

        $result = $qb->getQuery()->getScalarResult();

        return array_column($result, 'id');
    }

    /**
     * @inheritdoc
     * @see \Ivoz\Provider\Domain\Model\Company\CompanyRepository::getPrepaidCompanies
     */
    public function getPrepaidCompanies()
    {
        $qb = $this->createQueryBuilder('c');

        $query = $qb
            ->select('c')
            ->where(
                $qb->expr()->in('c.billingMethod', ['prepaid', 'pseudoprepaid'])
            )
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @param int $brandId | null
     * @return string[]
     */
    public function getNames($brandId = null)
    {
        $qb = $this->createQueryBuilder('self');

        $qb->select('self.id, self.name');

        if ($brandId) {
            $qb->where(
                $qb->expr()->eq('self.brand', $brandId)
            );
        }

        $result = $qb
            ->select('self.id, self.name')
            ->getQuery()
            ->getScalarResult();

        $response = [];
        foreach ($result as $row) {
            $response[$row['id']] = $row['name'];
        }

        return $response;
    }

    /**
     * @return int[]
     */
    public function getVpbxIdsByBrand(int $brandId): array
    {
        return $this->getIdsByBrandAndType(
            $brandId,
            CompanyInterface::TYPE_VPBX
        );
    }

    /**
     * @return int[]
     */
    public function getResidentialIdsByBrand(int $brandId): array
    {
        return $this->getIdsByBrandAndType(
            $brandId,
            CompanyInterface::TYPE_RESIDENTIAL
        );
    }

    /**
     * @return int[]
     */
    public function getRetailIdsByBrand(int $brandId): array
    {
        return $this->getIdsByBrandAndType(
            $brandId,
            CompanyInterface::TYPE_RETAIL
        );
    }

    private function getIdsByBrandAndType(int $brandId, string $type): array
    {
        $qb = $this->createQueryBuilder('self');
        $criteria = CriteriaHelper::fromArray([
            ['brand', 'eq', $brandId],
            ['type', 'eq', $type]
        ]);

        $qb
            ->select('self.id')
            ->addCriteria($criteria);

        $result = $qb
            ->getQuery()
            ->getScalarResult();

        return
            array_map(
                'intval',
                array_column(
                    $result,
                    'id'
                )
            );
    }

    public function findOneByDomain(string $domainUsers): ?CompanyInterface
    {
        /** @var ?CompanyInterface $response */
        $response = $this->findOneBy([
            'domainUsers' => $domainUsers
        ]);

        return $response;
    }
}
