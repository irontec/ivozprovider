<?php

namespace Tests\Provider\InvoiceScheduler;

use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceScheduler;

class InvoiceSchedulerRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->it_finds_pending_schedulers();
        $this->it_finds_company_ids_in_use();
    }

    public function it_finds_pending_schedulers()
    {
        /** @var InvoiceSchedulerRepository $invoiceSchedulerRepository */
        $invoiceSchedulerRepository = $this->em
            ->getRepository(InvoiceScheduler::class);
        $pendingSchedulers = $invoiceSchedulerRepository->getPendingSchedulers();

        $this->assertIsArray(
            $pendingSchedulers
        );
    }

    public function it_finds_company_ids_in_use()
    {
        /** @var InvoiceSchedulerRepository $invoiceSchedulerRepository */
        $invoiceSchedulerRepository = $this->em
            ->getRepository(InvoiceScheduler::class);
        $companyIdsInUse = $invoiceSchedulerRepository->getCompanyIdsInUse(1);

        $this->assertIsArray(
            $companyIdsInUse
        );
    }
}
