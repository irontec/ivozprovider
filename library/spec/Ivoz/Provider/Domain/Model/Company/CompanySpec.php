<?php

namespace spec\Ivoz\Provider\Domain\Model\Company;

use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Country\Country;
use Ivoz\Provider\Domain\Model\Country\CountryDto;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Language\Language;
use Ivoz\Provider\Domain\Model\Language\LanguageDto;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Provider\Domain\Model\Timezone\Timezone;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneDto;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;
use spec\DtoToEntityFakeTransformer;

class CompanySpec extends ObjectBehavior
{
    use HelperTrait;

    protected $dto;
    protected $brand;
    protected $timezone;
    protected $language;
    protected $country;

    /**
     * @var DtoToEntityFakeTransformer
     */
    private $transformer;

    function let()
    {
        $this->language = $this->getInstance(Language::class);
        $this->timezone = $this->getInstance(Timezone::class);

        $brandDto = new BrandDto();
        $this->brand = $this->getterProphecy(
            $this->getTestDouble(Brand::class),
            [
                'getId' => 1,
                'getDefaultTimezone' => $this->timezone,
                'getLanguage' => $this->language,
            ]
        );

        $countryDto = new CountryDto();
        $this->country = $this->getInstance(Country::class);

        $this->dto = $dto = new CompanyDto();
        $dto
            ->setType('vpbx')
            ->setName('')
            ->setNif('')
            ->setDistributeMethod('static')
            ->setMaxCalls(0)
            ->setPostalAddress('')
            ->setPostalCode('')
            ->setTown('')
            ->setProvince('')
            ->setCountryName('')
            ->setCountryId(1)
            ->setDomainUsers('something')
            ->setBrand($brandDto)
            ->setCountry($countryDto);

        $this->transformer = new DtoToEntityFakeTransformer([
            [$brandDto, $this->brand->reveal()],
            [$countryDto, $this->country],
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Company::class);
    }

    function it_throws_exception_on_non_numeric_record_code()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setOnDemandRecordCode', ['abcd']);

        $this
            ->shouldThrow('\Exception')
            ->during('setOnDemandRecordCode', ['123a']);
    }

    function it_accepts_numeric_record_code()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setOnDemandRecordCode', ['123']);
    }

    function it_turns_empty_ipFilter_into_false()
    {
        $dto = clone $this->dto;
        $dto->setIpFilter(null);

        $this->updateFromDto(
            $dto,
            $this->transformer
        );

        $this
            ->getIpFilter()
            ->shouldBe(false);
    }

    function it_turns_empty_onDemandRecord_into_zero()
    {
        $dto = clone $this->dto;
        $dto->setOnDemandRecord(null);


        $this->updateFromDto(
            $dto,
            $this->transformer
        );

        $this
            ->getOnDemandRecord()
            ->shouldBe(0);
    }

    function it_turns_empty_onDemandRecordCode_into_empty_string()
    {
        $dto = clone $this->dto;
        $dto->setOnDemandRecordCode(null);


        $this->updateFromDto(
            $dto,
            $this->transformer
        );

        $this
            ->getOnDemandRecordCode()
            ->shouldBe('');
    }

    function it_sets_brand_default_timezone_when_empty()
    {
        $dto = clone $this->dto;
        $this->hydrate(
            $dto,
            ['language' => null]
        );

        $this->updateFromDto(
            $dto,
            $this->transformer
        );

        $this
            ->getDefaultTimezone()
            ->shouldBe($this->timezone);
    }

    function it_sets_brand_language_when_empty()
    {
        $dto = clone $this->dto;
        $this->hydrate(
            $dto,
            ['language' => null]
        );

        $this->updateFromDto(
            $dto,
            $this->transformer
        );

        $this
            ->getLanguage()
            ->shouldBe($this->language);
    }
}
