<?php

namespace spec\Ivoz\Provider\Domain\Model\CompanyService;

use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyService;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceDto;
use Ivoz\Provider\Domain\Model\Service\Service;
use Ivoz\Provider\Domain\Model\Service\ServiceDto;
use Ivoz\Provider\Domain\Model\Service\ServiceInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;
use spec\DtoToEntityFakeTransformer;

class CompanyServiceSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $dto;

    /**
     * @var DtoToEntityFakeTransformer
     */
    private $transformer;

    function let(
        ServiceInterface $service,
        CompanyInterface $company
    ) {
        $serviceDto = new ServiceDto();
        $service = $this->getInstance(Service::class);

        $companyDto = new CompanyDto();
        $company = $this->getInstance(Company::class);

        $this->dto = $dto = new CompanyServiceDto();
        $dto
            ->setCode('123')
            ->setService($serviceDto)
            ->setCompany($companyDto);

        $this->transformer = new DtoToEntityFakeTransformer([
            [$serviceDto, $service],
            [$companyDto, $company],
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
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
