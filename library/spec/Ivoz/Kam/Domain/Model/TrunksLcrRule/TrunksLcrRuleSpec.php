<?php

namespace spec\Ivoz\Kam\Domain\Model\TrunksLcrRule;

use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRule;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleDto;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\DtoToEntityFakeTransformer;

class TrunksLcrRuleSpec extends ObjectBehavior
{
    /**
     * @var DtoToEntityFakeTransformer
     */
    private $transformer;

    function let()
    {
        $dto = new TrunksLcrRuleDto();
        $dto->setLcrId(1)
            ->setStopper(1)
            ->setEnabled(1);

        $this->transformer = new DtoToEntityFakeTransformer([]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TrunksLcrRule::class);
    }
}
