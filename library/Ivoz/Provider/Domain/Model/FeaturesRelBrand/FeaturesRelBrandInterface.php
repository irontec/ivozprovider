<?php

namespace Ivoz\Provider\Domain\Model\FeaturesRelBrand;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Set feature
     *
     * @param \Ivoz\Provider\Domain\Model\Feature\FeatureInterface $feature
     *
     * @return static
     */
    public function setFeature(\Ivoz\Provider\Domain\Model\Feature\FeatureInterface $feature);

    /**
     * Get feature
     *
     * @return \Ivoz\Provider\Domain\Model\Feature\FeatureInterface
     */
    public function getFeature();
}
