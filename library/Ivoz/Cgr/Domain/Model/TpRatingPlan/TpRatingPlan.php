<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingPlan;

use Ivoz\Cgr\Domain\Model\TpTiming\TpTiming;

/**
 * TpRatingPlan
 */
class TpRatingPlan extends TpRatingPlanAbstract implements TpRatingPlanInterface
{
    use TpRatingPlanTrait;

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
