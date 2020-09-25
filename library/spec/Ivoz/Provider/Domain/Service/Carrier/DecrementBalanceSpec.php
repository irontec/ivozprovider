<?php

namespace spec\Ivoz\Provider\Domain\Service\Carrier;

use Ivoz\Provider\Domain\Model\BalanceMovement\BalanceMovementDto;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Service\Carrier\CarrierBalanceServiceInterface;
use Ivoz\Provider\Domain\Service\Carrier\DecrementBalance;
use Ivoz\Provider\Domain\Service\Carrier\SyncBalances;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Symfony\Bridge\Monolog\Logger;
use Ivoz\Provider\Domain\Model\Carrier\CarrierRepository;
use Ivoz\Provider\Domain\Service\BalanceMovement\CreateByCarrier;

class DecrementBalanceSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $entityTools;
    protected $logger;
    protected $client;
    protected $carrierRepository;
    protected $syncBalanceService;
    protected $lastError;
    protected $createBalanceMovementByCarrier;

    public function let(
        EntityTools $entityTools,
        Logger $logger,
        CarrierBalanceServiceInterface $client,
        CarrierRepository $carrierRepository,
        SyncBalances $syncBalanceService,
        CreateByCarrier $createByCarrier
    ) {
        $this->entityTools = $entityTools;
        $this->logger = $logger;
        $this->client = $client;
        $this->carrierRepository = $carrierRepository;
        $this->syncBalanceService = $syncBalanceService;
        $this->createBalanceMovementByCarrier = $createByCarrier;

        $this->beConstructedWith(
            $this->entityTools,
            $this->logger,
            $this->client,
            $this->carrierRepository,
            $this->syncBalanceService,
            $createByCarrier
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DecrementBalance::class);
    }

    function it_decreases_balance()
    {
        $carrier = $this->prepareExecution();

        $this
            ->syncBalanceService
            ->updateCarriers(
                Argument::type('numeric'),
                Argument::type('array')
            )
            ->shouldBeCalled();

        $this->execute(
            1,
            10.15
        );
    }

    function it_creates_balance_movement()
    {
        $carrier = $this->prepareExecution();

        $this
            ->createBalanceMovementByCarrier
            ->execute(
                $carrier,
                Argument::any(),
                Argument::any()
            )
            ->shouldBeCalled();

        $this->execute(
            1,
            10.15
        );
    }

    protected function prepareExecution()
    {
        $brand = $this->getInstance(
            Brand::class,
            [
                'id' => 1
            ]
        );

        $carrier = $this->getInstance(
            Carrier::class,
            [
                'id' => 2,
                'brand' => $brand
            ]
        );

        $this
            ->logger
            ->info(Argument::any());

        $this
            ->carrierRepository
            ->find(Argument::type('numeric'))
            ->willReturn($carrier);

        $this
            ->client
            ->decrementBalance(
                $carrier,
                Argument::type('float')
            )
            ->willReturn([
                'success' => true
            ]);

        $this
            ->client
            ->getBalance(
                Argument::type('numeric'),
                Argument::type('numeric')
            )
            ->willReturn(100.45);

        return $carrier;
    }
}
