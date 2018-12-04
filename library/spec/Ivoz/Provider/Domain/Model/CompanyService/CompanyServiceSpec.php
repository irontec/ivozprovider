<?php

namespace spec\Ivoz\Provider\Domain\Model\CompanyService;

use Ivoz\Provider\Domain\Model\CompanyService\CompanyService;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceDto;
use Ivoz\Provider\Domain\Model\Service\ServiceInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class CompanyServiceSpec extends ObjectBehavior
{
    use HelperTrait;
    protected $dto;

    function let(
        ServiceInterface $service
    ) {
        $this->dto = $dto = new CompanyServiceDto();
        $dto->setCode('123');

        $this->hydrate(
            $dto,
            [
                'service' => $service->getWrappedObject()
            ]
        );

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CompanyService::class);
    }

    function it_throws_exception_on_invalid_code_formats()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setCode', ['$123']);

        $this
            ->shouldThrow('\Exception')
            ->during('setCode', ['1234']);
    }

    function it_accepts_valid_code_formats()
    {
        $this
            ->shouldNotThrow('Exception')
            ->during('setCode', ['123']);

        $this
            ->shouldNotThrow('Exception')
            ->during('setCode', ['#12']);

        $this
            ->shouldNotThrow('Exception')
            ->during('setCode', ['12*']);

        $this
            ->shouldNotThrow('Exception')
            ->during('setCode', ['1*3']);
    }
}
