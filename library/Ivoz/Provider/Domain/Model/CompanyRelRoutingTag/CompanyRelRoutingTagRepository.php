<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelRoutingTag;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface CompanyRelRoutingTagRepository extends ObjectRepository, Selectable
{
    /**
     * Used by client API access controls
     *
     * @return (int|null)[]
     */
    public function getRoutingTagIdsByCompany(int $companyId): array;
}
