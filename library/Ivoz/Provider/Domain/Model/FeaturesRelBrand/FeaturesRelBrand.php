<?php

namespace Ivoz\Provider\Domain\Model\FeaturesRelBrand;

/**
 * FeaturesRelBrand
 */
class FeaturesRelBrand extends FeaturesRelBrandAbstract implements FeaturesRelBrandInterface
{
    use FeaturesRelBrandTrait;

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

