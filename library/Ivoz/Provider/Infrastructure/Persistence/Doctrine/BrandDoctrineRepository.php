<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandRepository;

/**
 * BrandDoctrineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 * @template-extends ServiceEntityRepository<Brand>
 */
class BrandDoctrineRepository extends ServiceEntityRepository implements BrandRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Brand::class);
    }

    /**
     * @return string[]
     */
    public function getNames()
    {
        $qb = $this->createQueryBuilder('self');

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

    public function findOneByDomain(string $domainUsers): ?BrandInterface
    {
        /** @var ?BrandInterface $response */
        $response = $this->findOneBy([
            'domainUsers' => $domainUsers
        ]);

        return $response;
    }

    /**
     * @param array<string, mixed> $criteria
     */
    public function count(array $criteria): int
    {
        return parent::count($criteria);
    }

    /**
     * @return BrandInterface[]
     */
    public function getLatest(int $intemNum = 5): array
    {
        $qb = $this->createQueryBuilder('self');

        return $qb
            ->select('self')
            ->orderBy('self.id', 'DESC')
            ->setMaxResults($intemNum)
            ->getQuery()
            ->getResult();
    }
}
