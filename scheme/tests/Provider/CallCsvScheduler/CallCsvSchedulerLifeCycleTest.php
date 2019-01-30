<?php

namespace Tests\Provider\CallCsvScheduler;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvScheduler;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerDto;

class CallCsvSchedulerLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return CallCsvSchedulerDto
     */
    protected function createDto()
    {
        $callCsvSchedulerDto = new CallCsvSchedulerDto();
        $callCsvSchedulerDto
            ->setName('testReport')
            ->setUnit('week')
            ->setFrequency(1)
            ->setEmail('mikel+test-report@irontec.com')
            ->setCompanyId(1);

        return $callCsvSchedulerDto;
    }

    /**
     * @return CallCsvScheduler
     */
    protected function addCallCsvScheduler()
    {
        $callCsvSchedulerDto =$this->createDto();

        /** @var CallCsvScheduler $callCsvScheduler */
        $callCsvScheduler = $this->entityTools
            ->persistDto($callCsvSchedulerDto, null, true);

        return $callCsvScheduler;
    }

    protected function updateCallCsvScheduler()
    {
        $this->addCallCsvScheduler();
        $this->resetChangelog();

        $callCsvSchedulerRepository = $this->em
            ->getRepository(CallCsvScheduler::class);

        $callCsvScheduler = $callCsvSchedulerRepository->find(1);

        /** @var CallCsvSchedulerDto $callCsvSchedulerDto */
        $callCsvSchedulerDto = $this->entityTools->entityToDto($callCsvScheduler);

        $callCsvSchedulerDto
            ->setName('updatedName');

        return $this
            ->entityTools
            ->persistDto($callCsvSchedulerDto, $callCsvScheduler, true);
    }

    protected function removeCallCsvScheduler()
    {
        $this->addCallCsvScheduler();
        $this->resetChangelog();

        $callCsvSchedulerRepository = $this->em
            ->getRepository(CallCsvScheduler::class);

        $callCsvScheduler = $callCsvSchedulerRepository->find(1);

        $this
            ->entityTools
            ->remove($callCsvScheduler);
    }

    /**
     * @test
     */
    public function it_persists_callCsvSchedulers()
    {
        $callCsvScheduler = $this->em
            ->getRepository(CallCsvScheduler::class);
        $fixtureCallCsvSchedulers = $callCsvScheduler->findAll();
        $this->addCallCsvScheduler();

        $brands = $callCsvScheduler->findAll();
        $this->assertCount(count($fixtureCallCsvSchedulers) + 1, $brands);
    }

    /**
     * @test
     */
    public function it_triggers_lifecycle_services()
    {
        $this->addCallCsvScheduler();
        $this->assetChangedEntities([
            CallCsvScheduler::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateCallCsvScheduler();
        $this->assetChangedEntities([
            CallCsvScheduler::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeCallCsvScheduler();
        $this->assetChangedEntities([
            CallCsvScheduler::class
        ]);
    }

    //////////////////////////////////////////
    //
    //////////////////////////////////////////

    /**
     * @test
     * @deprecated
     */
    public function added_callCsvScheduler_has_next_execution()
    {
        $this->addCallCsvScheduler();

        /** @var Changelog[] $changelogEntries */
        $changelogEntries = $this->getChangelogByClass(
            CallCsvScheduler::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $diff = $changelog->getData();
        $this->assertArraySubset(
            [
                'name' => 'testReport',
                'unit' => 'week',
                'frequency' => 1,
                'email' => 'mikel+test-report@irontec.com',
                'companyId' => 1,
                'id' => 2
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
                'companyId',
                'id'
            ]
        );

        $this->assertNotEmpty($diff['nextExecution']);
    }

    /**
     * @test
     * @expectedException \DomainException
     */
    public function duplicated_company_and_name_throws_exception()
    {
        $dto = $this->createDto();
        $scheduler2  = $this->entityTools->persistDto($dto, null, true);

        $dto2 = $this->createDto();
        $scheduler2  = $this->entityTools->persistDto($dto2, null, true);
    }

    /**
     * @test
     * @expectedException \Doctrine\DBAL\Exception\UniqueConstraintViolationException
     */
    public function duplicated_brand_and_name_throws_exception()
    {
        $dto = $this->createDto();
        $dto->setBrandId(1);
        $scheduler2  = $this->entityTools->persistDto($dto, null, true);

        $dto2 = $this->createDto();
        $dto2->setBrandId(1);
        $scheduler2  = $this->entityTools->persistDto($dto2, null, true);
    }
}
