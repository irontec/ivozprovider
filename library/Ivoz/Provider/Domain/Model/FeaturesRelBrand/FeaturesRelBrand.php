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
     * @return array<string, mixed>
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
    public function getId(): ?int
    {
        return $this->id;
    }
}
