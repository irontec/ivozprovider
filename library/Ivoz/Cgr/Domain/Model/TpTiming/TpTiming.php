<?php

namespace Ivoz\Cgr\Domain\Model\TpTiming;

/**
 * TpTiming
 */
class TpTiming extends TpTimingAbstract implements TpTimingInterface
{
    use TpTimingTrait;

    const TIMING_ANY    = '*any';
    const TIMING_ALL    = '*all';
    const TIMING_ASAP   = '*asap';

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
