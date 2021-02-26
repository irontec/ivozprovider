<?php

namespace Ivoz\Provider\Domain\Model\TerminalManufacturer;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* TerminalManufacturerInterface
*/
interface TerminalManufacturerInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function getIden(): string;

    public function getName(): string;

    public function getDescription(): string;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
