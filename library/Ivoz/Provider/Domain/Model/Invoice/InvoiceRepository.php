<?php

namespace Ivoz\Provider\Domain\Model\Invoice;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface InvoiceRepository extends ObjectRepository, Selectable
{
    /**
     * @param int $companyId
     * @param int $brandId
     * @param string $utcInDate
     * @param string $utcOutDate
     * @param int $invoiceIdToBeExcluded
     * @return int
     */
    public function fetchInvoiceNumberInRange(
        int $companyId,
        int $brandId,
        string $utcInDate,
        string $utcOutDate,
        int $invoiceIdToBeExcluded = null
    );
}
