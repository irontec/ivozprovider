<?php

namespace spec\Ivoz\Provider\Domain\Model\LcrRule;

use Ivoz\Provider\Domain\Model\LcrRule\LcrRule;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LcrRuleSpec extends ObjectBehavior
{
    function let() {
        $this->beConstructedWith(
            1,
            1,
            1,
            'tag',
            'description'
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(LcrRule::class);
    }

    function it_throws_exception_on_non_numeric_requesturi()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setRequestUri', ['abc']);

        $this
            ->shouldThrow('\Exception')
            ->during('setRequestUri', ['12a']);

        $this
            ->shouldThrow('\Exception')
            ->during('setRequestUri', [':@']);
    }

    function it_accepts_numeric_requesturi()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setRequestUri', [null]);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setRequestUri', [':something@']);
    }

    function it_throws_exception_on_non_numeric_tag()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setTag', ['$something']);

        $this
            ->shouldThrow('\Exception')
            ->during('setTag', ['some reason']);
    }

    function it_accepts_numeric_tag()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setTag', ['something']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setTag', ['someReason']);
    }
}
