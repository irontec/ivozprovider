<?php

namespace Tests\Provider\Invoice;

use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceScheduler;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto;
use Ivoz\Provider\Domain\Service\Invoice\CreateByScheduler;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Invoice\Invoice;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceDto;

class CreateBySchedulerServiceTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function it_creates_invoices()
    {
        $invoiceSchedulerRepository = $this->em
            ->getRepository(InvoiceScheduler::class);

        $fixtureInvoice = $invoiceSchedulerRepository
            ->find(1);

        $service = $this
            ->serviceContainer
            ->get(
                CreateByScheduler::class
            );

        $service
            ->execute($fixtureInvoice);

        ///////////////////////

        $changelogEntries = $this->getChangelogByClass(
            Invoice::class
        );

        $this->assertCount(1, $changelogEntries);
    }

    /**
     * @test
     */
    public function date_ranges_are_lower_than_next_execution_day()
    {
        $invoiceScheduler = $this->createScheduler('2018-12-10 08:00:00');

        $service = $this
            ->serviceContainer
            ->get(
                CreateByScheduler::class
            );

        $service
            ->execute($invoiceScheduler);

        ///////////////////////

        $changelogEntries = $this->getChangelogByClass(
            Invoice::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $diff = $changelog->getData();
        $this->assertArraySubset(
            [
                'inDate' => '2018-12-02 23:00:00',
                'outDate' => '2018-12-09 22:59:59'
            ],
            $diff
        );
    }

    /**
     * @test
     */
    public function next_execution_is_properly_updated()
    {
        $invoiceScheduler = $this->createScheduler('2018-11-10 08:00:00');

        $service = $this
            ->serviceContainer
            ->get(
                CreateByScheduler::class
            );

        $service
            ->execute($invoiceScheduler);

        $changelogEntries = $this->getChangelogByClass(
            InvoiceScheduler::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $diff = $changelog->getData();
        $this->assertArraySubset(
            [
                'nextExecution' => '2018-11-17 08:00:00'
            ],
            $diff
        );
    }

    private function createScheduler($nextExecution): InvoiceScheduler
    {
        $schedulerDto = new InvoiceSchedulerDto();
        $schedulerDto
            ->setName('')
            ->setUnit('week')
            ->setFrequency(1)
            ->setEmail('')
            ->setNextExecution($nextExecution)
            ->setCompanyId(2)
            ->setBrandId(1);

        /** @var InvoiceScheduler $invoiceScheduler */
        $invoiceScheduler = $this->entityTools
            ->persistDto($schedulerDto, null, true);

        $this->resetChangelog();

        return $invoiceScheduler;
    }
}
