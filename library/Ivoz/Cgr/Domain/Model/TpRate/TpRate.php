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
     *
     * @param string $rateIncrement
     * @return $this|TpRateAbstract|TpRateInterface
     */
    public function setRateIncrement(string $rateIncrement): self
    {
        if (is_numeric($rateIncrement)) {
            $rateIncrement .= "s";
        }

        return parent::setRateIncrement($rateIncrement);
    }

    /**
     * Validate GroupIntervalStart has valid unit
     *
     * @param string $groupIntervalStart
     * @return $this|TpRateAbstract|TpRateInterface
     */
    public function setGroupIntervalStart(string $groupIntervalStart): self
    {
        if (is_numeric($groupIntervalStart)) {
            $groupIntervalStart .= "s";
        }

        return parent::setGroupIntervalStart($groupIntervalStart);
    }
}
