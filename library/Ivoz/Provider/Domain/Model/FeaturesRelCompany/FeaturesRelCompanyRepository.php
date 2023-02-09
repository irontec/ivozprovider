<?php

namespace Ivoz\Provider\Domain\Model\FeaturesRelCompany;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;
use Ivoz\Provider\Domain\Model\Feature\FeatureInterface;

interface FeaturesRelCompanyRepository extends ObjectRepository, Selectable
{
    /**
     * @return string[]
     */
    public function findFeatureIdensByCompanyId(int $companyId): array;
}
