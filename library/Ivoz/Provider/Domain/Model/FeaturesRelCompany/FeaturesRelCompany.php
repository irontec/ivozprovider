<?php

namespace Ivoz\Provider\Domain\Model\FeaturesRelCompany;

/**
 * FeaturesRelCompany
 */
class FeaturesRelCompany extends FeaturesRelCompanyAbstract implements FeaturesRelCompanyInterface
{
    use FeaturesRelCompanyTrait;
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

