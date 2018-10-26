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
    public function it_finds_pending_schedulers()
    {
        /** @var InvoiceSchedulerRepository $invoiceSchedulerRepository */
        $invoiceSchedulerRepository = $this->em
            ->getRepository(InvoiceScheduler::class);
        $pendingSchedulers = $invoiceSchedulerRepository->getPendingSchedulers();

        $this->assertInternalType(
            'array',
            $pendingSchedulers
        );
    }

    /**
     * @test
     */
    public function it_finds_company_ids_in_use()
    {
        /** @var InvoiceSchedulerRepository $invoiceSchedulerRepository */
        $invoiceSchedulerRepository = $this->em
            ->getRepository(InvoiceScheduler::class);
        $companyIdsInUse = $invoiceSchedulerRepository->getCompanyIdsInUse(1);

        $this->assertInternalType(
            'array',
            $companyIdsInUse
        );
    }
}