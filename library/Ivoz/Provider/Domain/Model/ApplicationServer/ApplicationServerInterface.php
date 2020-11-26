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

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp(): string;

    /**
     * Get name
     *
     * @return string | null
     */
    public function getName(): ?string;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
