<?php

namespace spec\Ivoz\Provider\Domain\Model\Service;

use Ivoz\Provider\Domain\Model\Service\Service;
use Ivoz\Provider\Domain\Model\Service\ServiceDto;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ivoz\Provider\Domain\Model\Service\Name;
use Ivoz\Provider\Domain\Model\Service\Description;

class ServiceSpec extends ObjectBehavior
{
    function let()
    {

        $dto = new ServiceDto();
        $dto->setIden('Iden')
            ->setDefaultCode('12')
            ->setExtraArgs(1)
            ->setNameEn('en')
            ->setNameEs('es')
            ->setDescriptionEn('en')
            ->setDescriptionEs('es');

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Service::class);
    }

    function it_throws_exception_on_invalid_defaultcode()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setDefaultCode', ['$123']);

        $this
            ->shouldThrow('\Exception')
            ->during('setDefaultCode', ['1-2']);
    }

    function it_accepts_valid_defaultcode()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setDefaultCode', ['123']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setDefaultCode', ['1#2']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setDefaultCode', ['1*3']);
    }
}
