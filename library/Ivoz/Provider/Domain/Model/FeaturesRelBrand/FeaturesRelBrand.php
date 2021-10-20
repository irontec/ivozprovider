<?php

namespace Ivoz\Provider\Domain\Model\FeaturesRelBrand;

/**
 * FeaturesRelBrand
 */
class FeaturesRelBrand extends FeaturesRelBrandAbstract implements FeaturesRelBrandInterface
{
    use FeaturesRelBrandTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array
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
