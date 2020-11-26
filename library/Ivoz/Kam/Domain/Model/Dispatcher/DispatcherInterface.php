<?php

namespace Ivoz\Kam\Domain\Model\Dispatcher;

use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* DispatcherInterface
*/
interface DispatcherInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get setid
     *
     * @return int
     */
    public function getSetid(): int;

    /**
     * Get destination
     *
     * @return string
     */
    public function getDestination(): string;

    /**
     * Get flags
     *
     * @return int
     */
    public function getFlags(): int;

    /**
     * Get priority
     *
     * @return int
     */
    public function getPriority(): int;

    /**
     * Get attrs
     *
     * @return string
     */
    public function getAttrs(): string;

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Get applicationServer
     *
     * @return ApplicationServerInterface
     */
    public function getApplicationServer(): ApplicationServerInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
