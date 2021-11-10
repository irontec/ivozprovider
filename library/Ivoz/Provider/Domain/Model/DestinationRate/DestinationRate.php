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
     * @return string
     */
    public function getCgrTag(): string
    {
        return $this->getDestinationRateGroup()->getCgrTag();
    }

    /**
     * @return string
     */
    public function getCgrRatesTag(): string
    {
        return sprintf(
            "b%drt%d",
            (int) $this->getDestinationRateGroup()->getBrand()->getId(),
            (int) $this->getId()
        );
    }

    /**
     * @return string
     */
    public function getCgrDestinationsTag(): string
    {
        return $this->getDestination()->getCgrTag();
    }

    /**
     * Ensure Valid connectFee format
     *
     * @inheritdoc
     */
    public function setConnectFee(float $connectFee): static
    {
        Assertion::regex((string) $connectFee, '/^[0-9]{1,6}[.]{0,1}[0-9]*$/');

        return parent::setConnectFee($connectFee);
    }

    /**
     * Ensure Valid connectFee format
     *
     * @inheritdoc
     */
    public function setCost(float $cost): static
    {
        Assertion::regex((string) $cost, '/^[0-9]{1,6}[.]{0,1}[0-9]*$/');

        return parent::setCost($cost);
    }


    /**
     * Ensure Group Interval Start has seconds suffix
     *
     * @inheritdoc
     */
    public function setGroupIntervalStart(string $groupIntervalStart): static
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
    public function setRateIncrement(string $rateIncrement): static
    {
        if (!strpos($rateIncrement, 's')) {
            $rateIncrement .= 's';
        }

        return parent::setRateIncrement($rateIncrement);
    }
}
