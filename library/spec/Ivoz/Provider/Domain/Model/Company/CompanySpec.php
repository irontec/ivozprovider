<?php

namespace spec\Ivoz\Provider\Domain\Model\Company;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDTO;
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

    function let(
        BrandInterface $brand,
        TimezoneInterface $timezone,
        LanguageInterface $language
    ) {
        $this->dto = $dto = new CompanyDTO();
        $this->brand = $brand;
        $this->timezone = $timezone;
        $this->language = $language;

        $dto->setType('vpbx')
            ->setName('')
            ->setNif('')
            ->setDistributeMethod('static')
            ->setExternalMaxCalls(0)
            ->setPostalAddress('')
            ->setPostalCode('')
            ->setTown('')
            ->setProvince('')
            ->setCountryName('')
            ->setDomainUsers('something');

        $this->hydrate(
            $dto,
            [
                'brand' => $brand->getWrappedObject()
            ]
        );

        $brand
            ->getId()
            ->willReturn(1);

        $brand
            ->getDefaultTimezone()
            ->willReturn($timezone);

        $brand
            ->getLanguage()
            ->willReturn($language);

        $this->beConstructedThrough(
            'fromDTO',
            [$dto]
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

    function it_turns_empty_ipFilter_into_zero()
    {
        $dto = clone $this->dto;
        $dto->setIpFilter(null);

        $this->updateFromDTO($dto);

        $this
            ->getIpFilter()
            ->shouldBe(0);
    }

    function it_turns_empty_onDemandRecord_into_zero()
    {
        $dto = clone $this->dto;
        $dto->setOnDemandRecord(null);

        $this->updateFromDTO($dto);

        $this
            ->getOnDemandRecord()
            ->shouldBe(0);
    }

    function it_turns_empty_onDemandRecordCode_into_empty_string()
    {
        $dto = clone $this->dto;
        $dto->setOnDemandRecordCode(null);

        $this->updateFromDTO($dto);

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
        $this->updateFromDTO($dto);

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
        $this->updateFromDTO($dto);

        $this
            ->getLanguage()
            ->shouldBe($this->language);
    }
}
