<?php

namespace spec\Ivoz\Provider\Domain\Service\HuntGroupsRelUser;

use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface;
use Ivoz\Provider\Domain\Service\HuntGroupsRelUser\AvoidUpdates;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AvoidUpdatesSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AvoidUpdates::class);
    }

    function it_throws_exception_on_fk_update(
        HuntGroupsRelUserInterface $entity
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

        $message = 'Update operation is not allowed on HuntGroupsRelUser';
        $exception = new \DomainException($message, 403);

        $this
            ->shouldThrow($exception)
            ->during('execute', [$entity]);
    }

    function it_does_not_throw_exception_on_attribute_update(
        HuntGroupsRelUserInterface $entity
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
