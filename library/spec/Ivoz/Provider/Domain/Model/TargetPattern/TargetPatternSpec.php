<?php

namespace spec\Ivoz\Provider\Domain\Model\TargetPattern;

use Ivoz\Provider\Domain\Model\TargetPattern\TargetPattern;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ivoz\Provider\Domain\Model\TargetPattern\Name;
use Ivoz\Provider\Domain\Model\TargetPattern\Description;

class TargetPatternSpec extends ObjectBehavior
{
    function let() {
        $this->beConstructedWith(
            '0-9',
            new Name('en', 'es'),
            new Description('en', 'es')
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TargetPattern::class);
    }
}
