<?php

namespace Ivoz\Provider\Domain\Model\Carrier;

use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface;

/**
 * Carrier
 */
class Carrier extends CarrierAbstract implements CarrierInterface
{
    use CarrierTrait;

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


    /**
     * @inheritdoc
     */
    protected function sanitizeValues(): void
    {
        if (!$this->getCalculateCost()) {
            $this->setCurrency(null);
        }
    }

    /**
     * @return string
     */
    public function getCgrSubject(): string
    {
        return sprintf("cr%d", (int) $this->getId());
    }

    /**
     * @return string
     */
    public function getCurrencySymbol(): string
    {
        $currency = $this->getCurrency();
        if (!$currency) {
            return $this->getBrand()->getCurrencySymbol();
        }
        return $currency->getSymbol();
    }

    /**
     * @return string
     */
    public function getCurrencyIden(): string
    {
        $currency = $this->getCurrency();
        if (!$currency) {
            return $this->getBrand()->getCurrencyIden();
        }
        return $currency->getIden();
    }

    protected function setProxyTrunk(?ProxyTrunkInterface $proxyTrunks = null): static
    {
        if (is_null($proxyTrunks)) {
            throw new \DomainException('Local socket cannot be empty.', 70005);
        }

        return parent::setProxyTrunk($proxyTrunks);
    }

    protected function setBalance(?float $balance = null): static
    {
        $balance = round($balance, 4);
        return parent::setBalance($balance);
    }
}
