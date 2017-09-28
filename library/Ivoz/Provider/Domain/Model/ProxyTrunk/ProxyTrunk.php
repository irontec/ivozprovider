<?php

namespace Ivoz\Provider\Domain\Model\ProxyTrunk;

/**
 * ProxyTrunk
 */
class ProxyTrunk extends ProxyTrunkAbstract implements ProxyTrunkInterface
{
    use ProxyTrunkTrait;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

