<?php

namespace spec\Ivoz\Provider\Domain\Model\Ddi;

use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Country\Country;
use Ivoz\Provider\Domain\Model\Country\CountryDto;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface;
use PhpSpec\ObjectBehavior;
use spec\HelperTrait;
use spec\DtoToEntityFakeTransformer;

class DdiSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var DdiDto
     */
    protected $dto;

    /**
     * @var DdiProviderInterface
     */
    protected $ddiProvider;

    /**
     * @var DtoToEntityFakeTransformer
     */
    private $transformer;

    function let()
    {
        $countryDto = new CountryDto();
        $country = $this->getterProphecy(
            $this->getTestDouble(Country::class),
            [
                'getId' => 1,
                'getCountryCode' => '34',
            ]
        );

        $brandDto = new BrandDto();
        $brand = $this->getInstance(
            Brand::class
        );

        $companyDto = new CompanyDto();
        $company = $this->getInstance(
            Company::class,
            ['brand' => $brand]
        );

        $ddiProviderDto = new DdiProviderDto();
        $this->ddiProvider = $this->getTestDouble(DdiProvider::class);

        $this->dto = $dto = new DdiDto();
        $dto
            ->setDdi('123')
            ->setRecordCalls('none')
            ->setCountry($countryDto)
            ->setDdiProvider($ddiProviderDto)
            ->setBrand($brandDto)
            ->setCompany($companyDto);

        $this->transformer = new DtoToEntityFakeTransformer([
            [$countryDto, $country->reveal()],
            [$ddiProviderDto, $this->ddiProvider->reveal()],
            [$brandDto, $brand],
            [$companyDto, $company],
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Ddi::class);
    }

    function it_throws_exception_on_invalid_ddi()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setDdi', ['$123']);

        $this
            ->shouldThrow('\Exception')
            ->during('setDdi', ['94 600 20 55']);
    }

    function it_accepts_valid_ddis()
    {
        $this
            ->shouldNotThrow('Exception')
            ->during('setDdi', ['946002055']);

        $this
            ->shouldNotThrow('Exception')
            ->during('setDdi', ['112']);

        $this
            ->shouldNotThrow('Exception')
            ->during('setDdi', ['999']);
    }

    function it_sets_standarized_number()
    {
        $this
            ->getDdie164()
            ->shouldBe('34123');
    }
}
