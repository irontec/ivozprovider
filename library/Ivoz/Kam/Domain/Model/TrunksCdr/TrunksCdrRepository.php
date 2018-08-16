<?php

namespace Ivoz\Kam\Domain\Model\TrunksCdr;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface TrunksCdrRepository extends ObjectRepository, Selectable
{

    /**
     * This method expects results to be marked as metered as soon as they're used:
     * a.k.a it does not apply any query offset, just a limit
     *
     * @param int $batchSize
     * @param array|null $order
     * @return \Generator
     */
    public function getUnmeteredCallsGeneratorWithoutOffset(int $batchSize, array $order = null);

    /**
     * @param array $conditions
     * @param int $limit
     * @param array|null $order
     * @return \Generator
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

    /**
     * @param array $ids
     */
    public function resetMetered(array $ids);
}

