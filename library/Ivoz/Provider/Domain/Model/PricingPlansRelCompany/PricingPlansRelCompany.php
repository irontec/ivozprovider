<?php

namespace Ivoz\Provider\Domain\Model\PricingPlansRelCompany;

/**
 * PricingPlansRelCompany
 */
class PricingPlansRelCompany extends PricingPlansRelCompanyAbstract implements PricingPlansRelCompanyInterface
{
    use PricingPlansRelCompanyTrait;

    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

