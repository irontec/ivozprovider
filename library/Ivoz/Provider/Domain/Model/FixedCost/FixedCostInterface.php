<?php

namespace Ivoz\Provider\Domain\Model\FixedCost;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface FixedCostInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get description
     *
     * @return string | null
     */
    public function getDescription();

    /**
     * Get cost
     *
     * @return float | null
     */
    public function getCost();

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
