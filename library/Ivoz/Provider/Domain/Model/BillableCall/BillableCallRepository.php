<?php

namespace Ivoz\Provider\Domain\Model\BillableCall;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface BillableCallRepository extends ObjectRepository, Selectable
{
    /**
     * @param $id
     * @return BillableCallInterface
     */
    public function findOneByTrunksCdrId($id);

    /**
     * @param array $pks
     * @return bool
     */
    public function areRetarificable(array $pks);


    /**
     * Return non externally rated calls without cgrid
     * @param array $pks
     * @return BillableCallInterface[]
     */
    public function findUnratedInGroup(array $pks);

    /**
     * @param array $ids
     * @return array
     */
    public function findRerateableCgridsInGroup(array $ids);

    /**
     * @param array $ids
     * @return array
     * @throws \Exception | \DomainException
     */
    public function idsToTrunkCdrId(array $ids);

    /**
     * @param array $ids
     * @return void
     */
    public function resetPricingData(array $ids);

    /**
     * @param int $invoiceId
     * @return void
     */
    public function resetInvoiceId(int $invoiceId);

    /**
     * @param array $conditions
     * @param int $invoiceId
     * @return void
     */
    public function setInvoiceId(array $conditions, int $invoiceId);

    /**
     * @param int $companyId
     * @param int $brandId
     * @param string $startTime
     * @return int|mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\Query\QueryException
     */
    public function countUntarificattedCallsBeforeDate(int $companyId, int $brandId, string $startTime);

    /**
     * @param int $companyId
     * @param int $brandId
     * @param string $startTime
     * @param string $endTime
     * @return int|mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\Query\QueryException
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
