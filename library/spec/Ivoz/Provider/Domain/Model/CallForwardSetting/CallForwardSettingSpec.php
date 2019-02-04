<?php

namespace spec\Ivoz\Provider\Domain\Model\CallForwardSetting;

use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSetting;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingDto;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CallForwardSettingSpec extends ObjectBehavior
{
    protected $dto;

    function let()
    {
        $this->dto = $dto = new CallForwardSettingDto();

        $dto->setCallTypeFilter('internal')
             ->setCallForwardType('inconditional')
             ->setTargetType('extension')
             ->setNoAnswerTimeout(10);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CallForwardSetting::class);
    }

    function it_throws_exception_on_non_numeric_number_values()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setNumberValue', ['abcd']);

        $this
            ->shouldThrow('\Exception')
            ->during('setNumberValue', ['123a']);
    }

    function it_accepts_numeric_number_values()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setNumberValue', ['123456']);
        $this
            ->shouldNotThrow('\Exception')
            ->during('setNumberValue', ['0123456']);
    }
}
