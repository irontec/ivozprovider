<?php

namespace Ivoz\Provider\Domain\Model\PricingPlansRelTargetPattern;

use Assert\Assertion;

/**
 * PricingPlansRelTargetPattern
 */
class PricingPlansRelTargetPattern extends PricingPlansRelTargetPatternAbstract implements PricingPlansRelTargetPatternInterface
{
    use PricingPlansRelTargetPatternTrait;

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

    /**
     * {@inheritDoc}
     */
    public function setConnectionCharge($connectionCharge)
    {
        Assertion::regex((string) $connectionCharge, '/^[0-9]{1,6}[.]{0,1}[0-9]*$/');
        return parent::setConnectionCharge($connectionCharge);
    }

    /**
     * {@inheritDoc}
     */
    public function setPerPeriodCharge($perPeriodCharge)
    {
        Assertion::regex((string) $perPeriodCharge, '/^[0-9]{1,6}[.]{0,1}[0-9]*$/');
        return parent::setPerPeriodCharge($perPeriodCharge);
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

