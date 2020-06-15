<?php

namespace Ivoz\Provider\Domain\Model\BrandService;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
    public function setCode($code);

    /**
     * Get code
     *
     * @return string
     */
    public function getCode(): string;

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Get service
     *
     * @return \Ivoz\Provider\Domain\Model\Service\ServiceInterface
     */
    public function getService();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
