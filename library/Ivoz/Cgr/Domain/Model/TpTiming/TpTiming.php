<?php

namespace Ivoz\Cgr\Domain\Model\TpTiming;

/**
 * TpTiming
 */
class TpTiming extends TpTimingAbstract implements TpTimingInterface
{
    use TpTimingTrait;

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

