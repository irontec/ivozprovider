<?php

namespace Ivoz\Provider\Domain\Model\RatingPlanGroup;

/**
 * RatingPlanGroup
 */
class RatingPlanGroup extends RatingPlanGroupAbstract implements RatingPlanGroupInterface
{
    use RatingPlanGroupTrait;

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
     * CGRates tag for this Rating Plan
     *
     * @return string
     */
    public function getCgrTag()
    {
        return sprintf(
            "b%drp%d",
            $this->getBrand()->getId(),
            $this->getId()
        );
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
