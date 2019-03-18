<?php

namespace Ivoz\Provider\Domain\Model\Invoice;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

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

    /**
     * @param $companyId
     * @param $brandId
     * @param $utcOutDate
     * @param $invoiceIdToBeExcluded
     * @return \Ivoz\Provider\Domain\Model\Invoice\Invoice[]
     */
    public function getInvoices(
        int $companyId,
        int $brandId,
        string $utcOutDate,
        int $invoiceIdToBeExcluded = null
    );
}
