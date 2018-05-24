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
}
