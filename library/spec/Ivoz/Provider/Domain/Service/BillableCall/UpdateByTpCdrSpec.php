<?php

namespace spec\Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Kam\Domain\Model\TrunksCdr\Event\TrunksCdrWasMigrated;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCall;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface;
use Ivoz\Provider\Domain\Service\BillableCall\UpdateByTpCdr;
use Ivoz\Provider\Domain\Service\BillableCall\UpdateDtoByDefaultRunTpCdr;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrInterface;
use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrRepository;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationRepository;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanRepository;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallDto;
use Ivoz\Provider\Domain\Model\Destination\DestinationInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\Name;
use Ivoz\Core\Application\Service\EntityTools;
use Psr\Log\LoggerInterface;
use spec\HelperTrait;

class UpdateByTpCdrSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var TpCdrRepository
     */
    protected $tpCdrRepository;

    /**
     * @var UpdateDtoByDefaultRunTpCdr
     */
    protected $updateDtoByDefaultRunTpCdr;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /////////////////////////////////////////////7
    ///
    /////////////////////////////////////////////7

    /**
     * @var TrunksCdrInterface
     */
    protected $trunksCdr;

    /**
     * @var BillableCallInterface
     */
    protected $billableCall;

    /**
     * @var CarrierInterface
     */
    protected $carrier;

    /**
     * @var TpCdrInterface
     */
    protected $defaultRunTpCdr;

    /**
     * @var BillableCallDto
     */
    protected $billableCallDto;

    /**
     * @var TpCdrInterface
     */
    protected $carrierRunTpCdr;

    /**
     * @var TrunksCdrWasMigrated
     */
    protected $event;

    public function let()
    {
        $this->tpCdrRepository = $this->getTestDouble(
            TpCdrRepository::class
        );
        $this->updateDtoByDefaultRunTpCdr = $this->getTestDouble(
            UpdateDtoByDefaultRunTpCdr::class
        );
        $this->entityTools = $this->getTestDouble(
            EntityTools::class
        );
        $this->logger = $this->getTestDouble(
            LoggerInterface::class
        );

        $this->beConstructedWith(
            $this->tpCdrRepository,
            $this->updateDtoByDefaultRunTpCdr,
            $this->entityTools,
            $this->logger
        );

        $this->prepareExecution();
    }

    function prepareExecution()
    {
        $this->trunksCdr = $this->getTestDouble(
            TrunksCdrInterface::class
        );
        $this->billableCall = $this->getTestDouble(
            BillableCallInterface::class
        );
        $this->billableCallDto = $this->getTestDouble(
            BillableCallDto::class
        );
        $this->carrier = $this->getTestDouble(
            CarrierInterface::class
        );
        $this->defaultRunTpCdr = $this->getTestDouble(
            TpCdrInterface::class
        );
        $this->carrierRunTpCdr = $this->getTestDouble(
            TpCdrInterface::class
        );

        $this
            ->trunksCdr
            ->getCgrid()
            ->willReturn(1);

        $this
            ->billableCall
            ->getCarrier()
            ->willReturn($this->carrier);

        $this->getterProphecy(
            $this->carrier,
            [
                'getExternallyRated' => false,
                'getId' => 1
            ],
            false
        );

        $this
            ->tpCdrRepository
            ->getDefaultRunByCgrid(
                Argument::any()
            )
            ->willReturn($this->defaultRunTpCdr);

        $this
            ->entityTools
            ->entityToDto(
                Argument::type(BillableCallInterface::class)
            )
            ->willReturn($this->billableCallDto);

        $this
            ->updateDtoByDefaultRunTpCdr
            ->execute(
                Argument::type(BillableCallDto::class),
                Argument::type(TrunksCdrInterface::class),
                Argument::type(TpCdrInterface::class)
            )
            ->willReturn($this->billableCallDto);

        $this
            ->entityTools
            ->persistDto(
                Argument::type(BillableCallDto::class),
                Argument::type(BillableCallInterface::class),
                false
            );

        $this->event = new TrunksCdrWasMigrated(
            $this->trunksCdr->reveal(),
            $this->billableCall->reveal()
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByTpCdr::class);
    }

    function it_implements_domainEventSubscriberInterface()
    {
        $this->shouldHaveType(DomainEventSubscriberInterface::class);
    }

    function it_logs_an_error_and_returns_on_empty_cgrid()
    {
        $this
            ->trunksCdr
            ->getCgrid()
            ->willReturn(null);

        $this
            ->logger
            ->error(Argument::type('string'))
            ->shouldBeCalled();

        $this
            ->billableCall
            ->getCarrier()
            ->shouldNotBeCalled();

        $this->handle(
            $this->event
        );
    }

    function it_returns_on_externally_rated_carriers()
    {
        $this
            ->carrier
            ->getExternallyRated()
            ->willReturn(true);

        $this
            ->logger
            ->info(Argument::type('string'))
            ->shouldBeCalled();

        $this
            ->tpCdrRepository
            ->getDefaultRunByCgrid()
            ->shouldNotBeCalled();

        $this->handle(
            $this->event
        );
    }

    function it_calls_updateDtoByDefaultRunTpCdr_collaborator_service()
    {
        $this
            ->updateDtoByDefaultRunTpCdr
            ->execute(
                Argument::type(BillableCallDto::class),
                Argument::type(TrunksCdrInterface::class),
                Argument::type(TpCdrInterface::class)
            )
            ->willReturn($this->billableCallDto)
            ->shouldBeCalled();

        $this->handle(
            $this->event
        );
    }

    function it_set_cost_when_carrierRunTpCdr_is_found()
    {

        $carrierRunTpCdr = $this->getTestDouble(
            TpCdrInterface::class
        );

        $this
            ->tpCdrRepository
            ->getCarrierRunByCgrid(
                Argument::any()
            )
            ->willReturn($carrierRunTpCdr)
            ->shouldBeCalled();

        $carrierRunTpCdr
            ->getCost()
            ->willReturn(1)
            ->shouldBeCalled();

        $this->billableCallDto
            ->setCost(1)
            ->shouldBeCalled();

        $this->handle(
            $this->event
        );
    }

    function it_persists_billableCall()
    {
        $this
            ->entityTools
            ->persistDto(
                Argument::type(BillableCallDto::class),
                Argument::type(BillableCallInterface::class),
                false
            )
            ->shouldBeCalled();

        $this->handle(
            $this->event
        );
    }
}
