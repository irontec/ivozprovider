<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceRepository;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyService;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * CompanyServiceDoctrineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CompanyServiceDoctrineRepository extends ServiceEntityRepository implements CompanyServiceRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CompanyService::class);
    }

    /**
     * @param int $companyId
     * @param int $serviceId
     * @return CompanyServiceInterface
     */
    public function findCompanyService($companyId, $serviceId)
    {
        /** @var CompanyServiceInterface $response */
        $response = $this->findOneBy([
            'company' => $companyId,
            'service' => $serviceId
        ]);

        return $response;
    }
}
