<?php
namespace Ivoz\Provider\Domain\Model\PricingPlan;

/**
 * PricingPlan
 */
class PricingPlan extends PricingPlanAbstract implements PricingPlanInterface
{
    use PricingPlanTrait;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

