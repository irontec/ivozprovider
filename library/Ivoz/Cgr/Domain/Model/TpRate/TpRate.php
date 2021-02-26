<?php

namespace Ivoz\Cgr\Domain\Model\TpRate;

/**
 * Rate
 */
class TpRate extends TpRateAbstract implements TpRateInterface
{
    use TpRateTrait;

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
     * Validate RateIncrement has valid unit
     */
    public function setRateIncrement(string $rateIncrement):  static
    {
        if (is_numeric($rateIncrement)) {
            $rateIncrement .= "s";
        }

        return parent::setRateIncrement($rateIncrement);
    }

    /**
     * Validate GroupIntervalStart has valid unit
     */
    public function setGroupIntervalStart(string $groupIntervalStart):  static
    {
        if (is_numeric($groupIntervalStart)) {
            $groupIntervalStart .= "s";
        }

        return parent::setGroupIntervalStart($groupIntervalStart);
    }
}
