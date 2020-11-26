<?php

namespace Ivoz\Provider\Domain\Model\FeaturesRelCompany;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Feature\FeatureInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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

    /**
     * Set company
     *
     * @param CompanyInterface | null
     *
     * @return static
     */
    public function setCompany(?CompanyInterface $company = null): FeaturesRelCompanyInterface;

    /**
     * Get company
     *
     * @return CompanyInterface | null
     */
    public function getCompany(): ?CompanyInterface;

    /**
     * Get feature
     *
     * @return FeatureInterface
     */
    public function getFeature(): FeatureInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
