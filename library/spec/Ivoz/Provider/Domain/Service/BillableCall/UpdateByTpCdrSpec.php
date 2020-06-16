<?php

namespace spec\Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Cgr\Domain\Model\TpCdr\TpCdr;
use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrRepository;
use Ivoz\Cgr\Infrastructure\Cgrates\Service\ProcessExternalCdr;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Kam\Domain\Model\TrunksCdr\Event\TrunksCdrWasMigrated;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdr;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCall;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallDto;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Service\BillableCall\UpdateByTpCdr;
use Ivoz\Provider\Domain\Service\BillableCall\UpdateDtoByDefaultRunTpCdr;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;
use spec\HelperTrait;

class UpdateByTpCdrSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $tpCdrRepository;
    protected $updateDtoByDefaultRunTpCdr;
    protected $entityTools;
    protected $logger;

    /////////////////////////////////////////////7
    ///
    /////////////////////////////////////////////7

    protected $trunksCdr;
    protected $billableCall;
    protected $carrier;
    protected $defaultRunTpCdr;
    protected $processExternalCdr;
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
            EntityTools::class,
            true
        );
        $this->logger = $this->getTestDouble(
            LoggerInterface::class
        );
        $this->processExternalCdr = $this->getTestDouble(
            ProcessExternalCdr::class
        );

        $this->beConstructedWith(
            $this->tpCdrRepository,
            $this->updateDtoByDefaultRunTpCdr,
            $this->processExternalCdr,
            $this->entityTools,
            $this->logger
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

    function it_returns_on_non_outbound_calls()
    {
        $this->prepareExecution();

        $this->updateInstance(
            $this->billableCall,
            [
                'id' => 1,
                'direction' => BillableCallInterface::DIRECTION_INBOUND
            ]
        );

        $msg = sprintf(
            'Skipping %s call #%d',
            $this->billableCall->getDirection(),
            $this->billableCall->getId()
        );

        $this
            ->logger
            ->info($msg)
            ->shouldBeCalled();

        $this->handle(
            $this->event
        );
    }

    function it_logs_a_info_msg_and_returns_on_empty_cgrid()
    {
        $this->prepareExecution();
        $this->updateInstance(
            $this->trunksCdr,
            [
                'cgrid' => null
            ]
        );

        $this
            ->logger
            ->info('Cgrid was not found. Skipping')
            ->shouldBeCalled();

        $this->handle(
            $this->event
        );
    }

    function it_retries_to_rate_call_on_empty_cgrid()
    {
        $this->prepareExecution();
        $this->updateInstance(
            $this->trunksCdr,
            [
                'cgrid' => null
            ]
        );

        $this
            ->processExternalCdr
            ->execute(
                $this->trunksCdr
            )
            ->shouldBeCalled();

        $this->handle(
            $this->event
        );
    }

    function it_returns_on_externally_rated_carriers()
    {
        $this->prepareExecution();
        $this->updateInstance(
            $this->carrier,
            [
                'externallyRated' => true
            ]
        );

        $infoMsg = sprintf(
            'Carrier#%s has external rater. Skipping',
            $this->carrier->getId()
        );

        $this
            ->logger
            ->info($infoMsg)
            ->shouldBeCalled();

        $this->handle(
            $this->event
        );
    }

    function it_calls_updateDtoByDefaultRunTpCdr_collaborator_service()
    {
        $this->prepareExecution();
        $this
            ->updateDtoByDefaultRunTpCdr
            ->execute(
                Argument::type(BillableCallDto::class),
                $this->trunksCdr,
                $this->defaultRunTpCdr
            )
            ->shouldBeCalled()
            ->will(
                function ($args) {
                    return $args[0];
                }
            );

        $this->handle(
            $this->event
        );
    }

    function it_sets_cost_when_carrierRunTpCdr_is_found()
    {
        $this->prepareExecution();
        $billableCallDto = $this->getTestDouble(
            BillableCallDto::class
        );

        $this
            ->entityTools
            ->entityToDto($this->billableCall)
            ->willReturn($billableCallDto);

        $cost = 11;
        $carrierRunTpCdr = $this->getInstance(
            TpCdr::class,
            ['cost' => $cost]
        );

        $this
            ->tpCdrRepository
            ->getCarrierRunByCgrid(
                Argument::any()
            )
            ->willReturn(
                $carrierRunTpCdr
            );

        $billableCallDto
            ->setCost(
                $cost
            )
            ->shouldBeCalled();

        $this->handle(
            $this->event
        );
    }

    function it_persists_billableCall()
    {
        $this->prepareExecution();
        $this
            ->entityTools
            ->persistDto(
                Argument::type(BillableCallDto::class),
                $this->billableCall,
                false
            )
            ->shouldBeCalled();

        $this->handle(
            $this->event
        );
    }

    function prepareExecution()
    {
        $this->trunksCdr = $this->getInstance(
            TrunksCdr::class,
            [
                'id' => 1,
                'cgrid' => 2,
            ]
        );

        $this->carrier = $this->getInstance(
            Carrier::class,
            [
                'id' => 1,
                'externallyRated' => false
            ]
        );

        $this->billableCall = $this->getInstance(
            BillableCall::class,
            [
                'id' => 1,
                'trunksCdr' => $this->trunksCdr,
                'carrier' => $this->carrier,
                'direction' => BillableCallInterface::DIRECTION_OUTBOUND
            ]
        );

        $this->defaultRunTpCdr = $this->getInstance(
            TpCdr::class
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
                Argument::any()
            )
            ->will(
                function ($args) {
                    return $args[0]->toDto();
                }
            );

        $this
            ->updateDtoByDefaultRunTpCdr
            ->execute(
                Argument::type(BillableCallDto::class),
                $this->trunksCdr,
                $this->defaultRunTpCdr
            )
            ->will(
                function ($args) {
                    return $args[0];
                }
            );

        $this->event = new TrunksCdrWasMigrated(
            $this->trunksCdr,
            $this->billableCall
        );
    }
}
