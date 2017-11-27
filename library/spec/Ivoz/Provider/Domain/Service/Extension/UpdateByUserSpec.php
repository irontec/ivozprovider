<?php

namespace spec\Ivoz\Provider\Domain\Service\Extension;

use Ivoz\Provider\Domain\Service\Extension\UpdateByUser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdateByUserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByUser::class);
    }
}
