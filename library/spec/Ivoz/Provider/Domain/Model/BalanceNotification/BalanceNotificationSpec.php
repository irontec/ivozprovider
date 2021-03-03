<?php

namespace spec\Ivoz\Provider\Domain\Model\BalanceNotification;

use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotification;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationDto;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Language\Language;
use PhpSpec\ObjectBehavior;
use spec\DtoToEntityFakeTransformer;
use spec\HelperTrait;

class BalanceNotificationSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var CarrierInterface
     */
    protected $carrier;

    /**
     * @var BalanceNotificationDto
     */
    protected $dto;

    /**
     * @var DtoToEntityFakeTransformer
     */
    private $transformer;

    function let()
    {
        $this->company = $this->getTestDouble(Company::class);
        $this->carrier = $this->getTestDouble(Carrier::class);

        $this->dto = $dto = new BalanceNotificationDto();

        $this->transformer = new DtoToEntityFakeTransformer();

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(BalanceNotification::class);
    }

    function it_resets_company_when_carrier_is_set()
    {
        $companyDto = new CompanyDto();
        $company = $this->company->reveal();
        $carrierDto = new CarrierDto();
        $carrier = $this->carrier->reveal();

        $this->transformer->appendFixedTransforms([
            [$companyDto, $company],
            [$carrierDto, $carrier],
        ]);

        $this
            ->dto
            ->setCompany($companyDto)
            ->setCarrier($carrierDto);

        $this
            ->getCarrier()
            ->shouldReturn(
                $carrier
            );

        $this
            ->getCompany()
            ->shouldReturn(null);
    }

    function it_may_return_empty_language()
    {
        $this
            ->getLanguage()
            ->shouldReturn(null);
    }

    function it_resolves_language_through_carrier()
    {
        $brand = $this->getTestDouble(Brand::class);
        $language = $this->getInstance(Language::class);

        $this
            ->carrier
            ->getId()
            ->willReturn(1);

        $this
            ->carrier
            ->getBrand()
            ->willReturn($brand);

        $brand
            ->getLanguage()
            ->willReturn($language);

        $carrierDto = new CarrierDto();
        $carrier = $this->carrier->reveal();
        $this
            ->dto
            ->setCarrier($carrierDto);

        $this->transformer->appendFixedTransforms([
            [$carrierDto, $carrier]
        ]);

        $this
            ->getLanguage()
            ->shouldReturn($language);

        $this
            ->company
            ->getLanguage()
            ->shouldNotBecalled();
    }

    function it_resolves_language_through_company()
    {
        $language = $this->getInstance(Language::class);

        $companyDto = new CompanyDto();
        $this
            ->company
            ->getId()
            ->willReturn(1);

        $this
            ->company
            ->getLanguage()
            ->willReturn($language);

        $this
            ->dto
            ->setCompany($companyDto);

        $this->transformer->appendFixedTransforms([
            [$companyDto, $this->company->reveal()]
        ]);

        $this
            ->getLanguage()
            ->shouldReturn($language);
    }

    function it_can_resolve_entityName_through_its_carrier()
    {
        $carrierDto = new CarrierDto();
        $this
            ->dto
            ->setCarrier($carrierDto);

        $this
            ->carrier
            ->getId()
            ->willReturn(1);

        $this->transformer->appendFixedTransforms([
            [$carrierDto, $this->carrier->reveal()]
        ]);

        $this
            ->carrier
            ->getName()
            ->willReturn('CarrierName');

        $this
            ->getEntityName()
            ->shouldReturn('CarrierName');
    }

    function it_can_resolve_entityName_through_its_company()
    {
        $companyDto = new CompanyDto();
        $this
            ->dto
            ->setCompany($companyDto);

        $this
            ->company
            ->getId()
            ->willReturn(1);

        $this
            ->company
            ->getName()
            ->willReturn('CompanyName');

        $this->transformer->appendFixedTransforms([
            [$companyDto, $this->company->reveal()]
        ]);

        $this
            ->getEntityName()
            ->shouldReturn('CompanyName');
    }
}
