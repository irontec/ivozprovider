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
    public function getChangeSet();

    public function getIden(): string;

    public function getName(): Name;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
