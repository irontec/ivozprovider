<?php

namespace spec\Ivoz\Provider\Domain\Model\LcrRule;

use Ivoz\Provider\Domain\Model\LcrRule\LcrRule;
use Ivoz\Provider\Domain\Model\LcrRule\LcrRuleDto;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LcrRuleSpec extends ObjectBehavior
{
    function let() {

        $dto = new LcrRuleDto();
        $dto->setLcrId(1)
            ->setStopper(1)
            ->setEnabled(1)
            ->setTag('tag')
            ->setDescription('description');

        $this->beConstructedThrough(
            'fromDto',
            [$dto]
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
}
