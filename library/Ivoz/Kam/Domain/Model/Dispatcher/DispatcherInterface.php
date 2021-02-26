<?php

namespace Ivoz\Kam\Domain\Model\Dispatcher;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface;

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

    public function getSetid(): int;

    public function getDestination(): string;

    public function getFlags(): int;

    public function getPriority(): int;

    public function getAttrs(): string;

    public function getDescription(): string;

    public function getApplicationServer(): ApplicationServerInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
