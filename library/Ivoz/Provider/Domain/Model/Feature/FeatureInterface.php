<?php

namespace Ivoz\Provider\Domain\Model\Feature;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* FeatureInterface
*/
interface FeatureInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    public function getIden(): string;

    public function getName(): Name;

    public function isInitialized(): bool;
}
