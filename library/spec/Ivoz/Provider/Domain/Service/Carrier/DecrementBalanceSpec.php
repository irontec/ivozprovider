<?php

namespace spec\Ivoz\Provider\Domain\Service\Carrier;

use Ivoz\Provider\Domain\Model\BalanceMovement\BalanceMovementDto;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Service\Carrier\CarrierBalanceServiceInterface;
use Ivoz\Provider\Domain\Service\Carrier\DecrementBalance;
use Ivoz\Provider\Domain\Service\Carrier\SyncBalances;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Symfony\Bridge\Monolog\Logger;
use Ivoz\Provider\Domain\Model\Carrier\CarrierRepository;

class DecrementBalanceSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var CarrierBalanceServiceInterface
     */
    protected $client;

    /**
     * @var CarrierRepository
     */
    protected $carrierRepository;

    /**
     * @var SyncBalances
     */
    protected $syncBalanceService;

    /**
     * @var string
     */
    protected $lastError;

    /**
     * IncrementBalance constructor.
     *
     * @param EntityTools $entityTools
     * @param Logger $logger
     * @param CarrierBalanceServiceInterface $client
     * @param CarrierRepository $carrierRepository
     * @param SyncBalances $syncBalanceService
     */
    public function let(
        EntityTools $entityTools,
        Logger $logger,
        CarrierBalanceServiceInterface $client,
        CarrierRepository $carrierRepository,
        SyncBalances $syncBalanceService
    ) {
        $this->entityTools = $entityTools;
        $this->logger = $logger;
        $this->client = $client;
        $this->carrierRepository = $carrierRepository;
        $this->syncBalanceService = $syncBalanceService;

        $this->beConstructedWith(
            $this->entityTools,
            $this->logger,
            $this->client,
            $this->carrierRepository,
            $this->syncBalanceService
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DecrementBalance::class);
    }

    function it_decreases_balance(
        CarrierInterface $carrier,
        BrandInterface $brand
    ) {
        $this->prepareExecution(
            $carrier,
            $brand
        );

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

    function it_creates_balance_movement(
        CarrierInterface $carrier,
        BrandInterface $brand
    ) {
        $this->prepareExecution(
            $carrier,
            $brand
        );

        $this
            ->entityTools
            ->persistDto(
                Argument::type(BalanceMovementDto::class),
                null,
                true
            )
            ->shouldBeCalled();

        $this->execute(
            1,
            10.15
        );
    }

    protected function prepareExecution(
        CarrierInterface $carrier,
        BrandInterface $brand
    ) {
        $this
            ->logger
            ->info(Argument::any())
            ->willReturn(null);

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

        $carrier
            ->getBrand()
            ->willReturn($brand);

        $carrier
            ->getId()
            ->willReturn(2);

        $brand
            ->getId()
            ->willReturn(1);

        $this
            ->client
            ->getBalance(
                Argument::type('numeric'),
                Argument::type('numeric')
            )
            ->willReturn(100.45);
    }
}
