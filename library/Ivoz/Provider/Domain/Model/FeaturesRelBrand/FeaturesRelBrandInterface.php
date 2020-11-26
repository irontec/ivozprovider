<?php

namespace Ivoz\Provider\Domain\Model\FeaturesRelBrand;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Feature\FeatureInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* FeaturesRelBrandInterface
*/
interface FeaturesRelBrandInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Set brand
     *
     * @param BrandInterface | null
     *
     * @return static
     */
    public function setBrand(?BrandInterface $brand = null): FeaturesRelBrandInterface;

    /**
     * Get brand
     *
     * @return BrandInterface | null
     */
    public function getBrand(): ?BrandInterface;

    /**
     * Get feature
     *
     * @return FeatureInterface
     */
    public function getFeature(): FeatureInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
