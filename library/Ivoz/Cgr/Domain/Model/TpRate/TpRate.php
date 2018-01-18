<?php

namespace Ivoz\Cgr\Domain\Model\TpRate;

/**
 * Rate
 */
class TpRate extends TpRateAbstract implements TpRateInterface
{
    use TpRateTrait;

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
    public function setRateIncrement($rateIncrement)
    {
        if (is_numeric($rateIncrement)) {
            $rateIncrement .= "s";
        }

        return parent::setRateIncrement($rateIncrement);
    }


}

