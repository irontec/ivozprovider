<?php

namespace Ivoz\Provider\Domain\Model\MediaRelaySet;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* MediaRelaySetInterface
*/
interface MediaRelaySetInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    public function getName(): string;

    public function getDescription(): ?string;

    public function isInitialized(): bool;
}
