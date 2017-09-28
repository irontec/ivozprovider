<?php

namespace Ivoz\Provider\Domain\Model\ProxyTrunk;

use Ivoz\Core\Domain\Model\EntityInterface;

interface ProxyTrunkInterface extends EntityInterface
{
    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name = null);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return self
     */
    public function setIp($ip);

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp();

}

