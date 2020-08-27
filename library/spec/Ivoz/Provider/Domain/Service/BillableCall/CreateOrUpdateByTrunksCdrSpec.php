<?php

namespace spec\Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdr;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrDto;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCall;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallDto;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendRepository;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceRepository;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountRepository;
use Ivoz\Provider\Domain\Model\User\UserRepository;
use Ivoz\Provider\Domain\Service\BillableCall\CreateOrUpdateByTrunksCdr;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class CreateOrUpdateByTrunksCdrSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $entityTools;
    protected $retailAccountRepository;
    protected $residentialDeviceRepository;
    protected $userRepository;
    protected $friendRepository;

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

    public function let(
        EntityTools $entityTools,
        RetailAccountRepository $retailAccountRepository,
        ResidentialDeviceRepository $residentialDeviceRepository,
        UserRepository $userRepository,
        FriendRepository $friendRepository
    ) {
        $this->entityTools = $entityTools;
        $this->retailAccountRepository = $retailAccountRepository;
        $this->residentialDeviceRepository = $residentialDeviceRepository;
        $this->userRepository = $userRepository;
        $this->friendRepository = $friendRepository;

        $this->beConstructedWith(
            $this->entityTools,
            $this->retailAccountRepository,
            $this->residentialDeviceRepository,
            $this->userRepository,
            $this->friendRepository
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
            ->willReturn($this->billableCall->toDto())
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
        $this->updateInstance(
            $this->trunksCdr,
            [
                'carrier' => null
            ]
        );

        $billableCallDto = $this->mockBillableCallDto();

        $billableCallDto
            ->getCarrierName()
            ->willReturn('PrevName')
            ->shouldBeCalled();

        $billableCallDto
            ->setCarrierName('PrevName')
            ->willReturn($billableCallDto)
            ->shouldBeCalled();

        $this->execute(
            $this->trunksCdr,
            $this->billableCall
        );
    }

    function it_updates_billableCallDto()
    {
        $billableCallDto = $this->mockBillableCallDto();
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
            ]
        );

        $this->execute(
            $this->trunksCdr,
            $this->billableCall
        );
    }

    function it_sets_extra_attributes_when_new()
    {
        $trunksCdrDto = $this->mockTrunksCdrDto();
        $this->getterProphecy(
            $trunksCdrDto,
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
        $billableCallDto = $this->mockBillableCallDto();
        $trunksCdrDto = $this->mockTrunksCdrDto();

        $trunksCdrDto
            ->getRetailAccountId()
            ->willReturn(null)
            ->shouldBeCalled();

        $billableCallDto
            ->setEndpointId(Argument::any())
            ->shouldNotBeCalled();

        $this->execute(
            $this->trunksCdr,
            null
        );
    }

    function it_sets_endpoint_info_if_retail_account_exists()
    {
        $trunksCdrDto = $this->mockTrunksCdrDto();
        $billableCallDto = $this->mockBillableCallDto();

        $trunksCdrDto
            ->getRetailAccountId()
            ->willReturn(999)
            ->shouldBeCalled();

        $billableCallDto
            ->setEndpointType('RetailAccount')
            ->willReturn($billableCallDto)
            ->shouldBeCalled();

        $billableCallDto
            ->setEndpointId(999)
            ->willReturn($billableCallDto)
            ->shouldBeCalled();

        $this->execute(
            $this->trunksCdr,
            $this->billableCall
        );
    }

    protected function prepareExecution()
    {
        $this->carrier = $this->getInstance(
            Carrier::class,
            [
                'name' => 'carrer1',
            ]
        );

        $this->trunksCdr = $this->getInstance(
            TrunksCdr::class,
            [
                'carrier' => $this->carrier,
                'startTime' => new \DateTime(),
                'endTime' => new \DateTime(),
                'parserScheduledAt' => new \DateTime(),
            ]
        );

        $this->billableCall = $this->getInstance(
            BillableCall::class
        );

        $this
            ->entityTools
            ->entityToDto(
                Argument::any()
            )
            ->will(
                function ($args) {
                    return $args[0]->toDto();
                }
            );

        $this
            ->entityTools
            ->persistDto(
                Argument::type(BillableCallDto::class),
                Argument::any(),
                false
            )
            ->willReturn($this->billableCall);
    }

    private function mockBillableCallDto()
    {
        $billableCallDto = $this->getTestDouble(
            BillableCallDto::class,
            true
        );

        $this
            ->entityTools
            ->entityToDto(
                $this->billableCall
            )
            ->willReturn(
                $billableCallDto
            );

        return $billableCallDto;
    }

    private function mockTrunksCdrDto()
    {
        $trunksCdrDto = $this->getTestDouble(
            TrunksCdrDto::class,
            true
        );

        $this
            ->entityTools
            ->entityToDto(
                $this->trunksCdr
            )
            ->willReturn(
                $trunksCdrDto
            );

        return $trunksCdrDto;
    }
}
