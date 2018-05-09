<?php

namespace Tests\Provider\Invoice;

use Ivoz\Provider\Domain\Model\Invoice\Invoice;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class InvoiceLifeCycleTestLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;


    /**
     * @return Invoice
     */
    protected function getInvoicePdo()
    {
        $invoiceDto = new InvoiceDto();
        $invoiceDto
             ->setBrandId(1)
             ->setCompanyId(1)
             ->setInvoiceTemplateId(1)
             ->setNumber('2')
             ->setInDate(
                 new \DateTime('2018-02-01', new \DateTimeZone('UTC'))
             )
             ->setOutDate(
                 new \DateTime('2018-02-31', new \DateTimeZone('UTC'))
             )
             ->setTotal(0.372)
             ->setTaxRate(25.0)
             ->setTotalWithTax(1.330)
             ->setStatus('processing');
        
        return $invoiceDto;
    }

    /**
     * @return Invoice
     */
    protected function addInvoice()
    {
        return $this
            ->entityPersister
            ->persistDto($this->getInvoicePdo(), null, true);
    }

    /**
     * @test
     */
    public function it_persists_invoices()
    {
        $extensionRepository = $this->em
            ->getRepository(Invoice::class);

        $fixtureInvoices = $extensionRepository->findAll();
        $this->assertCount(1, $fixtureInvoices);

        $this->addInvoice();

        $extensions = $extensionRepository->findAll();
        $this->assertCount(
            count($fixtureInvoices) + 1,
            $extensions
        );
    }

    /**
     * @test
     */
    public function it_throws_exception_on_invalid_invoice()
    {
        $invoicePdo = $this->getInvoicePdo();
        $invoicePdo
            ->setInDate(
                new \DateTime('2018-02-31', new \DateTimeZone('UTC'))
            )
            ->setOutDate(
                new \DateTime('2018-02-30', new \DateTimeZone('UTC'))
            );

        $this->expectException(\DomainException::class);

        $this
            ->entityPersister
            ->persistDto($invoicePdo, null, true);
    }
}