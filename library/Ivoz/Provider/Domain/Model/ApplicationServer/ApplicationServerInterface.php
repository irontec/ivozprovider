<?php

namespace Ivoz\Provider\Domain\Model\ApplicationServer;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* ApplicationServerInterface
*/
interface ApplicationServerInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function getIp(): string;

    public function getName(): ?string;

    public function isInitialized(): bool;
}
