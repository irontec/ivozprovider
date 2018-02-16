<?php

namespace Ivoz\Cgr\Domain\Model\DestinationRate;

/**
 * DestinationRate
 */
class DestinationRate extends DestinationRateAbstract implements DestinationRateInterface
{
    use DestinationRateTrait;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


}

