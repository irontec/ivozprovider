<?php

namespace Tests\Provider\Queue;

use Ivoz\Ast\Domain\Model\Queue\QueueInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Ast\Domain\Model\Queue\Queue;
use Ivoz\Ast\Domain\Model\Queue\QueueRepository;

class QueueRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var QueueRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Queue::class);

        $this->assertInstanceOf(
            QueueRepository::class,
            $repository
        );
    }

    /**
     * @test
     */
    public function it_finds_by_queueId()
    {
        /** @var QueueRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Queue::class);

        $result = $repository->findOneByProviderQueueId(1);

        $this->assertInstanceOf(
            QueueInterface::class,
            $result
        );
    }
}