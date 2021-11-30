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
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    protected function setProxyTrunk(?ProxyTrunkInterface $proxyTrunks = null): static
    {
        if (is_null($proxyTrunks)) {
            throw new \DomainException('Local socket cannot be empty.', 70005);
        }

        return parent::setProxyTrunk($proxyTrunks);
    }
}
