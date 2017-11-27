<?php

namespace spec\Ivoz\Provider\Domain\Model\Queue;

use Ivoz\Provider\Domain\Model\Queue\Queue;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class QueueSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Queue::class);
    }

    function it_throws_exception_on_invalid_name()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setName', ['Some value']);
    }

    function it_accepts_valid_name()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setName', ['SomeValue']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setName', ['Some-value']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setName', ['Some_value_2']);
    }
}
