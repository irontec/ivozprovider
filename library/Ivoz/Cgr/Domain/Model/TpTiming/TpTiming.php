<?php

namespace Ivoz\Cgr\Domain\Model\TpTiming;

/**
 * TpTiming
 */
class TpTiming extends TpTimingAbstract implements TpTimingInterface
{
    use TpTimingTrait;

    public const TIMING_ANY    = '*any';
    public const TIMING_ALL    = '*all';
    public const TIMING_ASAP   = '*asap';

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
