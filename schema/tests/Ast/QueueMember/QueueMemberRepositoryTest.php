<?php

namespace Tests\Ast\QueueMember;

use Ivoz\Ast\Domain\Model\QueueMember\QueueMember;
use Ivoz\Ast\Domain\Model\QueueMember\QueueMemberInterface;
use Ivoz\Ast\Domain\Model\QueueMember\QueueMemberRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class QueueMemberRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_finds_one_by_queueMemberId();
    }

    public function its_instantiable()
    {
        /** @var QueueMemberRepository $repository */
        $repository = $this
            ->em
            ->getRepository(QueueMember::class);

        $this->assertInstanceOf(
            QueueMemberRepository::class,
            $repository
        );
    }

    public function it_finds_one_by_queueMemberId()
    {
        /** @var QueueMemberRepository $repository */
        $repository = $this
            ->em
            ->getRepository(QueueMember::class);

        $result = $repository->findOneByProviderQueueMemberId(1);

        $this->assertInstanceOf(
            QueueMemberInterface::class,
            $result
        );
    }
}
