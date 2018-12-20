<?php

namespace Ivoz\Provider\Domain\Model\Carrier;

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
}
