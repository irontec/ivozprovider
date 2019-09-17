<?php

namespace spec\Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Provider\Domain\Model\BillableCall\BillableCallDto;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Service\BillableCall\CreateOrUpdateByTrunksCdr;
use Ivoz\Provider\Domain\Service\BillableCall\MigrateFromUnparsedTrunksCdr;
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

class MigrateFromUnparsedTrunksCdrSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $trunksCdrRepository;
    protected $entityTools;
    protected $migrateFromTrunksCdr;
    protected $logger;

    public function let(
        TrunksCdrRepository  $trunksCdrRepository,
        EntityTools $entityTools,
        MigrateFromTrunksCdr $migrateFromTrunksCdr,
        LoggerInterface $logger
    ) {
        $this->trunksCdrRepository = $trunksCdrRepository;
        $this->entityTools = $entityTools;
        $this->logger = $logger;

        $this->beConstructedWith(
            $this->trunksCdrRepository,
            $this->entityTools,
            $migrateFromTrunksCdr,
            $this->logger
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(MigrateFromUnparsedTrunksCdr::class);
    }

    function it_logs_success_message()
    {
        $this->trunksCdrRepository
            ->getUnparsedCallsGeneratorWithoutOffset(MigrateFromUnparsedTrunksCdr::BATCH_SIZE)
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
        BrandInterface $brand
    ) {
        $this->prepareExecution(
            $trunksCdr,
            $brand
        );

        $exception = new \Exception('Some error');

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

    protected function prepareExecution(
        TrunksCdrInterface $trunksCdr,
        BrandInterface $brand
    ) {

        $this
            ->trunksCdrRepository
            ->getUnparsedCallsGeneratorWithoutOffset(MigrateFromUnparsedTrunksCdr::BATCH_SIZE)
            ->willReturn([[$trunksCdr]]);
    }
}
