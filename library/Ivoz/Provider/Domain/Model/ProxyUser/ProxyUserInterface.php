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

    public function getName(): ?string;

    public function getIp(): ?string;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
