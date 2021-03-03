<?php

namespace spec\Ivoz\Provider\Domain\Model\BalanceMovement;

use Ivoz\Provider\Domain\Model\BalanceMovement\BalanceMovement;
use Ivoz\Provider\Domain\Model\BalanceMovement\BalanceMovementDto;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;
use spec\DtoToEntityFakeTransformer;

class BalanceMovementSpec extends ObjectBehavior
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

    /**
     * @var DtoToEntityFakeTransformer
     */
    private $transformer;

    function let(
        CompanyInterface $company,
        CarrierInterface $carrier
    ) {
        $this->company = $company;
        $this->carrier = $carrier;

        $this->dto = $dto = new BalanceMovementDto();

        $this->transformer = new DtoToEntityFakeTransformer();

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(BalanceMovement::class);
    }

    function it_resets_company_when_carrier_is_set()
    {
        $companyDto = new CompanyDto();
        $carrierDto = new CarrierDto();

        $this
            ->dto
            ->setCompany($companyDto)
            ->setCarrier($carrierDto);

        $this->transformer->appendFixedTransforms([
            [$companyDto, $this->company->getWrappedObject()],
            [$carrierDto, $this->carrier->getWrappedObject()],
        ]);

        $this
            ->getCarrier()
            ->shouldReturn(
                $this->carrier->getWrappedObject()
            );

        $this
            ->getCompany()
            ->shouldReturn(null);
    }
}
