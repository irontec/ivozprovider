<?php

namespace spec\Ivoz\Provider\Domain\Service\CallAclRelMatchList;

use Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface;
use Ivoz\Provider\Domain\Service\CallAclRelMatchList\AvoidUpdates;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class AvoidUpdatesSpec extends ObjectBehavior
{
    use HelperTrait;

    function it_is_initializable()
    {
        $this->shouldHaveType(AvoidUpdates::class);
    }

    function it_throws_exception_on_update(
        CallAclRelMatchListInterface $entity
    ) {
        $entity
            ->getId()
            ->willReturn(1);

        $entity
            ->getChangedFields()
            ->willReturn([
                'anyField'
            ]);

        $this
            ->shouldThrow('\Exception')
            ->during('execute', [$entity]);
    }

    function it_does_not_throw_exception_on_create(
        CallAclRelMatchListInterface $entity
    ) {
        $entity
            ->getId()
            ->willReturn(null)
            ->shouldBeCalled();

        $entity
            ->getChangedFields()
            ->willReturn([
                'anyField'
            ]);

        $this->execute($entity);
    }

    function it_does_not_throw_exception_on_ignored_field_update(
        CallAclRelMatchListInterface $entity
    ) {
        $entity
            ->getId()
            ->willReturn(1);

        $entity
            ->getChangedFields()
            ->willReturn([
                'priority',
                'policy'
            ])
            ->shouldBeCalled();

        $this->execute($entity);
    }
}
