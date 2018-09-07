<?php

namespace Ivoz\Provider\Domain\Model\CallCsvScheduler;

use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface CallCsvSchedulerRepository extends ObjectRepository, Selectable
{
    /**
     * @param Criteria $criteria
     * @return int
     */
    public function countByCriteria(Criteria $criteria);

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
