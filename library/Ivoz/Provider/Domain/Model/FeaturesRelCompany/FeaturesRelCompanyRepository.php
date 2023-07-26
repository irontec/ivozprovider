<?php

namespace Ivoz\Provider\Domain\Model\FeaturesRelCompany;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface FeaturesRelCompanyRepository extends ObjectRepository, Selectable
{
    /**
     * @return string[]
     */
    public function findFeatureIdensByCompanyId(int $companyId): array;

    public function isFeatureInUseByBrandId(int $brandId, int $featureId): bool;
}
