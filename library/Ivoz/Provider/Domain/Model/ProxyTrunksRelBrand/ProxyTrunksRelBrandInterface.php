<?php

namespace Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface;

/**
* ProxyTrunksRelBrandInterface
*/
interface ProxyTrunksRelBrandInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    public function setBrand(?BrandInterface $brand = null): static;

    public function getBrand(): ?BrandInterface;

    public function getProxyTrunk(): ProxyTrunkInterface;

    public function isInitialized(): bool;
}
