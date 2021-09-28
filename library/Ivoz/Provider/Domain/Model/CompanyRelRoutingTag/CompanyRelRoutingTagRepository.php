<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelRoutingTag;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface CompanyRelRoutingTagRepository extends ObjectRepository, Selectable
{
    /**
     * Used by client API access controls
     * @return int[]
     */
    public function getRoutingTagIdsByCompany(int $companyId): array;
}
