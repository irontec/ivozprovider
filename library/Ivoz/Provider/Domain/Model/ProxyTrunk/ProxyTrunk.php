<?php

namespace Ivoz\Provider\Domain\Model\ProxyTrunk;

/**
 * ProxyTrunk
 */
class ProxyTrunk extends ProxyTrunkAbstract implements ProxyTrunkInterface
{
    use ProxyTrunkTrait;

    const MAIN_ADDRESS_ID = 1;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
