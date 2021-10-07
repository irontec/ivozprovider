<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Ivoz\Provider\Domain\Model\Invoice\Invoice;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * InvoiceDoctrineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InvoiceDoctrineRepository extends ServiceEntityRepository implements InvoiceRepository
{
    const ENTITY_ALIAS = 'invoice';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Invoice::class);
    }

    /**
     * @inheritDoc
     */
    public function fetchInvoiceNumberInRange(
        int $companyId,
        int $brandId,
        string $utcInDate,
        string $utcOutDate,
        int $invoiceIdToBeExcluded = null
    ) {
        $dateValidationQuerySegments = [
            // $utcOutDate between (inDate, outDate)
            self::ENTITY_ALIAS . '.inDate <= :utcOutDate AND ' . self::ENTITY_ALIAS . '.outDate >= :utcOutDate',
            // $utcInDate between (inDate, outDate)
            self::ENTITY_ALIAS . '.inDate <= :startTimeUtc AND ' . self::ENTITY_ALIAS . '.outDate >= :startTimeUtc',
            // $utcInDate < inDate AND $utcOutDate > outDate
            self::ENTITY_ALIAS . '.inDate >= :startTimeUtc AND ' . self::ENTITY_ALIAS . '.outDate <= :utcOutDate',
        ];

        $dateValidationQuerySegments = array_map(
            function ($row) {
                return '(' . $row . ')';
            },
            $dateValidationQuerySegments
        );

        $dateValidationQueryStr =
            '('
            . implode(' OR ', $dateValidationQuerySegments)
            . ')';

        $querySegments = [
            self::ENTITY_ALIAS . '.company = :companyId',
            self::ENTITY_ALIAS . '.brand = :brandId',
            $dateValidationQueryStr
        ];

        $queryArguments = [
            'companyId' => $companyId,
            'brandId' => $brandId,
            'startTimeUtc' => $utcInDate,
            'utcOutDate' => $utcOutDate
        ];

        if ($invoiceIdToBeExcluded) {
            $querySegments[] = self::ENTITY_ALIAS . '.id != :invoiceIdToBeExcluded';
            $queryArguments['invoiceIdToBeExcluded'] = $invoiceIdToBeExcluded;
        }

        $query = implode(' AND ', $querySegments);
        $qb = $this->createQueryBuilder(self::ENTITY_ALIAS);
        $qb
            ->select('count(' . self::ENTITY_ALIAS  . ')')
            ->where($query)
            ->setParameters($queryArguments);

        return $qb
            ->getQuery()
            ->getSingleScalarResult();
    }
}
