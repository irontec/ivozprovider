<?php

namespace spec\Ivoz\Provider\Domain\Model\BalanceNotification;

use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotification;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationDto;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
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
     * @var BalanceMovementDto
     */
    protected $dto;

    function let(
        CompanyInterface $company,
        CarrierInterface $carrier
    ) {
        $this->company = $company;
        $this->carrier = $carrier;

        $this->dto = $dto = new BalanceNotificationDto();

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(BalanceNotification::class);
    }

    function it_resets_company_when_carrier_is_set()
    {
        $this->hydrate(
            $this->dto,
            [
                'company' => $this->company->getWrappedObject(),
                'carrier' => $this->carrier->getWrappedObject(),
            ]
        );

        $this
            ->getCarrier()
            ->shouldReturn(
                $this->carrier->getWrappedObject()
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

    function it_resolves_language_through_carrier(
        BrandInterface $brand,
        LanguageInterface $language
    ) {
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

        $this->hydrate(
            $this->dto,
            [
                'carrier' => $this->carrier->getWrappedObject(),
            ]
        );

        $this
            ->getLanguage()
            ->shouldReturn($language);

        $this
            ->company
            ->getLanguage()
            ->shouldNotBecalled();
    }

    function it_resolves_language_through_company(
        LanguageInterface $language
    ) {
        $this
            ->company
            ->getId()
            ->willReturn(1);

        $this
            ->company
            ->getLanguage()
            ->willReturn($language);

        $this->hydrate(
            $this->dto,
            [
                'company' => $this->company->getWrappedObject(),
            ]
        );

        $this
            ->getLanguage()
            ->shouldReturn($language);
    }

    function it_can_resolve_entityName_through_its_carrier()
    {
        $this->hydrate(
            $this->dto,
            [
                'carrier' => $this->carrier->getWrappedObject(),
            ]
        );

        $this
            ->carrier
            ->getId()
            ->willReturn(1);

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
        $this->hydrate(
            $this->dto,
            [
                'company' => $this->company->getWrappedObject(),
            ]
        );

        $this
            ->company
            ->getId()
            ->willReturn(1);

        $this
            ->company
            ->getName()
            ->willReturn('CompanyName');

        $this
            ->getEntityName()
            ->shouldReturn('CompanyName');
    }
}
