<?php

namespace Ivoz\Provider\Domain\Model\CallCsvScheduler;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface CallCsvSchedulerRepository extends ObjectRepository, Selectable
{
    /**
     * @param CallCsvSchedulerInterface $callCsvScheduler
     * @return bool
     */
    public function hasUniqueName(CallCsvSchedulerInterface $callCsvScheduler);

    /**
     * @return CallCsvSchedulerInterface[]
     */
    public function getPendingSchedulers();

    /**
     * @poram integer $schedulerIdToExclude
     * @return array
     */
    public function getCompanyIdsInUse($schedulerIdToExclude);
}
