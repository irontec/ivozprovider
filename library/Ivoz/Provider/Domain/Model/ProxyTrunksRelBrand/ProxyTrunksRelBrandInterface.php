<?php

namespace Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* ProxyTrunksRelBrandInterface
*/
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
     * @param BrandInterface | null
     *
     * @return static
     */
    public function setBrand(?BrandInterface $brand = null): ProxyTrunksRelBrandInterface;

    /**
     * Get brand
     *
     * @return BrandInterface | null
     */
    public function getBrand(): ?BrandInterface;

    /**
     * Get proxyTrunk
     *
     * @return ProxyTrunkInterface
     */
    public function getProxyTrunk(): ProxyTrunkInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
