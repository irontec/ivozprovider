<?php

namespace Tests\Provider\Recording;

use Ivoz\Provider\Domain\Model\BillableCall\BillableCall;
use Ivoz\Provider\Domain\Model\UsersCdr\UsersCdr;
use Ivoz\Provider\Domain\Model\Recording\Recording;
use Ivoz\Provider\Domain\Model\Recording\RecordingDto;
use Ivoz\Provider\Domain\Model\Recording\RecordingInterface;
use Ivoz\Provider\Domain\Model\Recording\RecordingRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class RecordingLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    protected function createDto(): RecordingDto
    {
        $recordingDto = new RecordingDto();
        $recordingDto
            ->setUsersCdrId(3)
            ->setBillableCallId(3)
            ->setCompanyId(1);

        return $recordingDto;
    }

    protected function addRecording(): Recording
    {
        $recordingDto = $this->createDto();

        /** @var Recording $recording */
        $recording = $this->entityTools
            ->persistDto($recordingDto, null, true);

        return $recording;
    }

    protected function updateRecording($id = 1)
    {
        $recordingRepository = $this->em
            ->getRepository(Recording::class);

        $recording = $recordingRepository->find($id);

        /** @var RecordingDto $recordingDto */
        $recordingDto = $this->entityTools->entityToDto($recording);

        $recordingDto
            ->setCallee('555993344');

        return $this
            ->entityTools
            ->persistDto($recordingDto, $recording, true);
    }

    protected function removeRecording()
    {
        /** @var RecordingRepository $recordingRepository */
        $recordingRepository = $this->em
            ->getRepository(Recording::class);

        /** @var RecordingInterface $recording */
        $recording = $recordingRepository->find(2);

        $this
            ->entityTools
            ->remove($recording);
    }

    /**
     * @test
     */
    public function it_persists_recording()
    {
        /** @var RecordingRepository $recordingRepository */
        $recordingRepository = $this->em
            ->getRepository(Recording::class);

        $expectedCount = count(
            $recordingRepository->findAll()
        );

        $recording = $this->addRecording();

        $recordings = $recordingRepository->findAll();

        $this->assertCount($expectedCount + 1, $recordings);


        $this->it_triggers_lifecycle_services();
        $this->it_updates_users_cdrs_num_count(1);
        $this->it_updates_billable_call_num_count(1);
    }

    protected function it_triggers_lifecycle_services(): void
    {
        $this->assetChangedEntities([
            UsersCdr::class,
            Recording::class,
            BillableCall::class,
        ]);
    }

    protected function it_updates_users_cdrs_num_count(int $expectedNumCount): void
    {
        $changelogEntries = $this->getChangelogByClass(
            UsersCdr::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $this->assertChangedSubset(
            $changelog,
            [
                "numRecordings" => $expectedNumCount,
            ],
        );
    }

    protected function it_updates_billable_call_num_count(int $expectedNumCount): void
    {
        $changelogEntries = $this->getChangelogByClass(
            BillableCall::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $this->assertChangedSubset(
            $changelog,
            [
                "numRecordings" => $expectedNumCount,
            ],
        );
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateRecording();
        $this->assetChangedEntities([
            Recording::class,
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeRecording();

        $this->assetChangedEntities([
            Recording::class,
            UsersCdr::class,
            BillableCall::class,
        ]);
        $this->it_updates_users_cdrs_num_count(0);
        $this->it_updates_billable_call_num_count(0);
    }
}
