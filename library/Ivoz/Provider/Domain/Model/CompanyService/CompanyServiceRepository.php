<?php

namespace Ivoz\Provider\Domain\Model\CompanyService;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface CompanyServiceRepository extends ObjectRepository, Selectable
{
    /**
     * @param int $companyId
     * @param int $serviceId
     * @return CompanyServiceInterface
     */
    public function findCompanyService($companyId, $serviceId);
}
