<?php

namespace Ivoz\Cgr\Domain\Model\RatingPlan;

/**
 * RatingPlan
 */
class RatingPlan extends RatingPlanAbstract implements RatingPlanInterface
{
    use RatingPlanTrait;

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

