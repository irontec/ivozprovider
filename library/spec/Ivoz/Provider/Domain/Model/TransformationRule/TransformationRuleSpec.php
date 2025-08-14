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

    function it_validates_capture_groups_in_replace_expression()
    {
        $this->setMatchExpr('([0-9]+)');
        $this->setReplaceExpr('prefix\\1suffix');

        $this
            ->shouldNotThrow('\Exception')
            ->during('updateFromDto', [$this->toDto(), new \spec\DtoToEntityFakeTransformer()]);

        $this->setReplaceExpr('prefix\\2suffix');

        $this
            ->shouldThrow('\InvalidArgumentException')
            ->during('updateFromDto', [$this->toDto(), new \spec\DtoToEntityFakeTransformer()]);
    }

    function it_validates_multiple_capture_groups()
    {
        $this->setMatchExpr('([0-9]+)-([a-z]+)');
        $this->setReplaceExpr('\\1_\\2');

        $this
            ->shouldNotThrow('\Exception')
            ->during('updateFromDto', [$this->toDto(), new \spec\DtoToEntityFakeTransformer()]);

        $this->setReplaceExpr('\\2-\\1');

        $this
            ->shouldNotThrow('\Exception')
            ->during('updateFromDto', [$this->toDto(), new \spec\DtoToEntityFakeTransformer()]);

        $this->setReplaceExpr('\\3');

        $this
            ->shouldThrow('\InvalidArgumentException')
            ->during('updateFromDto', [$this->toDto(), new \spec\DtoToEntityFakeTransformer()]);
    }

    function it_accepts_replace_expression_without_backreferences()
    {
        $this->setMatchExpr('([0-9]+)');
        $this->setReplaceExpr('fixed_string');

        $this
            ->shouldNotThrow('\Exception')
            ->during('updateFromDto', [$this->toDto(), new \spec\DtoToEntityFakeTransformer()]);

        $this->setReplaceExpr('123456');

        $this
            ->shouldNotThrow('\Exception')
            ->during('updateFromDto', [$this->toDto(), new \spec\DtoToEntityFakeTransformer()]);
    }
}
