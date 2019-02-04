<?php

namespace spec\Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Provider\Domain\Model\BillableCall\BillableCallDto;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Service\BillableCall\CreateOrUpdateByTrunksCdr;
use Ivoz\Provider\Domain\Service\BillableCall\MigrateFromTrunksCdr;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdr;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrDto;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrRepository;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Psr\Log\LoggerInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class MigrateFromTrunksCdrSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var TrunksCdrRepository
     */
    protected $trunksCdrRepository;

    /**
     * @var BillableCallRepository
     */
    protected $billableCallRepository;

    /**
     * @var CreateOrUpdateByTrunksCdr
     */
    protected $createOrUpdateBillableCallByTrunksCdr;

    /**
     * @var DomainEventPublisher
     */
    protected $domainEventPublisher;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function let(
        TrunksCdrRepository  $trunksCdrRepository,
        BillableCallRepository $billableCallRepository,
        CreateOrUpdateByTrunksCdr $createOrUpdateBillableCallByTrunksCdr,
        EntityTools $entityTools,
        DomainEventPublisher $domainEventPublisher,
        LoggerInterface $logger
    ) {
        $this->trunksCdrRepository = $trunksCdrRepository;
        $this->billableCallRepository = $billableCallRepository;
        $this->createOrUpdateBillableCallByTrunksCdr = $createOrUpdateBillableCallByTrunksCdr;
        $this->domainEventPublisher = $domainEventPublisher;
        $this->entityTools = $entityTools;
        $this->logger = $logger;

        $this->beConstructedWith(
            $this->trunksCdrRepository,
            $this->billableCallRepository,
            $this->createOrUpdateBillableCallByTrunksCdr,
            $this->entityTools,
            $this->domainEventPublisher,
            $this->logger
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(MigrateFromTrunksCdr::class);
    }

    function it_logs_success_message()
    {
        $this->trunksCdrRepository
            ->getUnparsedCallsGeneratorWithoutOffset(MigrateFromTrunksCdr::BATCH_SIZE)
            ->willReturn([]);

        $this
            ->logger
            ->info(
                Argument::containingString('successfully')
            )
            ->shouldBeCalled();

        $this->execute();
    }

    function it_logs_error_message_on_exceptions(
        TrunksCdrInterface $trunksCdr,
        BrandInterface $brand,
        BillableCallInterface $billableCall,
        BillableCallDto $billableCallDto,
        TrunksCdrDto $trunksCdrDto
    ) {
        $exception = new \Exception('Some error');
        $this->prepareExecution(
            $trunksCdr,
            $brand,
            $billableCall,
            $billableCallDto,
            $trunksCdrDto
        );

        $this
            ->entityTools
            ->dispatchQueuedOperations()
            ->willThrow($exception)
            ->shouldBeCalled();

        $this->fluentSetterProphecy(
            $this->logger,
            [
                'info' => Argument::any(),
                'error' => Argument::containingString($exception->getMessage()),
            ]
        );

        $this->execute();
    }

    function it_queues_db_persist_operations(
        TrunksCdrInterface $trunksCdr,
        BrandInterface $brand,
        BillableCallInterface $billableCall,
        BillableCallDto $billableCallDto,
        TrunksCdrDto $trunksCdrDto
    ) {
        $this->prepareExecution(
            $trunksCdr,
            $brand,
            $billableCall,
            $billableCallDto,
            $trunksCdrDto
        );

        $this
            ->entityTools
            ->persist(
                Argument::type(BillableCallInterface::class),
                false
            )
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persistDto(
                Argument::type(TrunksCdrDto::class),
                Argument::type(TrunksCdrInterface::class),
                false
            )
            ->shouldBeCalled();

        $this
            ->entityTools
            ->dispatchQueuedOperations()
            ->shouldBeCalled();

        $this->execute();
    }

    protected function prepareTrunksCdr(
        TrunksCdrInterface $trunksCdr,
        BrandInterface $brand
    ) {
        $this->getterProphecy(
            $trunksCdr,
            [
                'getId' => 1
            ]
        );
    }

    protected function prepareExecution(
        TrunksCdrInterface $trunksCdr,
        BrandInterface $brand,
        BillableCallInterface $billableCall,
        BillableCallDto $billableCallDto,
        TrunksCdrDto $trunksCdrDto
    ) {
        $this
            ->prepareTrunksCdr(
                $trunksCdr,
                $brand
            );

        $this
            ->trunksCdrRepository
            ->getUnparsedCallsGeneratorWithoutOffset(MigrateFromTrunksCdr::BATCH_SIZE)
            ->willReturn([[$trunksCdr]]);

        $this
            ->billableCallRepository
            ->findOneByTrunksCdrId(
                Argument::any()
            )
            ->willReturn($billableCall);

        $this
            ->createOrUpdateBillableCallByTrunksCdr
            ->execute(
                Argument::type(TrunksCdrInterface::class),
                Argument::type(BillableCallInterface::class)
            )
            ->willReturn($billableCall);

        $this
            ->entityTools
            ->entityToDto(
                Argument::type(TrunksCdrInterface::class)
            )
            ->willReturn($trunksCdrDto);

        $this
            ->entityTools
            ->persist(
                Argument::any(),
                Argument::any()
            )
            ->willReturn(null);

        $this
            ->entityTools
            ->persistDto(
                Argument::any(),
                Argument::any(),
                Argument::any()
            )
            ->willReturn(null);
    }
}
