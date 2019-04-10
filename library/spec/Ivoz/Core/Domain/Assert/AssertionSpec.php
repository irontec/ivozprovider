<?php

namespace spec\Ivoz\Core\Domain\Assert;

use Ivoz\Core\Domain\Assert\Assertion;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AssertionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Assertion::class);
    }

    function it_returns_true_on_valid_regular_expressions()
    {
        $this
            ::regexFormat('[A-Z]+')
            ->shouldReturn(true);
    }

    function it_throws_Exception_on_invalid_regular_expressions()
    {
        $this
            ->shouldThrow('\Exception')
            ->duringRegexFormat('[A-Z+');
    }
}
