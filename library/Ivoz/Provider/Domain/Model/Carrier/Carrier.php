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
     * @inheritdoc
     */
    protected function sanitizeValues()
    {
        if ($this->getExternallyRated()) {
            $this->setCalculateCost(false);
        }

        if (!$this->getCalculateCost()) {
            $this->setCurrency(null);
        }
    }

    /**
     * @return string
     */
    public function getCgrSubject()
    {
        return sprintf("cr%d", $this->getId());
    }

    /**
     * @return string
     */
    public function getCurrencySymbol()
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
    public function getCurrencyIden()
    {
        $currency = $this->getCurrency();
        if (!$currency) {
            return $this->getBrand()->getCurrencyIden();
        }
        return $currency->getIden();
    }

    /**
     * @param ProxyTrunkInterface|null $proxyTrunks
     * @return CarrierAbstract
     */
    protected function setProxyTrunk(?ProxyTrunkInterface $proxyTrunks = null): self
    {
        if (is_null($proxyTrunks)) {
            throw new \DomainException('Local socket cannot be empty.', 70005);
        }

        return parent::setProxyTrunk($proxyTrunks);
    }

    protected function setBalance(?float $balance = null): CarrierInterface
    {
        $balance = round($balance, 4);
        return parent::setBalance($balance);
    }
}
