<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceRepository;

class CheckValidity implements InvoiceLifecycleEventHandlerInterface
{
    public const PRE_PERSIST_PRIORITY = InvoiceLifecycleEventHandlerInterface::PRIORITY_HIGH;

    public const UNMETERED_CALLS = 50001;
    public const INVOICES_FOUND_IN_THE_SAME_RANGE_OF_DATE = 50003;
    public const SENSELESS_IN_OUT_DATE = 50005;
    public const FORBIDDEN_FUTURE_DATES = 50006;

    public function __construct(
        private BillableCallRepository $billableCallRepository,
        private InvoiceRepository $invoiveRepository
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY
        ];
    }

    /**
     * @throws \Exception
     * @return void
     */
    public function execute(InvoiceInterface $invoice)
    {
        if (!$invoice->mustCheckValidity()) {
            return;
        }

        $tz = $invoice
            ->getCompany()
            ->getDefaultTimezone()
            ->getTz();

        $invoiceTz = new \DateTimeZone($tz);
        $utcTz = new \DateTimeZone('UTC');

        /**
         * @var \Datetime $utcInDate
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

        $this->assertNoUnmeteredCalls($invoice);
        $this->assertNoInvoiceInDateRange($invoice, $utcInDate, $utcOutDate);
    }

    private function assertNoFutureDates(\DateTimeZone $invoiceTz, \DateTimeInterface $inDate, \DateTimeInterface $outDate): void
    {
        $now = (new \DateTime())->setTimezone($invoiceTz);
        $today = $now->setTime(0, 0, 0);
        if ($today < $inDate || $today < $outDate) {
            throw new \DomainException('Forbidden future dates', self::FORBIDDEN_FUTURE_DATES);
        }
    }

    /**
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\Query\QueryException
     */
    private function assertNoUnmeteredCalls(InvoiceInterface $invoice): void
    {

        $unratedCallNum = $this
            ->billableCallRepository
            ->countUnratedCallsByInvoice(
                $invoice
            );

        if ($unratedCallNum > 0) {
            throw new \DomainException('Unmetered calls', self::UNMETERED_CALLS);
        }
    }

    private function assertNoInvoiceInDateRange(InvoiceInterface $invoice, \DateTimeInterface $utcInDate, \DateTimeInterface $utcOutDate): void
    {
        $invoiceCount = $this->invoiveRepository->fetchInvoiceNumberInRange(
            (int) $invoice->getCompany()->getId(),
            (int) $invoice->getBrand()->getId(),
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
