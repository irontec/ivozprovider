<?php

namespace Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface ProxyTrunksRelBrandInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand | null
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    public function getBrand();

    /**
     * Get proxyTrunk
     *
     * @return \Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface
     */
    public function getProxyTrunk();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
