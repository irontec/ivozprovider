<?php

namespace spec\Ivoz\Provider\Domain\Service\Friend;

use Assert\InvalidArgumentException;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Service\Friend\AvoidUpdateCompany;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AvoidUpdateCompanySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AvoidUpdateCompany::class);
    }

    function its_does_nothing_on_new_entities(
        FriendInterface $entity
    ) {
        $entity
            ->isNew()
            ->willReturn(true)
            ->shouldBeCalled();

        $this->execute($entity);
    }

    function its_does_now_allow_updated(
        FriendInterface $entity
    ) {
        $entity
            ->isNew()
            ->willReturn(false)
            ->shouldBeCalled();

        $entity
            ->hasChanged('companyId')
            ->willReturn(true)
            ->shouldBeCalled();

        $this
            ->shouldThrow(InvalidArgumentException::class)
            ->during('execute', [$entity]);
    }
}
