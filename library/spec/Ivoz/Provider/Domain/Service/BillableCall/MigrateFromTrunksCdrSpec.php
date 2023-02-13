<?php

namespace spec\Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Kam\Domain\Model\TrunksCdr\Event\TrunksCdrWasMigrated;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdr;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Kam\Domain\Service\TrunksCdr\SetParsed;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCall;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;
use Ivoz\Provider\Domain\Service\BillableCall\CreateOrUpdateByTrunksCdr;
use Ivoz\Provider\Domain\Service\BillableCall\MigrateFromTrunksCdr;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class MigrateFromTrunksCdrSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $billableCallRepository;
    protected $createOrUpdateBillableCallByTrunksCdr;
    protected $domainEventPublisher;
    protected $entityTools;
    protected $setParsed;

    public function let(
        BillableCallRepository $billableCallRepository,
        CreateOrUpdateByTrunksCdr $createOrUpdateBillableCallByTrunksCdr,
        EntityTools $entityTools,
        DomainEventPublisher $domainEventPublisher,
        SetParsed $setParsed
    ) {
        $this->billableCallRepository = $billableCallRepository;
        $this->createOrUpdateBillableCallByTrunksCdr = $createOrUpdateBillableCallByTrunksCdr;
        $this->domainEventPublisher = $domainEventPublisher;
        $this->entityTools = $entityTools;
        $this->setParsed = $setParsed;

        $this->beConstructedWith(
            $this->billableCallRepository,
            $this->createOrUpdateBillableCallByTrunksCdr,
            $this->entityTools,
            $this->domainEventPublisher,
            $this->setParsed
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(MigrateFromTrunksCdr::class);
    }

    function it_queues_db_persist_operations()
    {
        $trunksCdr = $this->prepareTrunksCdr();
        $dispatchImmediately = false;

        $this
            ->entityTools
            ->persist(
                Argument::type(BillableCallInterface::class),
                $dispatchImmediately
            )
            ->shouldBeCalled();

        $this
            ->setParsed
            ->execute(
                Argument::type(TrunksCdrInterface::class),
                $dispatchImmediately
            )
            ->shouldBeCalled();

        $this->execute($trunksCdr);
    }

    protected function prepareTrunksCdr(): TrunksCdr
    {

        $trunksCdr = $this->getInstance(
            TrunksCdr::class,
            [
                'id' => 1,
            ]
        );

        $billableCall = $this->getInstance(
            BillableCall::class,
            [
                'id' => 2,
                'trunksCdr' => $trunksCdr
            ]
        );

        $this
            ->billableCallRepository
            ->findOneByTrunksCdrId(
                $trunksCdr->getId()
            )
            ->willReturn($billableCall);

        $this
            ->createOrUpdateBillableCallByTrunksCdr
            ->execute(
                $trunksCdr,
                $billableCall
            )
            ->shouldBeCalled()
            ->willReturn($billableCall);

        $this
            ->setParsed
            ->execute(
                $trunksCdr,
                Argument::type('bool')
            )
            ->shouldBeCalled();


        $this
            ->domainEventPublisher
            ->publish(
                Argument::type(
                    TrunksCdrWasMigrated::class
                )
            )
            ->shouldBeCalled();

        return $trunksCdr;
    }
}
