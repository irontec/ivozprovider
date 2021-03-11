<?php

namespace Ivoz\Provider\Domain\Model\InvoiceScheduler;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface InvoiceSchedulerRepository extends ObjectRepository, Selectable
{
    /**
     * @return InvoiceSchedulerInterface[]
     */
    public function getPendingSchedulers();

    /**
     * @return array
     */
    public function getCompanyIdsInUse($schedulerIdToExclude);
}
