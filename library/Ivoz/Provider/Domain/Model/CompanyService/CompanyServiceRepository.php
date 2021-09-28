<?php

namespace Ivoz\Provider\Domain\Model\CompanyService;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface CompanyServiceRepository extends ObjectRepository, Selectable
{
    /**
     * @param int $companyId
     * @param int $serviceId
     * @return CompanyServiceInterface | null
     */
    public function findCompanyService($companyId, $serviceId);

    /**
     * @return int[]
     */
    public function findServiceIdsByCompany(int $companyId);
}
