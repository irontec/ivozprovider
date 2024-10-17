<?php

namespace Ivoz\Provider\Domain\Model\ApplicationServerSetsRelBrand;

use Ivoz\Core\Domain\Service\Repository\RepositoryInterface;

/**
 * @extends RepositoryInterface<ApplicationServerSetsRelBrandInterface, ApplicationServerSetsRelBrandDto>
 */
interface ApplicationServerSetsRelBrandRepository extends RepositoryInterface
{
    /**
     * @return ApplicationServerSetsRelBrandInterface[]
     */
    public function findByBrandId(int $brandId): array;
}
