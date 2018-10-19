<?php

namespace spec\Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Provider\Domain\Model\BillableCall\BillableCallDto;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Service\BillableCall\CreateOrUpdateDtoByTrunksCdr;
use Ivoz\Provider\Domain\Service\BillableCall\MigrateFromTrunksCdr;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdr;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrDto;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrRepository;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;
use Ivoz\Provider\Domain\Service\BillableCall\UpdateDtoByTpCdr;
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
     * @var CreateOrUpdateDtoByTrunksCdr
     */
    protected $createOrUpdateBillableCallByTrunksCdr;

    /**
     * @var UpdateDtoByTpCdr
     */
    protected $updateBillableCallByTpCdr;

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
        CreateOrUpdateDtoByTrunksCdr $createOrUpdateBillableCallByTrunksCdr,
        UpdateDtoByTpCdr $updateBillableCallByTpCdr,
        EntityTools $entityTools,
        LoggerInterface $logger
    ) {
        $this->trunksCdrRepository = $trunksCdrRepository;
        $this->billableCallRepository = $billableCallRepository;
        $this->createOrUpdateBillableCallByTrunksCdr = $createOrUpdateBillableCallByTrunksCdr;
        $this->updateBillableCallByTpCdr = $updateBillableCallByTpCdr;
        $this->entityTools = $entityTools;
        $this->logger = $logger;

        $this->beConstructedWith(
            $this->trunksCdrRepository,
            $this->billableCallRepository,
            $this->createOrUpdateBillableCallByTrunksCdr,
            $this->updateBillableCallByTpCdr,
            $this->entityTools,
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
            ->getUnmeteredCallsGeneratorWithoutOffset(MigrateFromTrunksCdr::BATCH_SIZE)
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
            ->persistDto(
                Argument::type(BillableCallDto::class),
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
                'getId' => 1,
                'getCgrid' => 'cgrid',
                'getBrand' => $brand
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
            ->getUnmeteredCallsGeneratorWithoutOffset(MigrateFromTrunksCdr::BATCH_SIZE)
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
            ->willReturn($billableCallDto);

        $this
            ->entityTools
            ->entityToDto(
                Argument::type(TrunksCdrInterface::class)
            )
            ->willReturn($trunksCdrDto);

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
