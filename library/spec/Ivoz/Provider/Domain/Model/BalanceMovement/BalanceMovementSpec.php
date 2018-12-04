<?php

namespace spec\Ivoz\Provider\Domain\Model\BalanceMovement;

use Ivoz\Provider\Domain\Model\BalanceMovement\BalanceMovement;
use Ivoz\Provider\Domain\Model\BalanceMovement\BalanceMovementDto;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

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

    function let(
        CompanyInterface $company,
        CarrierInterface $carrier
    ) {
        $this->company = $company;
        $this->carrier = $carrier;

        $this->dto = $dto = new BalanceMovementDto();

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(BalanceMovement::class);
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
}
