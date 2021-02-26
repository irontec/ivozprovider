<?php

namespace Ivoz\Provider\Domain\Model\FixedCost;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;

/**
* FixedCostInterface
*/
interface FixedCostInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function getName(): string;

    public function getDescription(): ?string;

    public function getCost(): ?float;

    public function getBrand(): BrandInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
