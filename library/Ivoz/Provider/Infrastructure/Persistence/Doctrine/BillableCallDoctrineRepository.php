<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Traits\GetGeneratorByConditionsTrait;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCall;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * BillableCallDoctrineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BillableCallDoctrineRepository extends ServiceEntityRepository implements BillableCallRepository
{
    use GetGeneratorByConditionsTrait;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BillableCall::class);
    }

    /**
     * @param int $id
     * @return BillableCallInterface
     */
    public function findOneByTrunksCdrId($id)
    {
        /** @var BillableCallInterface $response */
        $response = $this->findOneBy([
            'trunksCdr' => $id
        ]);

        return $response;
    }

    /**
     * @inheritdoc
     * @see BillableCallRepository::areRetarificable
     */
    public function areRetarificable(array $pks)
    {
        $qb = $this->createQueryBuilder('self');

        $conditions = [
            ['id', 'in', $pks],
            'or' => [
                ['invoice', 'isNotNull']
            ]
        ];

        $qb
            ->select('count(self)')
            ->addCriteria(
                CriteriaHelper::fromArray($conditions)
            );

        $elementNumber = (int) $qb->getQuery()->getSingleScalarResult();
        return $elementNumber === 0;
    }

    /**
     * Return non externally rated calls without cgrid
     * @inheritdoc
     * @see BillableCallRepository::findUnratedInGroup
     */
    public function findUnratedInGroup(array $pks)
    {
        $qb = $this->createQueryBuilder('self');

        $conditions = [
            ['self.id', 'in', $pks],
            ['self.invoice', 'in', $pks],
            ['self.direction', 'eq', BillableCallInterface::DIRECTION_OUTBOUND],
            'or' => [
                ['carrier.externallyRated', 'eq', 0],
                ['self.carrier', 'isNUll']
            ]
        ];

        $qb
            ->select('self, trunksCdr')
            ->innerJoin('self.trunksCdr', 'trunksCdr')
            ->leftJoin('self.carrier', 'carrier')
            ->addCriteria(
                CriteriaHelper::fromArray($conditions)
            );
        $query = $qb->getQuery();

        return $query->getResult();
    }

    /**
     * @inheritdoc
     * @see BillableCallRepository::findRerateableCgridsInGroup
     */
    public function findRerateableCgridsInGroup(array $ids)
    {
        $qb = $this->createQueryBuilder('self');

        $conditions = [
            ['id', 'in', $ids],
            ['trunksCdr.cgrid', 'isNotNull'],
            ['self.direction', 'eq', BillableCallInterface::DIRECTION_OUTBOUND],
            'or' => [
                ['carrier.externallyRated', 'eq', 0],
                ['self.carrier', 'isNull']
            ]
        ];

        $qb
            ->select('self, trunksCdr')
            ->innerJoin('self.trunksCdr', 'trunksCdr')
            ->leftJoin('self.carrier', 'carrier')
            ->addCriteria(
                CriteriaHelper::fromArray($conditions)
            );

        $query = $qb->getQuery();

        /** @var BillableCallInterface[] $billableCalls */
        $billableCalls = $query->getResult();

        $cgrids = [];
        foreach ($billableCalls as $billableCall) {
            $cgrids[] = $billableCall->getTrunksCdr()->getCgrid();
        }

        return $cgrids;
    }

    /**
     * @inheritdoc
     * @see BillableCallRepository::idsToTrunkCdrId
     */
    public function idsToTrunkCdrId(array $ids)
    {
        $qb = $this->createQueryBuilder('self');

        $conditions = [
            ['id', 'in', $ids]
        ];

        $qb
            ->select('IDENTITY(self.trunksCdr) as trunksCdr')
            ->addCriteria(
                CriteriaHelper::fromArray($conditions)
            );

        $result = $qb
            ->getQuery()
            ->getScalarResult();

        $trunkCdrIds = array_map(
            function ($item) {
                return $item['trunksCdr'];
            },
            $result
        );

        if (count($ids) !== count($trunkCdrIds)) {
            throw new \DomainException('Some id were not found');
        }

        return $trunkCdrIds;
    }

    /**
     * @inheritdoc
     * @see BillableCallRepository::resetPricingData
     */
    public function resetPricingData(array $ids)
    {
        $qb = $this
            ->createQueryBuilder('self')
            ->update($this->_entityName, 'self')
            ->set('self.price', ':nullValue')
            ->set('self.cost', ':nullValue')
            ->set('self.destination', ':nullValue')
            ->set('self.destinationName', ':nullValue')
            ->set('self.ratingPlanGroup', ':nullValue')
            ->set('self.ratingPlanName', ':nullValue')
            ->setParameter(':nullValue', null)
            ->where('self.id in (:ids)')
            ->setParameter(':ids', $ids);

        $qb->getQuery()->execute();
    }

    /**
     * @inheritdoc
     * @see BillableCallRepository::resetInvoiceId
     */
    public function resetInvoiceId(int $invoiceId)
    {
        $qb = $this
            ->createQueryBuilder('self')
            ->update($this->_entityName, 'self')
            ->set('self.invoice', ':nullValue')
            ->setParameter(':nullValue', null)
            ->where('self.invoice = :invoiceId')
            ->setParameter(':invoiceId', $invoiceId);

        $qb->getQuery()->execute();
    }

    /**
     * @inheritdoc
     * @see BillableCallRepository::setInvoiceId
     */
    public function setInvoiceId(array $conditions, int $invoiceId)
    {
        $qb = $this
            ->createQueryBuilder('self')
            ->update($this->_entityName, 'self')
            ->set('self.invoice', ':invoiceId')
            ->setParameter(':invoiceId', $invoiceId)
            ->addCriteria(
                CriteriaHelper::fromArray($conditions)
            );

        $qb->getQuery()->execute();
    }

    /**
     * @inheritdoc
     * @see BillableCallRepository::countUntarificattedCallsBeforeDate
     */
    public function countUntarificattedCallsBeforeDate(int $companyId, int $brandId, string $startTime)
    {
        $qb = $this->createQueryBuilder('self');
        $conditions = [
            ['company', 'eq', $companyId],
            ['brand', 'eq', $brandId],
            ['startTime', 'lt', $startTime],
            ['carrier', 'neq', null],
            ['carrier', 'neq', ''],
            'or' => [
                ['price', 'isNull'],
                ['price', 'lt', 0],
            ]
        ];

        $qb
            ->select('count(self)')
            ->addCriteria(
                CriteriaHelper::fromArray($conditions)
            );

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * @inheritdoc
     * @see BillableCallRepository::countUntarificattedCallsInRange
     */
    public function countUntarificattedCallsInRange(int $companyId, int $brandId, string $startTime, string $endTime)
    {
        $qb = $this->createQueryBuilder('self');
        
        $conditions = [
            ['company', 'eq', $companyId],
            ['brand', 'eq', $brandId],
            ['startTime', 'gt', $startTime],
            ['carrier', 'neq', null],
            ['carrier', 'neq', ''],
            'or' => [
                ['price', 'isNull'],
                ['price', 'lt', 0],
            ]
        ];

        $qb
            ->select('count(self)')
            ->addCriteria(
                CriteriaHelper::fromArray($conditions)
            )->andWhere(
                $qb->expr()->lt(
                    '(self.startTime + self.duration)',
                    preg_replace('/[^0-9]+/', '', $endTime)
                )
            );

        return (int) $qb->getQuery()->getSingleScalarResult();
    }
}
