<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceDto;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;

class Regenerate
{
    public function __construct(
        private EntityTools $entityTools,
    ) {
    }

    public function execute(InvoiceInterface $invoice): void
    {
        /** @var InvoiceDto $invoiceDto */
        $invoiceDto = $this->entityTools->entityToDto(
            $invoice
        );

        $invoiceDto->setStatus(
            InvoiceInterface::STATUS_WAITING
        );

        $this->entityTools->persistDto(
            $invoiceDto,
            $invoice
        );
    }
}
