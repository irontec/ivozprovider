<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingPlan;

/**
 * TpRatingPlan
 */
class TpRatingPlan extends TpRatingPlanAbstract implements TpRatingPlanInterface
{
    use TpRatingPlanTrait;

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
}
