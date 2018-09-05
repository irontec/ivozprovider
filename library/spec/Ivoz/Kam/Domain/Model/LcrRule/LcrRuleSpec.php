<?php

namespace spec\Ivoz\Kam\Domain\Model\TrunksLcrRule;

use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRule;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleDto;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TrunksLcrRuleSpec extends ObjectBehavior
{
    function let()
    {

        $dto = new TrunksLcrRuleDto();
        $dto->setLcrId(1)
            ->setStopper(1)
            ->setEnabled(1);

        $this->beConstructedThrough(
            'fromDto',
            [$dto]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TrunksLcrRule::class);
    }
}
