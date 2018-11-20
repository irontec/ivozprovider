<?php

namespace spec\Ivoz\Provider\Domain\Service\Carrier;

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

class SyncBalancesSpec extends ObjectBehavior
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityTools;

    /**
     * @var LoggerInterface
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

    public function let(
        EntityTools $entityTools,
        LoggerInterface $logger,
        CarrierBalanceServiceInterface $client,
        CarrierRepository $carrierRepository
    ) {
        $this->entityTools = $entityTools;
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

        $this->client
            ->getBalances(
                Argument::any(),
                Argument::any()
            )->willReturn($response);

        $this->logger
            ->error(Argument::type('string'))
            ->shouldBeCalled();

        $this->updateCarriers(1, [1]);
    }

    function it_updates_db_balances(
        CarrierInterface $carrier,
        CarrierDto $carrierDto
    ) {
        $carrierId = 1;
        $balance = 1000;

        $response = new \stdClass();
        $response->error = null;
        $response->result = [
            $carrierId => $balance
        ];

        $this->client
            ->getBalances(
                Argument::any(),
                Argument::any()
            )->willReturn($response)
            ->shouldBeCalled();

        $this->carrierRepository
            ->find($carrierId)
            ->willReturn($carrier)
            ->shouldBeCalled();

        $this->entityTools
            ->entityToDto($carrier)
            ->willReturn($carrierDto)
            ->shouldBeCalled();

        $carrierDto
            ->setBalance($balance)
            ->shouldBeCalled();

        $this->entityTools
            ->persistDto($carrierDto, $carrier)
            ->shouldBeCalled();

        $this->updateCarriers(1, [1]);
    }
}
