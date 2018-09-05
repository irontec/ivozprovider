<?php

namespace Ivoz\Cgr\Domain\Model\TpDestinationRate;

class TpDestinationRateDto extends TpDestinationRateDtoAbstract
{
    /**
     * Validate RateIncrement has valid unit
     *
     * @param string $rateIncrement
     * @return static
     */
    public function setRateRateIncrement($rateRateIncrement = null)
    {
        if (is_numeric($rateRateIncrement)) {
            $rateRateIncrement .= "s";
        }

        return parent::setRateRateIncrement($rateRateIncrement);
    }

    /**
     * Validate GroupIntervalStart has valid unit
     *
     * @param string $groupIntervalStart
     * @return static
     */
    public function setRateGroupIntervalStart($rateGroupIntervalStart = null)
    {
        if (is_numeric($rateGroupIntervalStart)) {
            $rateGroupIntervalStart .= "s";
        }

        return parent::setRateGroupIntervalStart($rateGroupIntervalStart);
    }
}
