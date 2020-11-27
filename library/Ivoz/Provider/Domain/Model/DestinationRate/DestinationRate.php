<?php

namespace Ivoz\Provider\Domain\Model\DestinationRate;

use Assert\Assertion;

/**
 * DestinationRate
 */
class DestinationRate extends DestinationRateAbstract implements DestinationRateInterface
{
    use DestinationRateTrait;

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
    public function getCgrTag()
    {
        return $this->getDestinationRateGroup()->getCgrTag();
    }

    /**
     * @return string
     */
    public function getCgrRatesTag()
    {
        return sprintf(
            "b%drt%d",
            $this->getDestinationRateGroup()->getBrand()->getId(),
            $this->getId()
        );
    }

    /**
     * @return string
     */
    public function getCgrDestinationsTag()
    {
        return $this->getDestination()->getCgrTag();
    }

    /**
     * Ensure Valid connectFee format
     *
     * @inheritdoc
     */
    public function setConnectFee(float $connectFee): self
    {
        Assertion::regex((string) $connectFee, '/^[0-9]{1,6}[.]{0,1}[0-9]*$/');

        return parent::setConnectFee($connectFee);
    }

    /**
     * Ensure Valid connectFee format
     *
     * @inheritdoc
     */
    public function setCost(float $cost): self
    {
        Assertion::regex((string) $cost, '/^[0-9]{1,6}[.]{0,1}[0-9]*$/');

        return parent::setCost($cost);
    }


    /**
     * Ensure Group Interval Start has seconds suffix
     *
     * @inheritdoc
     */
    public function setGroupIntervalStart(string $groupIntervalStart): self
    {
        if (!strpos($groupIntervalStart, 's')) {
            $groupIntervalStart .= 's';
        }

        return parent::setGroupIntervalStart($groupIntervalStart);
    }

    /**
     * Ensure Rating Increment has seconds suffix
     *
     * @inheritdoc
     */
    public function setRateIncrement(string $rateIncrement): self
    {
        if (!strpos($rateIncrement, 's')) {
            $rateIncrement .= 's';
        }

        return parent::setRateIncrement($rateIncrement);
    }
}
