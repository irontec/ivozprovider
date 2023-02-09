<?php

namespace spec\Ivoz\Provider\Domain\Service\HuntGroupMember;

use Ivoz\Provider\Domain\Model\HuntGroupMember\HuntGroupMemberInterface;
use Ivoz\Provider\Domain\Service\HuntGroupMember\AvoidUpdates;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AvoidUpdatesSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AvoidUpdates::class);
    }

    function it_throws_exception_on_fk_update(
        HuntGroupMemberInterface $entity
    ) {
        $entity
            ->getId()
            ->shouldBeCalled()
            ->willReturn(1);

        $entity
            ->getChangedFields()
            ->shouldBeCalled()
            ->willReturn([
                'timeoutTime',
                'priority',
                'huntGroupId',
                'userId',
            ]);

        $message = 'Update operation is not allowed on HuntGroupMember';
        $exception = new \DomainException($message, 403);

        $this
            ->shouldThrow($exception)
            ->during('execute', [$entity]);
    }

    function it_does_not_throw_exception_on_attribute_update(
        HuntGroupMemberInterface $entity
    ) {
        $entity
            ->getId()
            ->shouldBeCalled()
            ->willReturn(1);

        $entity
            ->getChangedFields()
            ->shouldBeCalled()
            ->willReturn([
                'timeoutTime',
                'priority',
            ]);

        $this->execute($entity);
    }
}
