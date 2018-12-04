<?php

namespace spec\Ivoz\Provider\Domain\Model\TransformationRuleSet;

use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSet;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\Name;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TransformationRuleSetSpec extends ObjectBehavior
{
    function let()
    {
        $dto = new TransformationRuleSetDto();
        $dto
            ->setNameEn('en')
            ->setNameEs('es');

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TransformationRuleSet::class);
    }

    function it_throws_exception_on_invalid_internationalCode()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setInternationalCode', [1]);

        $this
            ->shouldThrow('\Exception')
            ->during('setInternationalCode', ['1abc']);

        $this
            ->shouldThrow('\Exception')
            ->during('setInternationalCode', ['012345678901']);

        $this
            ->shouldThrow('\Exception')
            ->during('setInternationalCode', ['+34']);
    }

    function it_accepts_valid_internationalCode()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setInternationalCode', ['34']);
    }

    function it_throws_exception_on_invalid_trunkPrefix()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setTrunkPrefix', ['a']);

        $this
            ->shouldThrow('\Exception')
            ->during('setTrunkPrefix', ['+34']);
    }

    function it_accepts_valid_trunkPrefix()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setTrunkPrefix', ['34']);
    }
}
