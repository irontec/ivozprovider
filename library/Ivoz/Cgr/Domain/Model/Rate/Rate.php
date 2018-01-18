<?php

namespace Ivoz\Cgr\Domain\Model\Rate;

/**
 * Rate
 */
class Rate extends RateAbstract implements RateInterface
{
    use RateTrait;

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

