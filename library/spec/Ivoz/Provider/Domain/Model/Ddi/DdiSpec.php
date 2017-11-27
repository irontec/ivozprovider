<?php

namespace spec\Ivoz\Provider\Domain\Model\Ddi;

use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DdiSpec extends ObjectBehavior
{
    function let() {
        $this->beConstructedWith(
            '123',
            'none',
            0
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Ddi::class);
    }

    function it_throws_exception_on_invalid_ddi()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setDdi', ['$123']);

        $this
            ->shouldThrow('\Exception')
            ->during('setDdi', ['94 600 20 55']);
    }

    function it_accepts_valid_ddis()
    {
        $this
            ->shouldNotThrow('Exception')
            ->during('setDdi', ['946002055']);

        $this
            ->shouldNotThrow('Exception')
            ->during('setDdi', ['112']);

        $this
            ->shouldNotThrow('Exception')
            ->during('setDdi', ['999']);
    }
}
