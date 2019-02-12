<?php

namespace spec\Ivoz\Provider\Domain\Model\Brand;

use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class BrandSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var BrandDto
     */
    protected $dto;

    /**
     * @var DomainInterface
     */
    protected $domain;

    /**
     * @var LanguageInterface
     */
    protected $language;

    /**
     * @var TimezoneInterface
     */
    protected $timezone;

    public function let()
    {
        $this->prepareExecution();

        $this->beConstructedThrough(
            'fromDto',
            [$this->dto, new \spec\DtoToEntityFakeTransformer()]
        );
    }

    protected function prepareExecution()
    {
        $this->domain =  $this->getTestDouble(DomainInterface::class);
        $this->language =  $this->getTestDouble(LanguageInterface::class);
        $this->timezone = $this->getTestDouble(TimezoneInterface::class);

        $this->dto = new BrandDto();

        $this->hydrate(
            $this->dto,
            [
                'name' => '',
                'invoiceNif' => '',
                'invoicePostalAddress' => '',
                'invoicePostalCode' => '',
                'invoiceTown' => '',
                'invoiceProvince' => '',
                'invoiceCountry' => '',
                'invoiceRegistryData' => '',
                'defaultTimezone' => $this->timezone->reveal()
            ]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Brand::class);
    }

    function it_trims_domainUsers()
    {
        $dto = clone $this->dto;
        $stringValue = 'domainUsers';
        $dto->setDomainUsers(
            " $stringValue "
        );

        $this->updateFromDto(
            $dto,
            new \spec\DtoToEntityFakeTransformer()
        );

        $this
            ->getDomainUsers()
            ->shouldReturn($stringValue);
    }

    function it_has_default_language_code()
    {
        $this
            ->getLanguageCode()
            ->shouldReturn('en');

        $this
            ->language
            ->getIden()
            ->willReturn('myLang');

        $this->hydrate(
            $this->dto,
            [
                'language' => $this->language->reveal()
            ]
        );

        $this->updateFromDto(
            $this->dto,
            new \spec\DtoToEntityFakeTransformer()
        );

        $this
            ->getLanguageCode()
            ->shouldReturn('myLang');
    }

    function it_sums_company_recordingsDiskUsages()
    {
        $company = $this->getTestDouble(CompanyInterface::class);
        $company2 = $this->getTestDouble(CompanyInterface::class);

        $this->getterProphecy(
            $company,
            [
                'getId' => 1,
                'getRecordingsDiskUsage' => 5
            ]
        );
        $this->setterProphecy(
            $company,
            [
                'setBrand' => function () use ($company) {
                    return [
                        [Argument::any()],
                        $company
                    ];
                }
            ]
        );

        $this->getterProphecy(
            $company2,
            [
                'getId' => 2,
                'getRecordingsDiskUsage' => 12
            ]
        );
        $this->setterProphecy(
            $company2,
            [
                'setBrand' => function () use ($company2) {
                    return [
                        [Argument::any()],
                        $company2
                    ];
                }
            ]
        );

        $this->dto->setCompanies([
            $company->reveal(),
            $company2->reveal()
        ]);

        $this
            ->getRecordingsDiskUsage()
            ->shouldReturn(17);
    }

    function it_ignores_null_replationship_values()
    {
        $updateDto = clone $this->dto;

        $feature = $this->getTestDouble(
            FeaturesRelBrandInterface::class
        );
        $feature
            ->getId()
            ->willreturn(1);

        $this
            ->dto
            ->setRelFeatures([$feature->reveal()]);

        $updateDto
            ->setRelFeatures(null);

        $this->updateFromDto(
            $updateDto,
            new \spec\DtoToEntityFakeTransformer()
        );

        $this
            ->getRelFeatures()
            ->shouldReturn([$feature]);
    }

    function it_applies_empty_array_replationship_values()
    {
        $updateDto = clone $this->dto;

        $feature = $this->getTestDouble(
            FeaturesRelBrandInterface::class
        );
        $feature
            ->getId()
            ->willreturn(1);

        $this
            ->dto
            ->setRelFeatures([$feature->reveal()]);

        $updateDto
            ->setRelFeatures([]);

        $this->updateFromDto(
            $updateDto,
            new \spec\DtoToEntityFakeTransformer()
        );

        $this
            ->getRelFeatures()
            ->shouldReturn([]);
    }
}
