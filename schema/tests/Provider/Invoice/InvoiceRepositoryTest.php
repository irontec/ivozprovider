<?php

namespace Tests\Provider\Invoice;

use Ivoz\Provider\Domain\Model\Invoice\InvoiceRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Invoice\Invoice;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;

class InvoiceRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    const DATE_TIME_FORMAT = 'Y-m-d H:i:s';

    /**
     * @test
     */
    public function test_runner()
    {
        /** @var InvoiceRepository $invoiceRepository */
        $invoiceRepository = $this
            ->em
            ->getRepository(Invoice::class);

        $invoice = $this
            ->it_finds_invoices(
                $invoiceRepository
            );

        $brandId = $invoice->getBrand()->getId();
        $companyId = $invoice->getCompany()->getId();
        $inDate = $invoice->getInDate();
        $outDate = $invoice->getOutDate();

        $this->it_counts_invoices_where_outDate_is_between_range(
            $invoiceRepository,
            $brandId,
            $companyId,
            $inDate,
            $outDate
        );

        $this->it_counts_invoices_where_inDate_is_between_range(
            $invoiceRepository,
            $brandId,
            $companyId,
            $inDate,
            $outDate
        );

        $this->it_counts_invoices_that_are_within_current_range(
            $invoiceRepository,
            $brandId,
            $companyId,
            $inDate,
            $outDate
        );
    }

    private function it_finds_invoices(
        InvoiceRepository $invoiceRepository
    ) {
        $invoice = $invoiceRepository->find(1);

        $this->assertInstanceOf(
            Invoice::class,
            $invoice
        );

        return $invoice;
    }

    private function it_counts_invoices_where_outDate_is_between_range(
        InvoiceRepository $invoiceRepository,
        int $brandId,
        int $companyId,
        \DateTime $inDate,
        \DateTime $outDate
    ) {
        $beforeInDate = DateTimeHelper::sub(
            $inDate,
            \DateInterval::createFromDateString('12 hours')
        );
        $beforeInDateStr = $beforeInDate->format(self::DATE_TIME_FORMAT);

        $beforeOutDate = DateTimeHelper::sub(
            $outDate,
            \DateInterval::createFromDateString('12 hours')
        );
        $beforeOutDateStr = $beforeOutDate->format(self::DATE_TIME_FORMAT);

        $count = $invoiceRepository
            ->fetchInvoiceNumberInRange(
                $companyId,
                $brandId,
                $beforeInDateStr,
                $beforeOutDateStr
            );

        $this->assertGreaterThanOrEqual(
            1,
            $count
        );
    }

    private function it_counts_invoices_where_inDate_is_between_range(
        InvoiceRepository $invoiceRepository,
        int $brandId,
        int $companyId,
        \DateTime $inDate,
        \DateTime $outDate
    ) {
        $afterInDate = DateTimeHelper::add(
            $inDate,
            \DateInterval::createFromDateString('12 hours')
        );
        $afterInDateStr = $afterInDate
            ->format(self::DATE_TIME_FORMAT);

        $afterOutDate = DateTimeHelper::add(
            $outDate,
            \DateInterval::createFromDateString('12 hours')
        );
        $afterOutDateStr = $afterOutDate
            ->format(self::DATE_TIME_FORMAT);

        $count = $invoiceRepository
            ->fetchInvoiceNumberInRange(
                $companyId,
                $brandId,
                $afterInDateStr,
                $afterOutDateStr
            );

        $this->assertGreaterThanOrEqual(
            1,
            $count
        );
    }

    private function it_counts_invoices_that_are_within_current_range(
        InvoiceRepository $invoiceRepository,
        int $brandId,
        int $companyId,
        \DateTime $inDate,
        \DateTime $outDate
    ) {
        $beforeInDate = DateTimeHelper::sub(
            $inDate,
            \DateInterval::createFromDateString('12 hours')
        );
        $beforeInDateStr = $beforeInDate
            ->format(self::DATE_TIME_FORMAT);

        $afterOutDate = DateTimeHelper::add(
            $outDate,
            \DateInterval::createFromDateString('12 hours')
        );
        $afterOutDateStr = $afterOutDate
            ->format(self::DATE_TIME_FORMAT);

        $count = $invoiceRepository
            ->fetchInvoiceNumberInRange(
                $companyId,
                $brandId,
                $beforeInDateStr,
                $afterOutDateStr
            );

        $this->assertGreaterThanOrEqual(
            1,
            $count
        );
    }
}
