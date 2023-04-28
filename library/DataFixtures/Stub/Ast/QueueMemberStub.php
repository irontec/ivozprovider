<?php

namespace DataFixtures\Stub\Ast;

use DataFixtures\Stub\StubTrait;
use Ivoz\Ast\Domain\Model\QueueMember\QueueMember;
use Ivoz\Ast\Domain\Model\QueueMember\QueueMemberDto;

class QueueMemberStub
{
    use StubTrait;

    protected function getEntityName(): string
    {
        return QueueMember::class;
    }

    protected function load()
    {
        $dto = (new QueueMemberDto(1))
            ->setUniqueid("b1c1q1_1682588679")
            ->setQueueName('b1c1q1_testQueue')
            ->setInterface("Local/101@queues")
            ->setMembername("Alice Allison")
            ->setStateInterface("PJSIP/b1c1t1_alice")
            ->setPenalty(1)
            ->setPaused(0)
            ->setQueueMemberId(1);
        $this->append($dto);
    }
}
