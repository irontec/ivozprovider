<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Persistence\ManagerRegistry;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Repository\DoctrineRepository;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSet;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSetRepository;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSetInterface;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSetDto;

/**
 * ApplicationServerSetDoctrineRepository
 *
 * This class was generated by ivoz:make:repositories command.
 * Add your own custom repository methods below.
 *
 * @extends DoctrineRepository<ApplicationServerSetInterface, ApplicationServerSetDto>
 */
class ApplicationServerSetDoctrineRepository extends DoctrineRepository implements ApplicationServerSetRepository
{
    public function __construct(
        ManagerRegistry $registry,
        EntityPersisterInterface $entityPersisterInterface,
    ) {
        parent::__construct(
            $registry,
            ApplicationServerSet::class,
            $entityPersisterInterface
        );
    }
}
