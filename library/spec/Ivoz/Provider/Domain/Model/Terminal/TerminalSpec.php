<?php

namespace spec\Ivoz\Provider\Domain\Model\Terminal;

use Ivoz\Provider\Domain\Model\Terminal\Terminal;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TerminalSpec extends ObjectBehavior
{
    function let() {
        $this->beConstructedWith(
            'Disallow',
            'allowAudio',
            'reinvite', // $directMediaMethod
            'HZhN5z*j48' //$password
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Terminal::class);
    }

    function it_throws_exception_on_invalid_name()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setName', ['name with whitespaces']);

        $this
            ->shouldThrow('\Exception')
            ->during('setName', ['name with $simbols']);
    }

    function it_accepts_valid_name()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setName', ['NameWithoutNamespaces1']);
    }

    function it_throws_an_exception_on_invalid_password()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setPassword', ['1234']);
    }

    function it_accepts_format_compliant_password()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setPassword', ['HZhN5z*j48']);
    }
}
