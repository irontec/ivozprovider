<?php

namespace Ivoz\Kam\Domain\Model\AccCdr;

/**
 * AccCdr
 */
class AccCdr extends AccCdrAbstract implements AccCdrInterface
{
    use AccCdrTrait;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @todo move this to its own service
     */
    public function tarificate($plan = null)
    {
        Throw new \Exception('Not implemented yet.');
    }

    /**
     * @return bool
     */
    public function isBounced()
    {
        if ($this->getBounced() == 'yes') {
            return true;
        }

        return false;
    }

    /**
     * @param array $data
     * @return AccCdrInterface
     */
    public function setPricingPlanDetailsFromArray(array $data)
    {
        $pricingPlanDetails = array();

        if ($this->getPricingPlanDetails() && (strpos($this->getPricingPlanDetails(), '[') !== false)) {
            $pricingPlanDetails = json_decode($this->getPricingPlanDetails());
        } else if ($this->getPricingPlanDetails()) {
            $pricingPlanDetails = array(json_encode($this->getPricingPlanDetails()));
        }

        $data['meteringDate'] = $this->getMeteringDate();
        $pricingPlanDetails[count($pricingPlanDetails)] = $data;
        $data = json_encode($pricingPlanDetails);

        return $this->setPricingPlanDetails($data);
    }
}

