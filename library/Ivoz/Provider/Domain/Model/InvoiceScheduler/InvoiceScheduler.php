<?php

namespace Ivoz\Provider\Domain\Model\InvoiceScheduler;

/**
 * InvoiceScheduler
 */
class InvoiceScheduler extends InvoiceSchedulerAbstract implements InvoiceSchedulerInterface
{
    use InvoiceSchedulerTrait;

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

