<?php

namespace Tests\Provider\CallCsvReport;

use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvScheduler;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerDto;
use Ivoz\Provider\Domain\Service\CallCsvReport\CreateByScheduler;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReport;

class CreateBySchedulerServiceTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function it_creates_callCsvReports()
    {
        $callCsvScheduler = $this->createScheduler('2018-12-10 08:00:00');

        $service = $this
            ->serviceContainer
            ->get(
                CreateByScheduler::class
            );

        $service
            ->execute($callCsvScheduler);

        $this->date_ranges_are_lower_than_next_execution_day($callCsvScheduler);
        $this->next_execution_is_properly_updated($callCsvScheduler);
    }

    protected function date_ranges_are_lower_than_next_execution_day($callCsvScheduler)
    {
        $changelogEntries = $this->getChangelogByClass(
            CallCsvReport::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $diff = $changelog->getData();
        $this->assertSubset(
            [
                'inDate' => '2018-12-08 23:00:00',
                'outDate' => '2018-12-09 22:59:59'
            ],
            $diff
        );
    }


    protected function next_execution_is_properly_updated($callCsvScheduler)
    {
        $changelogEntries = $this->getChangelogByClass(
            CallCsvScheduler::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $diff = $changelog->getData();
        $this->assertSubset(
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
