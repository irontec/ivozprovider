<?php

namespace Ivoz\Provider\Domain\Model\InvoiceScheduler;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

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
