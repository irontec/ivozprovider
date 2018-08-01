<?php

namespace Ivoz\Provider\Domain\Model\DestinationRate;

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
        return sprintf("dr%d", $this->getDestinationRateGroup()->getId());
    }

    /**
     * @return string
     */
    public function getCgrRatesTag()
    {
        return sprintf("rt%d", $this->getId());
    }

    /**
     * @return string
     */
    public function getCgrDestinationsTag()
    {
        return $this->getDestination()->getCgrTag();
    }

    /**
     * Ensure Group Interval Start has seconds suffix
     *
     * @inheritdoc
     */
    public function setGroupIntervalStart($groupIntervalStart)
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
    public function setRateIncrement($rateIncrement)
    {
        if (!strpos($rateIncrement, 's')) {
            $rateIncrement .= 's';
        }

        return parent::setRateIncrement($rateIncrement);
    }
}

