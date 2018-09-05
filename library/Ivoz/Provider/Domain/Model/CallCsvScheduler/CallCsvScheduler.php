<?php

namespace Ivoz\Provider\Domain\Model\CallCsvScheduler;

use Ivoz\Core\Domain\Model\SchedulerInterface;

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
}

