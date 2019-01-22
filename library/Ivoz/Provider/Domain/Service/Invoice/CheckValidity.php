<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;
use Ivoz\Provider\Domain\Model\Invoice\Invoice;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceRepository;

class CheckValidity implements InvoiceLifecycleEventHandlerInterface
{
    const PRE_PERSIST_PRIORITY = InvoiceLifecycleEventHandlerInterface::PRIORITY_HIGH;

    const UNMETERED_CALLS = 50001;
    const INVOICES_FOUND_IN_THE_SAME_RANGE_OF_DATE = 50003;
    const UNBILLED_CALLS_AFTER_OUT_DATE = 50004;
    const SENSELESS_IN_OUT_DATE = 50005;
    const FORBIDDEN_FUTURE_DATES = 50006;

    /**
     * @var BillableCallRepository
     */
    protected $billableCallRepository;

    /**
     * @var InvoiceRepository
     */
    protected $invoiveRepository;

    public function __construct(
        BillableCallRepository $billableCallRepository,
        InvoiceRepository $invoiveRepository
    ) {
        $this->billableCallRepository = $billableCallRepository;
        $this->invoiveRepository = $invoiveRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY
        ];
    }

    /**
     * @param InvoiceInterface $invoice
     * @throws \Exception
     */
    public function execute(InvoiceInterface $invoice)
    {
        $tz = $invoice
            ->getCompany()
            ->getDefaultTimezone()
            ->getTz();
        $invoiceTz = new \DateTimeZone($tz);
        $utcTz = new \DateTimeZone('UTC');

        /**
         * @var \Datetime $inDate
         */
        $utcInDate = $invoice->getInDate();
        $inDate = (clone $utcInDate)->setTimezone($invoiceTz);

        /**
         * @var \Datetime $outDate
         */
        $outDate = $invoice->getOutDate();
        $utcOutDate = $outDate->setTimezone($utcTz);

        $this->assertNoFutureDates($invoiceTz, $inDate, $outDate);

        if ($inDate >= $outDate) {
            throw new \DomainException('In-Out date error', self::SENSELESS_IN_OUT_DATE);
        }

        $this->assertNoUnmeteredCalls($invoice, $utcOutDate);
        $this->assertNoUnbilledCallsAfterOutDate($invoice, $utcOutDate, $utcTz);
        $this->assertNoInvoiceInDateRange($invoice, $utcInDate, $utcOutDate);
    }

    /**
     * @param $invoiceTz
     * @param $inDate
     * @param $outDate
     */
    private function assertNoFutureDates($invoiceTz, $inDate, $outDate)
    {
        $now = (new \DateTime())->setTimezone($invoiceTz);
        $today = $now->setTime(0, 0, 0);
        if ($today < $inDate || $today < $outDate) {
            throw new \DomainException('Forbidden future dates', self::FORBIDDEN_FUTURE_DATES);
        }
    }

    /**
     * @param InvoiceInterface $invoice
     * @param \DateTime $utcOutDate
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\Query\QueryException
     */
    private function assertNoUnmeteredCalls(InvoiceInterface $invoice, $utcOutDate)
    {
        $untarificattedCallNum = $this->billableCallRepository->countUntarificattedCallsBeforeDate(
            $invoice->getCompany()->getId(),
            $invoice->getBrand()->getId(),
            $utcOutDate->format('Y-m-d H:i:s')
        );

        if ($untarificattedCallNum > 0) {
            throw new \DomainException('Unmetered calls', self::UNMETERED_CALLS);
        }
    }

    /**
     * @param InvoiceInterface $invoice
     * @param $utcOutDate
     * @param $utcTz
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\Query\QueryException
     */
    private function assertNoUnbilledCallsAfterOutDate(InvoiceInterface $invoice, $utcOutDate, $utcTz)
    {
        /**
         * @var Invoice[] $invoices
         */
        $invoices = $this
            ->invoiveRepository
            ->getInvoices(
                $invoice->getCompany()->getId(),
                $invoice->getBrand()->getId(),
                $utcOutDate->format('Y-m-d H:i:s'),
                $invoice->getId()
            );

        if (!empty($invoices)) {
            $firstInvoice = $invoices[0];
            $nextInvoiceInDate = $firstInvoice->getInDate();

            $calls = $this->billableCallRepository->countUntarificattedCallsInRange(
                $firstInvoice->getCompany()->getId(),
                $firstInvoice->getBrand()->getId(),
                $utcOutDate->format('Y-m-d H:i:s'),
                $nextInvoiceInDate->setTimezone($utcTz)->format('Y-m-d H:i:s')
            );

            if ($calls > 0) {
                throw new \DomainException('Unbilled calls after out date', self::UNBILLED_CALLS_AFTER_OUT_DATE);
            }
        }
    }

    /**
     * @param InvoiceInterface $invoice
     * @param $utcInDate
     * @param $utcOutDate
     */
    private function assertNoInvoiceInDateRange(InvoiceInterface $invoice, $utcInDate, $utcOutDate)
    {
        $invoiceCount = $this->invoiveRepository->fetchInvoiceNumberInRange(
            $invoice->getCompany()->getId(),
            $invoice->getBrand()->getId(),
            $utcInDate->format('Y-m-d H:i:s'),
            $utcOutDate->format('Y-m-d H:i:s'),
            $invoice->getId()
        );

        if ($invoiceCount) {
            throw new \DomainException(
                'Invoices found in the same range of date',
                self::INVOICES_FOUND_IN_THE_SAME_RANGE_OF_DATE
            );
        }
    }
}
