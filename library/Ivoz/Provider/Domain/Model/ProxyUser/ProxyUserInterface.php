<?php

namespace Ivoz\Provider\Domain\Model\ProxyUser;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* ProxyUserInterface
*/
interface ProxyUserInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get name
     *
     * @return string | null
     */
    public function getName(): ?string;

    /**
     * Get ip
     *
     * @return string | null
     */
    public function getIp(): ?string;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
