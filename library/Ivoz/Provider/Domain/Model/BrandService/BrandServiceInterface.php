<?php

namespace Ivoz\Provider\Domain\Model\BrandService;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Service\ServiceInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* BrandServiceInterface
*/
interface BrandServiceInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * {@inheritDoc}
     */
    public function setCode(string $code): BrandServiceInterface;

    /**
     * Get code
     *
     * @return string
     */
    public function getCode(): string;

    /**
     * Set brand
     *
     * @param BrandInterface
     *
     * @return static
     */
    public function setBrand(BrandInterface $brand): BrandServiceInterface;

    /**
     * Get brand
     *
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface;

    /**
     * Get service
     *
     * @return ServiceInterface
     */
    public function getService(): ServiceInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
