<?php

namespace spec\Ivoz\Provider\Domain\Service\ConditionalRoutesConditionsRelMatchlist;

use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface;
use Ivoz\Provider\Domain\Service\ConditionalRoutesConditionsRelMatchlist\AvoidUpdates;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AvoidUpdatesSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AvoidUpdates::class);
    }

    function its_does_nothing_on_new_entities(
        ConditionalRoutesConditionsRelMatchlistInterface $entity
    ) {
        $entity
            ->getId()
            ->willReturn(null)
            ->shouldBeCalled();

        $this->execute($entity);
    }

    function its_does_now_allow_updated(
        ConditionalRoutesConditionsRelMatchlistInterface $entity
    ) {
        $entity
            ->getId()
            ->willReturn(1)
            ->shouldBeCalled();

        $entity
            ->getChangedFields()
            ->willReturn(['companyId'])
            ->shouldBeCalled();

        $this
            ->shouldThrow(\DomainException::class)
            ->during('execute', [$entity]);
    }
}
