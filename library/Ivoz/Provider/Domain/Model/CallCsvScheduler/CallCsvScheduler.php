<?php

namespace Ivoz\Provider\Domain\Model\CallCsvScheduler;

use Ivoz\Core\Domain\Model\SchedulerInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;

/**
 * CallCsvScheduler
 */
class CallCsvScheduler extends CallCsvSchedulerAbstract implements CallCsvSchedulerInterface, SchedulerInterface
{
    use CallCsvSchedulerTrait;

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
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    public function getTimezone()
    {
        $timeZone = $this->getBrand()
            ? $this->getBrand()->getDefaultTimezone()
            : $this->getCompany()->getDefaultTimezone();

        return $timeZone;
    }

    /**
     * @return \DateInterval
     */
    public function getInterval()
    {
        $frecuency = $this->getFrequency();

        switch ($this->getUnit()) {
            /** @see http://php.net/manual/es/dateinterval.createfromdatestring.php */
            case 'year':
                return new \DateInterval("P${frecuency}Y");
            case 'month':
                return new \DateInterval("P${frecuency}M");
            case 'week':
                return new \DateInterval("P${frecuency}W");
        }
    }
}

