<?php

namespace Ivoz\Provider\Domain\Model\ProxyTrunk;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface ProxyTrunkInterface extends LoggableEntityInterface
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
    public function getName();

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp();
}
