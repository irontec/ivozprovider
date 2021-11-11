<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler;

/**
 * FixedCostsRelInvoiceScheduler
 */
class FixedCostsRelInvoiceScheduler extends FixedCostsRelInvoiceSchedulerAbstract implements FixedCostsRelInvoiceSchedulerInterface
{
    use FixedCostsRelInvoiceSchedulerTrait;

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
