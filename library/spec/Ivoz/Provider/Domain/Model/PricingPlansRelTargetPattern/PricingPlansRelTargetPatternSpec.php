<?php

namespace spec\Ivoz\Provider\Domain\Model\PricingPlansRelTargetPattern;

use Ivoz\Provider\Domain\Model\PricingPlansRelTargetPattern\PricingPlansRelTargetPattern;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PricingPlansRelTargetPatternSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            2.10,
            2,
            3
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(PricingPlansRelTargetPattern::class);
    }

    function it_throws_exception_on_invalid_connectionCharge()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setConnectionCharge', ['a.988']);

        $this
            ->shouldThrow('\Exception')
            ->during('setConnectionCharge', ['123456,3']);

        $this
            ->shouldThrow('\Exception')
            ->during('setConnectionCharge', [1234567.3]);
    }

    function it_accepts_valid_connectionCharge()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setConnectionCharge', [9.11]);
    }

    function it_throws_exception_on_invalid_periodCharge()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setPerPeriodCharge', ['a.988']);

        $this
            ->shouldThrow('\Exception')
            ->during('setPerPeriodCharge', ['123456,3']);

        $this
            ->shouldThrow('\Exception')
            ->during('setPerPeriodCharge', [1234567.3]);
    }

    function it_accepts_valid_periodCharge()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setPerPeriodCharge', [9.11]);
    }
}
