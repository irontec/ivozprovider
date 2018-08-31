<?php

namespace Ivoz\Provider\Domain\Model\RatingPlan;

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

    /**
     * CGRates tag for this Rating Plan
     *
     * @return string
     */
    public function getCgrTag()
    {
        return sprintf("b%drp%d",
            $this->getBrand()->getId(),
            $this->getId()
        );
    }

}

