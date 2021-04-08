<?php

namespace Ivoz\Provider\Domain\Model\FeaturesRelCompany;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Feature\FeatureInterface;

/**
* FeaturesRelCompanyInterface
*/
interface FeaturesRelCompanyInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function setCompany(?CompanyInterface $company = null): static;

    public function getCompany(): ?CompanyInterface;

    public function getFeature(): FeatureInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
