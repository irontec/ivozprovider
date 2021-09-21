<?php

namespace spec\Ivoz\Provider\Domain\Model\Company;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class CompanySpec extends ObjectBehavior
{
    use HelperTrait;

    protected $dto;
    protected $brand;
    protected $timezone;
    protected $language;
    protected $country;

    function let(
        BrandInterface $brand,
        TimezoneInterface $timezone,
        LanguageInterface $language,
        CountryInterface $country
    ) {
        $this->dto = $dto = new CompanyDto();
        $this->brand = $brand;
        $this->timezone = $timezone;
        $this->language = $language;
        $this->country = $country;

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
            ->setDomainUsers('something');

        $this->hydrate(
            $dto,
            [
                'brand' => $brand->getWrappedObject(),
                'country' => $country->getWrappedObject(),
            ]
        );

        $this->getterProphecy(
            $brand,
            [
                'getId' => 1,
                'getDefaultTimezone' => $timezone,
                'getLanguage' => $language,
            ],
            true
        );

        $this->getterProphecy(
            $brand,
            [
                'getDomain' => null,
            ],
            false
        );

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
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
            new \spec\DtoToEntityFakeTransformer()
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
            new \spec\DtoToEntityFakeTransformer()
        );

        $this
            ->getOnDemandRecord()
            ->shouldBe(0);
    }

    function it_requires_validates_company_type_in_order_to_set_onDemandRecord()
    {
        $allowed = [
            CompanyInterface::TYPE_VPBX,
            CompanyInterface::TYPE_RESIDENTIAL
        ];

        $unallowed = [
            CompanyInterface::TYPE_WHOLESALE,
            CompanyInterface::TYPE_RETAIL
        ];

        $dtoToEntityFakeTransformer = new \spec\DtoToEntityFakeTransformer();

        foreach ($unallowed as $type) {

            /** @var CompanyDto $vpbxDto */
            $dto = clone $this->dto;
            $dto
                ->setType($type)
                ->setOnDemandRecord(1);

            $this
                ->shouldThrow('\DomainException')
                ->during(
                    'updateFromDto',
                    [
                        $dto,
                        $dtoToEntityFakeTransformer
                    ]
                );
        }

        foreach ($allowed as $type) {

            /** @var CompanyDto $vpbxDto */
            $dto = clone $this->dto;
            $dto
                ->setType($type)
                ->setOnDemandRecord(1);

            $this
                ->shouldNotThrow('\DomainException')
                ->during(
                    'updateFromDto',
                    [
                        $dto,
                        $dtoToEntityFakeTransformer
                    ]
                );
        }
    }

    function it_turns_empty_onDemandRecordCode_into_empty_string()
    {
        $dto = clone $this->dto;
        $dto->setOnDemandRecordCode(null);


        $this->updateFromDto(
            $dto,
            new \spec\DtoToEntityFakeTransformer()
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
            new \spec\DtoToEntityFakeTransformer()
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
            new \spec\DtoToEntityFakeTransformer()
        );

        $this
            ->getLanguage()
            ->shouldBe($this->language);
    }
}
