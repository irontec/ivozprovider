<?php

namespace Ivoz\Provider\Domain\Model\ProxyTrunk;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* ProxyTrunkInterface
*/
interface ProxyTrunkInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function getName(): ?string;

    public function getIp(): string;

    public function isInitialized(): bool;
}
