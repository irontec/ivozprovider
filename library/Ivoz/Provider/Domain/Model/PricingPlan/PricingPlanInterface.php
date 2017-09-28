<?php

namespace Ivoz\Provider\Domain\Model\PricingPlan;

use Ivoz\Core\Domain\Model\EntityInterface;

interface PricingPlanInterface extends EntityInterface
{
    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     *
     * @return self
     */
    public function setCreatedOn($createdOn);

    /**
     * Get createdOn
     *
     * @return \DateTime
     */
    public function getCreatedOn();

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

    /**
     * Set name
     *
     * @param Name $name
     *
     * @return self
     */
    public function setName(\Ivoz\Provider\Domain\Model\PricingPlan\Name $name);

    /**
     * Get name
     *
     * @return Name
     */
    public function getName();

    /**
     * Set description
     *
     * @param Description $description
     *
     * @return self
     */
    public function setDescription(\Ivoz\Provider\Domain\Model\PricingPlan\Description $description);

    /**
     * Get description
     *
     * @return Description
     */
    public function getDescription();

}

