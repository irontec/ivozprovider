<?php

namespace Ivoz\Kam\Domain\Model\Dispatcher;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
     * @return integer
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
     * @return integer
     */
    public function getFlags(): int;

    /**
     * Get priority
     *
     * @return integer
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
     * @return \Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface
     */
    public function getApplicationServer();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
