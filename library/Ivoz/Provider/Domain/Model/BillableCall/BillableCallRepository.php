<?php

namespace Ivoz\Provider\Domain\Model\BillableCall;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;

interface BillableCallRepository extends ObjectRepository, Selectable
{

    /**
     * @param string $callid
     * @param int $brandId
     * @return BillableCallInterface[]
     */
    public function findOutboundByCallid(string $callid, int $brandId = null);

    /**
     * @param int $id
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
     * @return int affected rows
     */
    public function resetPricingData(array $ids): int;

    /**
     * @return int affected rows
     */
    public function resetInvoiceId(int $invoiceId): int;

    /**
     * @return int affected rows
     */
    public function setInvoiceId(InvoiceInterface $invoice): int;

    /**
     * @param InvoiceInterface $invoice
     * @return mixed
     */
    public function getGeneratorByInvoice(InvoiceInterface $invoice);

    /**
     * @param InvoiceInterface $invoice
     * @return array
     */
    public function getUnratedCallIdsByInvoice(InvoiceInterface $invoice): array;

    /**
     * @param InvoiceInterface $invoice
     * @return int|mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\Query\QueryException
     */
    public function countUnratedCallsByInvoice(InvoiceInterface $invoice);

    /**
     * @param array $conditions
     * @param int $batchSize
     * @param array|null $order
     * @return \Generator
     */
    public function getGeneratorByConditions(array $conditions, int $batchSize, array $order = null);

    /**
     * @throws \Doctrine\ORM\NoResultException
     */
    public function getMinStartTime(int $fromId = 0): \DateTime;


    public function getMaxIdUntilDate(int $fromId, \DateTime $date): int;

    /**
     * @return int[]
     */
    public function getIdsInRange(int $fromId, int $untilId, int $limit): array;
}
