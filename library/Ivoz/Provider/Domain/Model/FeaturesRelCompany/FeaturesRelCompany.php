<?php

namespace Ivoz\Provider\Domain\Model\FeaturesRelCompany;

/**
 * FeaturesRelCompany
 */
class FeaturesRelCompany extends FeaturesRelCompanyAbstract implements FeaturesRelCompanyInterface
{
    use FeaturesRelCompanyTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
