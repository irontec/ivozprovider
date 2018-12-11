<?php

namespace Tests\Provider\CallCsvReport;

use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvScheduler;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerDto;
use Ivoz\Provider\Domain\Service\CallCsvReport\CreateByScheduler;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReport;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportDto;

class CreateBySchedulerServiceTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function it_creates_callCsvReports()
    {
        $callCsvSchedulerRepository = $this->em
            ->getRepository(CallCsvScheduler::class);

        $fixtureCallCsvReport = $callCsvSchedulerRepository
            ->find(1);

        $service = $this
            ->serviceContainer
            ->get(
                CreateByScheduler::class
            );

        $service
            ->execute($fixtureCallCsvReport);

        ///////////////////////

        $changelogEntries = $this->getChangelogByClass(
            CallCsvReport::class
        );

        $this->assertCount(1, $changelogEntries);
    }

    /**
     * @test
     */
    public function date_ranges_are_lower_than_next_execution_day()
    {
        $callCsvScheduler = $this->createScheduler('2018-12-10 08:00:00');

        $service = $this
            ->serviceContainer
            ->get(
                CreateByScheduler::class
            );

        $service
            ->execute($callCsvScheduler);

        ///////////////////////

        $changelogEntries = $this->getChangelogByClass(
            CallCsvReport::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $diff = $changelog->getData();
        $this->assertArraySubset(
            [
                'inDate' => '2018-12-08 23:00:00',
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
        $callCsvScheduler = $this->createScheduler('2018-12-10 08:00:00');

        $service = $this
            ->serviceContainer
            ->get(
                CreateByScheduler::class
            );

        $service
            ->execute($callCsvScheduler);

        $changelogEntries = $this->getChangelogByClass(
            CallCsvScheduler::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $diff = $changelog->getData();
        $this->assertArraySubset(
            [
                'nextExecution' => '2018-12-11 08:00:00'
            ],
            $diff
        );
    }


    private function createScheduler($nextExecution): CallCsvScheduler
    {
        $callCsvSchedulerDto = new CallCsvSchedulerDto();
        $callCsvSchedulerDto
            ->setName('')
            ->setUnit('day')
            ->setFrequency(1)
            ->setEmail('')
            ->setNextExecution($nextExecution)
            ->setCompanyId(1);

        /** @var CallCsvScheduler $callCsvScheduler */
        $callCsvScheduler = $this->entityTools
            ->persistDto($callCsvSchedulerDto, null, true);

        $this->resetChangelog();

        return $callCsvScheduler;
    }
}