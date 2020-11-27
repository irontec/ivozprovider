<?php

namespace Ivoz\Provider\Domain\Model\DdiProvider;

use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface;

/**
 * DdiProvider
 */
class DdiProvider extends DdiProviderAbstract implements DdiProviderInterface
{
    use DdiProviderTrait;

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

    /**
     * @param ProxyTrunkInterface|null $proxyTrunks
     * @return DdiProviderAbstract
     */
    protected function setProxyTrunk(?ProxyTrunkInterface  $proxyTrunks = null): self
    {
        if (is_null($proxyTrunks)) {
            throw new \DomainException('Local socket cannot be empty.', 70005);
        }

        return parent::setProxyTrunk($proxyTrunks);
    }
}
