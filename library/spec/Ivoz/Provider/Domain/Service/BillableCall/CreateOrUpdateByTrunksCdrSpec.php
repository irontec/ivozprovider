<?php

namespace spec\Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Provider\Domain\Service\BillableCall\CreateOrUpdateByTrunksCdr;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrDto;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCall;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallDto;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use spec\HelperTrait;

class CreateOrUpdateByTrunksCdrSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    //////////////////////////////////////
    ///
    //////////////////////////////////////

    /**
     * @var TrunksCdrInterface
     */
    protected $trunksCdr;

    /**
     * @var CarrierInterface
     */
    protected $carrier;

    /**
     * @var BillableCallInterface
     */
    protected $billableCall;

    /**
     * @var BillableCallDto
     */
    protected $billableCallDto;

    /**
     * @var TrunksCdrDto
     */
    protected $trunksCdrDto;

    public function let(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;

        $this->beConstructedWith(
            $this->entityTools
        );

        $this->prepareExecution();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CreateOrUpdateByTrunksCdr::class);
    }

    function it_creates_new_billableCallDtos_on_empty_billableCall()
    {
        $this
            ->entityTools
            ->entityToDto(
                Argument::type(BillableCallInterface::class)
            )
            ->shouldNotBeCalled();

        $this
            ->entityTools
            ->persistDto(
                Argument::type(BillableCallDto::class),
                null,
                false
            )
            ->willReturn($this->billableCall);

        $this
            ->entityTools
            ->persistDto(
                Argument::type(BillableCallDto::class),
                null,
                false
            )
            ->shouldBeCalled();

        $this->execute(
            $this->trunksCdr,
            null
        );
    }

    function it_updates_billableCall_if_exists()
    {
        $this
            ->entityTools
            ->entityToDto($this->billableCall)
            ->willReturn($this->billableCallDto)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persistDto(
                Argument::type(BillableCallDto::class),
                Argument::type(BillableCallInterface::class),
                false
            )
            ->shouldBeCalled();

        $this->execute(
            $this->trunksCdr,
            $this->billableCall
        );
    }

    function it_preserves_carrierName_if_carrier_is_empty()
    {
        $this
            ->trunksCdr
            ->getCarrier()
            ->willReturn(null)
            ->shouldBeCalled();

        $this
            ->billableCallDto
            ->getCarrierName()
            ->willReturn('PrevName')
            ->shouldBeCalled();

        $this
            ->billableCallDto
            ->setCarrierName('PrevName')
            ->willReturn($this->billableCallDto)
            ->shouldBeCalled();

        $this->execute(
            $this->trunksCdr,
            $this->billableCall
        );
    }

    function it_updates_billableCallDto()
    {
        $any = Argument::any();
        $this->fluentSetterProphecy(
            $this->billableCallDto,
            [
                'setTrunksCdrId' => $any,
                'setBrandId' => $any,
                'setCompanyId' => $any,
                'setCarrierId' => $any,
                'setCarrierName' => $any,
                'setCallid' => $any,
                'setCaller' => $any,
            ]
        );

        $this->execute(
            $this->trunksCdr,
            $this->billableCall
        );
    }

    function it_sets_extra_attributes_when_new()
    {
        $this->getterProphecy(
            $this->trunksCdrDto,
            [
                'getCallee' => '+34600',
                'getStartTime' => new \DateTime(),
                'getDuration' => 3.6,
            ],
            true
        );

        $this
            ->entityTools
            ->persistDto(
                Argument::that(function (BillableCallDto $dto) {
                    $response =
                        ($dto->getCallee() === '+34600')
                        && ($dto->getStartTime() instanceof \DateTime)
                        && ($dto->getDuration() === 4.0);

                    return $response;
                }),
                null,
                false
            )
            ->willReturn($this->billableCall);

        $this->execute(
            $this->trunksCdr,
            null
        );
    }

    function it_skips_endpoint_info_if_no_retail_account()
    {
        $this
            ->trunksCdrDto
            ->getRetailAccountId()
            ->willReturn(null)
            ->shouldBeCalled();

        $this
            ->billableCallDto
            ->setEndpointId(Argument::any())
            ->shouldNotBeCalled();

        $this->execute(
            $this->trunksCdr,
            null
        );
    }

    function it_sets_endpoint_info_if_retail_account_exists()
    {
        $this
            ->trunksCdrDto
            ->getRetailAccountId()
            ->willReturn(999)
            ->shouldBeCalled();

        $this
            ->billableCallDto
            ->setEndpointType('RetailAccount')
            ->willReturn($this->billableCallDto)
            ->shouldBeCalled();

        $this
            ->billableCallDto
            ->setEndpointId(999)
            ->willReturn($this->billableCallDto)
            ->shouldBeCalled();

        $this->execute(
            $this->trunksCdr,
            $this->billableCall
        );
    }

    protected function prepareExecution()
    {
        $this->trunksCdr = $this->getTestDouble(
            TrunksCdrInterface::class
        );

        $this->carrier = $this->getTestDouble(
            CarrierInterface::class
        );

        $this->billableCall = $this->getTestDouble(
            BillableCallInterface::class
        );

        $this->billableCallDto = $this->getTestDouble(
            BillableCallDto::class
        );

        $this->trunksCdrDto = $this->getTestDouble(
            TrunksCdrDto::class
        );

        $this->trunksCdr
            ->getCarrier()
            ->willReturn($this->carrier);

        $this
            ->entityTools
            ->entityToDto(
                Argument::type(BillableCallInterface::class)
            )
            ->willReturn($this->billableCallDto);

        $this
            ->entityTools
            ->entityToDto(
                Argument::type(TrunksCdrInterface::class)
            )
            ->willReturn($this->trunksCdrDto);

        $this
            ->entityTools
            ->persistDto(
                Argument::type(BillableCallDto::class),
                Argument::any(),
                false
            )
            ->willReturn($this->billableCall);
    }
}
