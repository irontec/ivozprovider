<?php
namespace Ivoz\Provider\Domain\Model\PricingPlan;

/**
 * PricingPlan
 */
class PricingPlan extends PricingPlanAbstract implements PricingPlanInterface
{
    use PricingPlanTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
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

