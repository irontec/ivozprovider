<?php

namespace spec\Ivoz\Provider\Domain\Service\Carrier;

use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;
use Ivoz\Provider\Domain\Service\Carrier\CarrierBalanceServiceInterface;
use Ivoz\Provider\Domain\Service\Carrier\SyncBalances;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Psr\Log\LoggerInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierRepository;
use spec\HelperTrait;

class SyncBalancesSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $entityTools;
    protected $logger;
    protected $client;
    protected $carrierRepository;

    public function let(
        LoggerInterface $logger,
        CarrierBalanceServiceInterface $client,
        CarrierRepository $carrierRepository
    ) {
        $this->entityTools = $this->getTestDouble(
            EntityTools::class,
            true
        );
        $this->logger = $logger;
        $this->client = $client;
        $this->carrierRepository = $carrierRepository;

        $this->beConstructedWith(
            $this->entityTools,
            $this->logger,
            $this->client,
            $this->carrierRepository
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SyncBalances::class);
    }

    function it_logs_errors()
    {
        $response = new \stdClass();
        $response->error = 'Message';

        $this
            ->client
            ->getBalances(
                Argument::any(),
                Argument::any()
            )
            ->willReturn($response);

        $this
            ->logger
            ->error(Argument::type('string'))
            ->shouldBeCalled();

        $this->updateCarriers(1, [1]);
    }

    function it_iterates_over_all_carriers()
    {
        $carrierId = 1;
        $this->prepareExecution(
            $carrierId
        );

        $this
            ->carrierRepository
            ->getCarrierIdsWithCalculatecostGroupByBrand()
            ->willReturn([
                1 => [$carrierId]
            ])
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persistDto(
                Argument::type(CarrierDto::class),
                Argument::type(CarrierInterface::class)
            )
            ->shouldBeCalled();

        $this->updateAll();
    }

    function it_updates_balances()
    {
        $carrierId = 1;
        $this->prepareExecution(
            $carrierId
        );

        $this
            ->entityTools
            ->persistDto(
                Argument::type(CarrierDto::class),
                Argument::type(Carrier::class)
            )
            ->shouldBeCalled();

        $this->updateCarriers(1, [1]);
    }

    function it_logs_not_found_carriers()
    {
        $carrierId = 1;
        $this->prepareExecution(
            $carrierId
        );

        $this
            ->carrierRepository
            ->find($carrierId)
            ->willReturn(null);

        $this
            ->logger
            ->error(
                Argument::type('string')
            )->shouldBeCalled();

        $this->updateCarriers(
            1,
            [1]
        );
    }

    /**
     * @param CarrierInterface $carrier
     * @param CarrierDto $carrierDto
     */
    private function prepareExecution(
        int $carrierId
    ) {
        $balance = 1000;
        $carrier = $this->getInstance(
            Carrier::class,
            [
                'id' => $carrierId,
                'balance' => $balance,
                'name' => 'carrier1',
            ]
        );

        $response = new \stdClass();
        $response->error = null;
        $response->result = [
            $carrierId => $balance
        ];

        $this
            ->client
            ->getBalances(
                Argument::any(),
                Argument::any()
            )
            ->willReturn($response);

        $this
            ->carrierRepository
            ->find($carrierId)
            ->willReturn($carrier);

        $this
            ->entityTools
            ->entityToDto($carrier)
            ->will(function ($args) {
                return $args[0]->toDto();
            });

        $this
            ->entityTools
            ->persistDto(
                Argument::type(CarrierDto::class),
                Argument::type(Carrier::class)
            )
            ->will(function ($args) {
                return $args[1];
            });
    }
}
