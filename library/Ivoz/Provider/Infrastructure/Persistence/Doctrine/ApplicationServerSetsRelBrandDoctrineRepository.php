<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Persistence\ManagerRegistry;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Repository\DoctrineRepository;
use Ivoz\Provider\Domain\Model\ApplicationServerSetsRelBrand\ApplicationServerSetsRelBrand;
use Ivoz\Provider\Domain\Model\ApplicationServerSetsRelBrand\ApplicationServerSetsRelBrandRepository;
use Ivoz\Provider\Domain\Model\ApplicationServerSetsRelBrand\ApplicationServerSetsRelBrandInterface;
use Ivoz\Provider\Domain\Model\ApplicationServerSetsRelBrand\ApplicationServerSetsRelBrandDto;

/**
 * ApplicationServerSetsRelBrandDoctrineRepository
 *
 * This class was generated by ivoz:make:repositories command.
 * Add your own custom repository methods below.
 *
 * @extends DoctrineRepository<ApplicationServerSetsRelBrandInterface, ApplicationServerSetsRelBrandDto>
 */
class ApplicationServerSetsRelBrandDoctrineRepository extends DoctrineRepository implements ApplicationServerSetsRelBrandRepository
{
    public function __construct(
        ManagerRegistry $registry,
        EntityPersisterInterface $entityPersisterInterface,
    ) {
        parent::__construct(
            $registry,
            ApplicationServerSetsRelBrand::class,
            $entityPersisterInterface
        );
    }

    /**
     * @inheritdoc
     */
    public function findByBrandId(int $brandId): array
    {
        /** @var ApplicationServerSetsRelBrandInterface[] $response */
        $response = $this->findBy([
            'brandId' => $brandId
        ]);

        return $response;
    }
}
