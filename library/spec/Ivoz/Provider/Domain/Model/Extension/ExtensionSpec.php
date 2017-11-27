<?php

namespace spec\Ivoz\Provider\Domain\Model\Extension;

use Ivoz\Provider\Domain\Model\Extension\Extension;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ExtensionSpec extends ObjectBehavior
{
    function let() {
        $this->beConstructedWith(
            '123'
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Extension::class);
    }

    function it_throws_exception_on_invalid_number_values()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setNumber', ['*123']);
    }

    function it_accepts_numeric_number_values()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setNumber', ['1$']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setNumber', ['123*']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setNumber', ['123456789']);
    }
}
