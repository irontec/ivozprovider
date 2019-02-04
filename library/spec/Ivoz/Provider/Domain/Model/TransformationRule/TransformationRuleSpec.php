<?php

namespace spec\Ivoz\Provider\Domain\Model\TransformationRule;

use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRule;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleDto;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TransformationRuleSpec extends ObjectBehavior
{
    function let()
    {

        $dto = new TransformationRuleDto();
        $dto->setType('callerin')
            ->setDescription('Description');

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TransformationRule::class);
    }

    function it_throws_exception_on_invalid_regexp()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setMatchExpr', ['(+']);

        $this
            ->shouldThrow('\Exception')
            ->during('setMatchExpr', ['[1-3a-z']);

        $this
            ->shouldThrow('\Exception')
            ->during('setMatchExpr', ['[0-9]+)']);
    }

    function it_accepts_valid_regexp()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setMatchExpr', ['^([0-9]+)$']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setMatchExpr', ['([0-9]+)']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setMatchExpr', ['^([0-9+]{1,4})$']);
    }
}
