<?php

namespace Ivoz\Provider\Domain\Model\FeaturesRelBrand;

/**
 * FeaturesRelBrand
 */
class FeaturesRelBrand extends FeaturesRelBrandAbstract implements FeaturesRelBrandInterface
{
    use FeaturesRelBrandTrait;

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

