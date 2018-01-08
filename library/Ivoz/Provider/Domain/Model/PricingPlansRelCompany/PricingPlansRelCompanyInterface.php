<?php

namespace Ivoz\Provider\Domain\Model\PricingPlansRelCompany;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface PricingPlansRelCompanyInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function __toString();

    /**
     * Set validFrom
     *
     * @param \DateTime $validFrom
     *
     * @return self
     */
    public function setValidFrom($validFrom);

    /**
     * Get validFrom
     *
     * @return \DateTime
     */
    public function getValidFrom();

    /**
     * Set validTo
     *
     * @param \DateTime $validTo
     *
     * @return self
     */
    public function setValidTo($validTo);

    /**
     * Get validTo
     *
     * @return \DateTime
     */
    public function getValidTo();

    /**
     * Set metric
     *
     * @param integer $metric
     *
     * @return self
     */
    public function setMetric($metric);

    /**
     * Get metric
     *
     * @return integer
     */
    public function getMetric();

    /**
     * Set pricingPlan
     *
     * @param \Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanInterface $pricingPlan
     *
     * @return self
     */
    public function setPricingPlan(\Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanInterface $pricingPlan);

    /**
     * Get pricingPlan
     *
     * @return \Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanInterface
     */
    public function getPricingPlan();

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

}

