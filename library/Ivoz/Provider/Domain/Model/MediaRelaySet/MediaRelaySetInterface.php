<?php

namespace Ivoz\Provider\Domain\Model\MediaRelaySet;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface MediaRelaySetInterface extends LoggableEntityInterface
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
     * @return bool
     */
    public function isInitialized(): bool;
}
