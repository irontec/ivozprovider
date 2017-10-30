<?php

namespace Ivoz\Provider\Domain\Model\PricingPlansRelTargetPattern;

/**
 * PricingPlansRelTargetPattern
 */
class PricingPlansRelTargetPattern extends PricingPlansRelTargetPatternAbstract implements PricingPlansRelTargetPatternInterface
{
    use PricingPlansRelTargetPatternTrait;

    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getCost($duration = null)
    {
        if (is_null($duration)) {

            //$this->_logger->log("Duration not set", \Zend_Log::ERR);
            return null;
        }

        $connectionCharge = $this->getConnectionCharge();
        $periodTime = $this->getPeriodTime();
        $periodCharge = ($this->getPerPeriodCharge() / 60) * $periodTime;

        if ($periodTime != 0) {
            $numPeriods = ceil($duration / $periodTime);
        } else {
            $numPeriods = 0;
        }

        return $connectionCharge + $numPeriods * $periodCharge;
    }
}

