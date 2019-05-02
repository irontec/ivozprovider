<?php

namespace Tests\Provider\InvoiceScheduler;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceScheduler;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto;

class InvoiceSchedulerLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return InvoiceSchedulerDto
     */
    protected function createDto()
    {
        $invoiceSchedulerDto = new InvoiceSchedulerDto();
        $invoiceSchedulerDto
            ->setName('testReport')
            ->setUnit('week')
            ->setFrequency(1)
            ->setEmail('mikel+test-invoice@irontec.com')
            ->setTaxRate(3)
            ->setBrandId(1)
            ->setCompanyId(2);

        return $invoiceSchedulerDto;
    }

    /**
     * @return InvoiceScheduler
     */
    protected function addInvoiceScheduler()
    {
        $invoiceSchedulerDto =$this->createDto();

        /** @var InvoiceScheduler $invoiceScheduler */
        $invoiceScheduler = $this->entityTools
            ->persistDto($invoiceSchedulerDto, null, true);

        return $invoiceScheduler;
    }

    protected function updateInvoiceScheduler()
    {
        $this->addInvoiceScheduler();
        $this->resetChangelog();

        $invoiceSchedulerRepository = $this->em
            ->getRepository(InvoiceScheduler::class);

        $invoiceScheduler = $invoiceSchedulerRepository->find(1);

        /** @var InvoiceSchedulerDto $invoiceSchedulerDto */
        $invoiceSchedulerDto = $this->entityTools->entityToDto($invoiceScheduler);

        $invoiceSchedulerDto
            ->setName('UpdatedName');

        return $this
            ->entityTools
            ->persistDto($invoiceSchedulerDto, $invoiceScheduler, true);
    }

    protected function removeInvoiceScheduler()
    {
        $this->addInvoiceScheduler();
        $this->resetChangelog();

        $invoiceSchedulerRepository = $this->em
            ->getRepository(InvoiceScheduler::class);

        $invoiceScheduler = $invoiceSchedulerRepository->find(1);

        $this
            ->entityTools
            ->remove($invoiceScheduler);
    }

    /**
     * @test
     */
    public function it_persists_invoiceSchedulers()
    {
        $invoiceScheduler = $this->em
            ->getRepository(InvoiceScheduler::class);
        $fixtureInvoiceSchedulers = $invoiceScheduler->findAll();

        $this->addInvoiceScheduler();

        $brands = $invoiceScheduler->findAll();
        $this->assertCount(count($fixtureInvoiceSchedulers) + 1, $brands);
    }

    /**
     * @test
     */
    public function it_triggers_lifecycle_services()
    {
        $this->addInvoiceScheduler();
        $this->assetChangedEntities([
            InvoiceScheduler::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateInvoiceScheduler();
        $this->assetChangedEntities([
            InvoiceScheduler::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeInvoiceScheduler();
        $this->assetChangedEntities([
            InvoiceScheduler::class
        ]);
    }

    /////////////////////////////////////////////////
    ///
    /////////////////////////////////////////////////

    /**
     * @test
     * @deprecated
     */
    public function added_invoiceScheduler_has_next_execution()
    {
        $this->addInvoiceScheduler();

        /** @var Changelog[] $changelogEntries */
        $changelogEntries = $this->getChangelogByClass(
            InvoiceScheduler::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $diff = $changelog->getData();
        $this->assertArraySubset(
            [
                'name' => 'testReport',
                'unit' => 'week',
                'frequency' => 1,
                'email' => 'mikel+test-invoice@irontec.com',
                'taxRate' => 3,
                'brandId' => 1,
                'companyId' => 2,
                'id' => 2,
            ],
            $diff
        );

        $this->assertEquals(
            array_keys($diff),
            [
                'name',
                'unit',
                'frequency',
                'email',
                'nextExecution',
                'taxRate',
                'brandId',
                'companyId',
                'id',
            ]
        );

        $this->assertNotEmpty($diff['nextExecution']);
    }
}
