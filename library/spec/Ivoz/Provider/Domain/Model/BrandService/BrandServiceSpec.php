<?php

namespace spec\Ivoz\Provider\Domain\Model\BrandService;

use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\BrandService\BrandService;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceDto;
use Ivoz\Provider\Domain\Model\Service\Service;
use Ivoz\Provider\Domain\Model\Service\ServiceDto;
use Ivoz\Provider\Domain\Model\Service\ServiceInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;
use spec\DtoToEntityFakeTransformer;

class BrandServiceSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $dto;

    /**
     * @var DtoToEntityFakeTransformer
     */
    private $transformer;

    function let()
    {
        $serviceDto = new ServiceDto();
        $service = $this->getInstance(Service::class);

        $brandDto = new BrandDto();
        $brand = $this->getInstance(Brand::class);

        $this->dto = $dto = new BrandServiceDto();
        $dto
            ->setCode('123')
            ->setBrand($brandDto)
            ->setService($serviceDto);

        $this->transformer = new DtoToEntityFakeTransformer([
            [$brandDto, $brand],
            [$serviceDto, $service],
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(BrandService::class);
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
