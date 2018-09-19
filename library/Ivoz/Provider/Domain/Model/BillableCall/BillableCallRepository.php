<?php

namespace Ivoz\Provider\Domain\Model\BillableCall;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface BillableCallRepository extends ObjectRepository, Selectable
{
    /**
     * @param array $pks
     * @return bool
     */
    public function areRetarificable(array $pks);

    /**
     * @param array $ids
     * @return array
     */
    public function idsToCgrid(array $ids);

    /**
     * @param array $ids
     * @return array
     */
    public function idsToTrunkCdrId(array $ids);

    /**
     * @param array $ids
     * @return mixed
     */
    public function resetPrices(array $ids);

    /**
     * @param int $invoiceId
     * @return mixed
     */
    public function resetInvoiceId(int $invoiceId);

    /**
     * @param array $conditions
     * @param int $invoiceId
     * @return mixed
     */
    public function setInvoiceId(array $conditions, int $invoiceId);

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

    /**
     * @param array $conditions
     * @param int $batchSize
     * @param array|null $order
     * @return \Generator
     */
    public function getGeneratorByConditions(array $conditions, int $batchSize, array $order = null);
}
