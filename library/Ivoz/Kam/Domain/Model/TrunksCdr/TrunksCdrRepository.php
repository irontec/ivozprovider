<?php

namespace Ivoz\Kam\Domain\Model\TrunksCdr;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface TrunksCdrRepository extends ObjectRepository, Selectable
{
    /**
     * @param array $conditions
     * @param int $limit
     * @return mixed
     */
    public function getGeneratorByConditions(array $conditions, int $limit, array $order = null);

    /**
     * @param array $conditions
     * @param int $invoiceId
     * @return mixed
     */
    public function setInvoiceId(array $conditions, int $invoiceId);

    /**
     * @param int $invoiceId
     */
    public function resetInvoiceId(int $invoiceId);

    /**
     * @param int $companyId
     * @param int $brandId
     * @param string $startTime
     * @return mixed
     */
    public function countUntarificattedCallsBeforeDate(int $companyId, int $brandId, string $startTime);

    /**
     * @param int $companyId
     * @param int $brandId
     * @param string $startTime
     * @return mixed
     */
    public function countUntarificattedCallsInRange(int $companyId, int $brandId, string $startTime, string $endTime);
}

