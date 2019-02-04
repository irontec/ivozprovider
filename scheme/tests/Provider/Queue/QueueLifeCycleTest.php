<?php

namespace Tests\Provider\Queue;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Queue\Queue;
use Ivoz\Ast\Domain\Model\Queue\Queue as AstQueue;
use Ivoz\Provider\Domain\Model\Queue\QueueDto;

class QueueLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return QueueDto
     */
    protected function createDto()
    {
        $queueDto = new QueueDto();
        $queueDto
            ->setName("aQueue")
            ->setMaxWaitTime(20)
            ->setTimeoutTargetType("number")
            ->setTimeoutNumberValue("946002020")
            ->setMaxlen(5)
            ->setFullTargetType("number")
            ->setFullNumberValue("946002021")
            ->setPeriodicAnnounceFrequency(7)
            ->setMemberCallRest(0)
            ->setMemberCallTimeout(1)
            ->setStrategy("rrmemory")
            ->setWeight(5)
            ->setCompanyId(1)
            ->setPeriodicAnnounceLocutionId(1)
            ->setTimeoutLocutionId(1)
            ->setFullLocutionId(1)
            ->setTimeoutNumberCountryId(1)
            ->setFullNumberCountryId(1);

        return $queueDto;
    }

    /**
     * @return Queue
     */
    protected function addQueue()
    {
        $queueDto = $this->createDto();

        /** @var Queue $queue */
        $queue = $this->entityTools
            ->persistDto($queueDto, null, true);

        return $queue;
    }

    protected function updateQueue()
    {
        $queueRepository = $this->em
            ->getRepository(Queue::class);

        $queue = $queueRepository->find(1);

        /** @var QueueDto $queueDto */
        $queueDto = $this->entityTools->entityToDto($queue);

        $queueDto
            ->setName("UpdatedName");

        return $this
            ->entityTools
            ->persistDto($queueDto, $queue, true);
    }

    protected function removeQueue()
    {
        $queueRepository = $this->em
            ->getRepository(Queue::class);

        $queue = $queueRepository->find(1);

        $this
            ->entityTools
            ->remove($queue);
    }

    /**
     * @test
     */
    public function it_persists_queues()
    {
        $queue = $this->em
            ->getRepository(Queue::class);
        $fixtureQueues = $queue->findAll();
        $this->assertCount(1, $fixtureQueues);

        $this->addQueue();

        $brands = $queue->findAll();
        $this->assertCount(2, $brands);
    }

    /**
     * @test
     */
    public function it_triggers_lifecycle_services()
    {
        $this->addQueue();
        $this->assetChangedEntities([
            Queue::class,
            AstQueue::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateQueue();
        $this->assetChangedEntities([
            Queue::class,
            AstQueue::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeQueue();
        $this->assetChangedEntities([
            Queue::class,
        ]);
    }

    /////////////////////////////////////
    ///
    /////////////////////////////////////

    /**
     * @test
     * @deprecated
     */
    public function it_updates_ps_endpoint()
    {
        $this->addQueue();

        /** @var Changelog[] $changelogEntries */
        $changelogEntries = $this->getChangelogByClass(
            AstQueue::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $this->assertEquals(
            $changelog->getData(),
            [
                'name' => 'b1c1q2_aQueue',
                'periodic_announce' => '/opt/irontec/ivozprovider/storage/ivozprovider_model_locutions.encodedfile/0/1',
                'periodic_announce_frequency' => 7,
                'timeout' => 1,
                'autopause' => 'no',
                'ringinuse' => 'no',
                'maxlen' => 5,
                'strategy' => 'rrmemory',
                'weight' => 5,
                'queueId' => 2,
                'id' => 2
            ]
        );
    }
}
