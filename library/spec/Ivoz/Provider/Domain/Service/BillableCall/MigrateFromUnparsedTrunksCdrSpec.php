<?php

namespace spec\Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdr;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrRepository;
use Ivoz\Provider\Domain\Model\Commandlog\Commandlog;
use Ivoz\Provider\Domain\Service\BillableCall\MigrateFromTrunksCdr;
use Ivoz\Provider\Domain\Service\BillableCall\MigrateFromUnparsedTrunksCdr;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;
use spec\HelperTrait;

class MigrateFromUnparsedTrunksCdrSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $trunksCdrRepository;
    protected $entityTools;
    protected $migrateFromTrunksCdr;
    protected $logger;

    public function let(
        TrunksCdrRepository $trunksCdrRepository,
        MigrateFromTrunksCdr $migrateFromTrunksCdr,
        LoggerInterface $logger
    ) {
        $this->trunksCdrRepository = $trunksCdrRepository;
        $this->entityTools = $this->getTestDouble(
            EntityTools::class,
            true
        );
        $this->migrateFromTrunksCdr = $migrateFromTrunksCdr;
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

    function it_queues_operations()
    {
        $trunksCdr = $this->prepareTrunksCdr();
        $dispatchImmediately = false;

        $this
            ->migrateFromTrunksCdr
            ->execute(
                $trunksCdr,
                $dispatchImmediately
            )
            ->shouldBeCalled();

        $this
            ->entityTools
            ->dispatchQueuedOperations()
            ->shouldBeCalled();

        $this->execute();
    }


    function it_releases_entities_but_commandlog_once_dispatched()
    {
        $this->prepareTrunksCdr();

        $this
            ->entityTools
            ->dispatchQueuedOperations()
            ->shouldBeCalled();

        $this
            ->entityTools
            ->clearExcept(
                Commandlog::class
            )
            ->shouldBeCalled();

        $this->execute();
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

    function it_logs_error_message_on_exceptions()
    {
        $this->prepareTrunksCdr();

        $exception = new \Exception(
            'Some error'
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

    protected function prepareTrunksCdr(): TrunksCdr
    {
        $trunksCdr = $this->getInstance(
            TrunksCdr::class
        );

        $this
            ->trunksCdrRepository
            ->getUnparsedCallsGeneratorWithoutOffset(
                MigrateFromUnparsedTrunksCdr::BATCH_SIZE
            )
            ->willReturn([[$trunksCdr]]);

        return $trunksCdr;
    }
}
