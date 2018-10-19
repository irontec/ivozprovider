<?php

namespace spec\Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Provider\Domain\Service\BillableCall\CreateOrUpdateDtoByTrunksCdr;
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

class CreateOrUpdateDtoByTrunksCdrSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    public function let(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;

        $this->beConstructedWith(
            $this->entityTools
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CreateOrUpdateDtoByTrunksCdr::class);
    }

    function it_creates_new_billableCallDtos_on_empty_billableCall(
        TrunksCdrInterface $trunksCdr,
        CarrierInterface $carrier
    ) {
        $this->prepareExecution(
            $trunksCdr,
            $carrier,
            new BillableCallDto(),
            new TrunksCdrDto()
        );

        $this
            ->entityTools
            ->entityToDto(
                Argument::type(BillableCallInterface::class)
            )
            ->shouldNotBeCalled();

        $this->execute(
            $trunksCdr,
            null
        );
    }

    function it_gets_billableCallDtos_from_billableCall(
        TrunksCdrInterface $trunksCdr,
        CarrierInterface $carrier,
        BillableCall $billableCall
    ) {
        $billableCallDto = new BillableCallDto();

        $this->prepareExecution(
            $trunksCdr,
            $carrier,
            $billableCallDto,
            new TrunksCdrDto()
        );

        $this
            ->entityTools
            ->entityToDto($billableCall)
            ->willReturn($billableCallDto)
            ->shouldBeCalled();

        $this->execute(
            $trunksCdr,
            $billableCall
        );
    }

    function it_updates_billableCallDto(
        TrunksCdrInterface $trunksCdr,
        CarrierInterface $carrier,
        BillableCall $billableCall,
        BillableCallDto $billableCallDto
    ) {
        $this->prepareExecution(
            $trunksCdr,
            $carrier,
            $billableCallDto,
            new TrunksCdrDto()
        );

        $any = Argument::any();
        $this->fluentSetterProphecy(
            $billableCallDto,
            [
                'setTrunksCdrId' => $any,
                'setBrandId' => $any,
                'setCompanyId' => $any,
                'setCarrierId' => $any,
                'setCarrierName' => $any,
                'setCallid' => $any,
                'setCaller' => $any,
                'setCallee' => $any,
                'setStartTime' => $any,
                'setDuration' => $any
            ]
        );

        $this->execute(
            $trunksCdr,
            $billableCall
        );
    }

    protected function prepareExecution(
        TrunksCdrInterface $trunksCdr,
        CarrierInterface $carrier,
        BillableCallDto $billableCallDto,
        TrunksCdrDto $trunksCdrDto
    ) {
        $trunksCdr
            ->getCarrier()
            ->willReturn($carrier);

        $this
            ->entityTools
            ->entityToDto(
                Argument::type(BillableCallInterface::class)
            )
            ->willReturn($billableCallDto);

        $this
            ->entityTools
            ->entityToDto(
                Argument::type(TrunksCdrInterface::class)
            )
            ->willReturn($trunksCdrDto);
    }
}
