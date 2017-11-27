<?php

namespace spec\Ivoz\Kam\Domain\Model\TrunksUacreg;

use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacreg;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TrunksUacregSpec extends ObjectBehavior
{
    function let() {
        $this->beConstructedWith(
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            'sips:127.0.0.1',
            1,
            1,
            1,
            0
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TrunksUacreg::class);
    }

    function it_throws_exception_on_invalid_authproxy()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setAuthProxy', ['127.0.0.1']);

        $this
            ->shouldThrow('\Exception')
            ->during('setAuthProxy', ['google.es']);

        $this
            ->shouldThrow('\Exception')
            ->during('setAuthProxy', ['sip:']);
    }

    function it_accepts_valid_authproxy()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setAuthProxy', ['sip:8.8.8.8']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setAuthProxy', ['sips:8.8.8.8']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setAuthProxy', ['sips:google.es']);
    }
}
