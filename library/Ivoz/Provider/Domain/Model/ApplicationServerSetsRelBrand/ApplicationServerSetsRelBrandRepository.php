<?php

namespace Ivoz\Provider\Domain\Model\ApplicationServerSetsRelBrand;

use Ivoz\Core\Domain\Service\Repository\RepositoryInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;

/**
 * @extends RepositoryInterface<ApplicationServerSetsRelBrandInterface, ApplicationServerSetsRelBrandDto>
 */
interface ApplicationServerSetsRelBrandRepository extends RepositoryInterface
{
    /**
     * @return ApplicationServerSetsRelBrandInterface[]
     */
    public function findByBrandId(int $brandId): array;

    /**
     * @return int[]
     */
    public function getApplicationServerSetIdsByBrandAdmin(AdministratorInterface $admin): array;
}
