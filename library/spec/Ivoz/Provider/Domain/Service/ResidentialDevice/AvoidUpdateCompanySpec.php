<?php

namespace spec\Ivoz\Provider\Domain\Service\ResidentialDevice;

use Assert\InvalidArgumentException;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Service\ResidentialDevice\AvoidUpdateCompany;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AvoidUpdateCompanySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AvoidUpdateCompany::class);
    }

    function its_does_nothing_on_new_entities(
        ResidentialDeviceInterface $entity
    ) {
        $entity
            ->isNew()
            ->willReturn(true)
            ->shouldBeCalled();

        $this->execute($entity);
    }

    function its_does_now_allow_updated(
        ResidentialDeviceInterface $entity
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
