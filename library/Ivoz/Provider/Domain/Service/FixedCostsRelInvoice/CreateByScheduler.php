<?php

namespace Ivoz\Provider\Domain\Service\FixedCostsRelInvoice;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoice;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;

class CreateByScheduler
{
    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    /**
     * @param InvoiceSchedulerInterface $scheduler
     * @param InvoiceInterface $invoice
     *
     * @return void
     */
    public function execute(
        InvoiceSchedulerInterface $scheduler,
        InvoiceInterface $invoice
    ) {
        /** @var FixedCostsRelInvoiceSchedulerInterface[] $relFixedCosts */
        $relFixedCosts = $scheduler->getRelFixedCosts();
        foreach ($relFixedCosts as $relFixedCost) {
            $fixedCostRelInvoice = FixedCostsRelInvoice::fromFixedCostsRelInvoiceScheduler(
                $invoice,
                $relFixedCost
            );
            $this->entityTools->persist($fixedCostRelInvoice);
        }
    }
}
