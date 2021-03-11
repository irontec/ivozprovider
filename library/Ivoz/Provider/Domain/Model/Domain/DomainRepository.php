<?php

namespace Ivoz\Provider\Domain\Model\Domain;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface DomainRepository extends ObjectRepository, Selectable
{

    /**
     * @param string $endpointDomain
     * @return DomainInterface | null
     */
    public function findOneByDomain($endpointDomain);

    /**
     * Includes company domains
     * @param int $brandId
     * @return DomainInterface[]
     */
    public function findByBrandId(int $brandId): array;

    /**
     * @param int $companyId
     * @return DomainInterface|null
     */
    public function findByCompanyId(int $companyId);
}
