<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdr;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrRepository;
use Ivoz\Provider\Domain\Model\Invoice\Invoice;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceRepository;
use Ivoz\Kam\Domain\Model\TrunksCdr\AccCdrRepository;

/**
 * Class CheckValidity
 * @package Ivoz\Provider\Domain\Invoice\CompanyAdmin
 * @lifecycle pre_persist
 */
class CheckValidity implements InvoiceLifecycleEventHandlerInterface
{
    const UNMETERED_CALLS = 50001;
    const INVOICES_FOUND_IN_THE_SAME_RANGE_OF_DATE = 50003;
    const UNBILLED_CALLS_AFTER_OUT_DATE = 50004;
    const SENSELESS_IN_OUT_DATE = 50005;

    /**
     * @var TrunksCdrRepository
     */
    protected $trunksCdrRepository;

    /**
     * @var InvoiceRepository
     */
    protected $invoiveRepository;

    public function __construct(
        TrunksCdrRepository $trunksCdrRepository,
        InvoiceRepository $invoiveRepository
    ) {
        $this->trunksCdrRepository = $trunksCdrRepository;
        $this->invoiveRepository = $invoiveRepository;
    }

    /**
     * @throws \DomainException
     */
    public function execute(InvoiceInterface $entity)
    {
        $tz = $entity
            ->getCompany()
            ->getDefaultTimezone()
            ->getTz();
        $invoiceTz = new \DateTimeZone($tz);

        /**
         * @var \Datetime $inDate
         */
        $inDate = $entity->getInDate();
        $inDate->setTimezone($invoiceTz);

        /**
         * @var \Datetime $outDate
         */
        $outDate = $entity->getOutDate();
        $oneSecAgo = new \DateInterval('PT1S');

        $outDate
            ->setTimezone($invoiceTz)
            ->add(new \DateInterval('P1D'))
            ->sub($oneSecAgo);

        /**
         * @todo double check this
         */
        if ($inDate >= $outDate) {
            throw new \DomainException('', self::SENSELESS_IN_OUT_DATE);
        }

        $untarificattedCallNum = $this->trunksCdrRepository->countUntarificattedCallsBeforeDate(
            $entity->getCompany()->getId(),
            $entity->getBrand()->getId(),
            $outDate->format('Y-m-d H:i:s')
        );

        if ($untarificattedCallNum > 0) {
            throw new \DomainException('', self::UNMETERED_CALLS);
        }

        $utcOutDate = $outDate
            ->setTimezone($invoiceTz)
            ->format('Y-m-d H:i:s');

        /**
         * @var Invoice[] $invoices
         */
        $invoices = $this
            ->invoiveRepository
            ->getInvoices(
                $entity->getCompany()->getId(),
                $entity->getBrand()->getId(),
                $utcOutDate,
                $entity->getId()
            );

        if (!empty($invoices)) {

            $invoice = $invoices[0];
            $nextInvoiceInDate = $invoice->getInDate();

            $calls = $this->trunksCdrRepository->countUntarificattedCallsInRange(
                $entity->getCompany()->getId(),
                $entity->getBrand()->getId(),
                $outDate->setTimezone($invoiceTz)->format('Y-m-d H:i:s'),
                $nextInvoiceInDate->setTimezone($invoiceTz)->format('Y-m-d H:i:s')
            );

            if ($calls > 0) {
                throw new \DomainException('', self::UNBILLED_CALLS_AFTER_OUT_DATE);
            }
        }

        $utcInDate = $inDate
            ->setTimezone($invoiceTz)
            ->format('Y-m-d H:i:s');

        $invoiceCount = $this->invoiveRepository->fetchInvoiceNumberInRange(
            $entity->getCompany()->getId(),
            $entity->getBrand()->getId(),
            $utcInDate,
            $utcOutDate,
            $entity->getId()
        );

        if ($invoiceCount) {
            throw new \DomainException('', self::INVOICES_FOUND_IN_THE_SAME_RANGE_OF_DATE);
        }
    }
}