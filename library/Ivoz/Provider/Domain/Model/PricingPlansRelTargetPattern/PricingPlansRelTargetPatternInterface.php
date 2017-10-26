<?php

namespace Ivoz\Provider\Domain\Model\PricingPlansRelTargetPattern;

use Ivoz\Core\Domain\Model\EntityInterface;

interface PricingPlansRelTargetPatternInterface extends EntityInterface
{
    public function getCost($duration = null);

    /**
     * @return array
     */
    public function getChangeSet();

    /**
     * Set connectionCharge
     *
     * @param string $connectionCharge
     *
     * @return self
     */
    public function setConnectionCharge($connectionCharge);

    /**
     * Get connectionCharge
     *
     * @return string
     */
    public function getConnectionCharge();

    /**
     * Set periodTime
     *
     * @param integer $periodTime
     *
     * @return self
     */
    public function setPeriodTime($periodTime);

    /**
     * Get periodTime
     *
     * @return integer
     */
    public function getPeriodTime();

    /**
     * Set perPeriodCharge
     *
     * @param string $perPeriodCharge
     *
     * @return self
     */
    public function setPerPeriodCharge($perPeriodCharge);

    /**
     * Get perPeriodCharge
     *
     * @return string
     */
    public function getPerPeriodCharge();

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
     * Set targetPattern
     *
     * @param \Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternInterface $targetPattern
     *
     * @return self
     */
    public function setTargetPattern(\Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternInterface $targetPattern);

    /**
     * Get targetPattern
     *
     * @return \Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternInterface
     */
    public function getTargetPattern();

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

