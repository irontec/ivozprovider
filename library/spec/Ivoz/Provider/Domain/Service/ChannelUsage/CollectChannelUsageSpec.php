<?php

namespace spec\Ivoz\Provider\Domain\Service\ChannelUsage;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Job\ChannelUsageEventQueueInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandRepository;
use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsageRepository;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Service\ChannelUsage\ChannelUsageBucketCalculator;
use Ivoz\Provider\Domain\Service\ChannelUsage\ChannelUsageEventParser;
use Ivoz\Provider\Domain\Service\ChannelUsage\ChannelUsageWriter;
use Ivoz\Provider\Domain\Service\ChannelUsage\CollectChannelUsage;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;

class CollectChannelUsageSpec extends ObjectBehavior
{
    protected $eventQueue;
    protected $companyRepository;
    protected $brandRepository;
    protected $channelUsageRepository;
    protected $entityTools;
    protected $logger;

    public function let(
        ChannelUsageEventQueueInterface $eventQueue,
        CompanyRepository $companyRepository,
        BrandRepository $brandRepository,
        ChannelUsageRepository $channelUsageRepository,
        EntityTools $entityTools,
        LoggerInterface $logger
    ) {
        $this->eventQueue = $eventQueue;
        $this->companyRepository = $companyRepository;
        $this->brandRepository = $brandRepository;
        $this->channelUsageRepository = $channelUsageRepository;
        $this->entityTools = $entityTools;
        $this->logger = $logger;

        // The parser, the calculator and the writer are built for real: the first two are
        // pure, and the writer is what puts the doubled repository and entityTools to work,
        // so doubling them would only obscure the behaviour under test.
        $this->beConstructedWith(
            $eventQueue,
            new ChannelUsageEventParser($logger->getWrappedObject()),
            new ChannelUsageBucketCalculator(),
            $companyRepository,
            $brandRepository,
            new ChannelUsageWriter(
                $channelUsageRepository->getWrappedObject(),
                $entityTools->getWrappedObject()
            ),
            $logger
        );

        // Permissive baseline: a double turns strict as soon as one call is expected, so
        // every collaborator method the service may touch needs a promise up front.
        $this->companyRepository->findBy(Argument::any())->willReturn([]);
        $this->brandRepository->findBy(Argument::any())->willReturn([]);
        $this
            ->channelUsageRepository
            ->findByCompaniesAndTimestampRange(Argument::cetera())
            ->willReturn([]);

        $this->eventQueue->readPending(Argument::any())->willReturn([]);
        $this->eventQueue->getActiveChannelsByCompany()->willReturn([]);

        // These return void, so they get an empty promise rather than willReturn(): a bare
        // method prophecy is never registered, and the double would reject the call.
        $noop = function () {
        };

        $this->eventQueue->discardProcessed(Argument::any())->will($noop);
        $this->eventQueue->requeue(Argument::any())->will($noop);

        $this->entityTools->persistDto(Argument::cetera())->will($noop);
        $this->entityTools->dispatchQueuedOperations()->will($noop);
        $this->entityTools->clearExcept(Argument::cetera())->will($noop);

        $this->logger->warning(Argument::any())->will($noop);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CollectChannelUsage::class);
    }

    function it_reads_a_bounded_slice_of_the_queue()
    {
        // The whole queue must never be pulled into memory: kamailio keeps pushing while
        // the collector is down.
        $this
            ->eventQueue
            ->readPending(CollectChannelUsage::MAX_ENTRIES_PER_RUN)
            ->shouldBeCalled()
            ->willReturn([]);

        $this->eventQueue->getActiveChannelsByCompany()->willReturn([]);

        $this->execute();
    }

    function it_discards_the_raw_entries_it_read_not_the_events_it_parsed()
    {
        // Regression: trimming by the number of parsed events leaves the malformed entry
        // stuck at the head of the queue, shifting every later offset for good.
        $this
            ->eventQueue
            ->readPending(Argument::any())
            ->willReturn([
                'A:100:1:2:1',
                'this is not an event',
                'H:200:1:2',
            ]);

        $this->eventQueue->getActiveChannelsByCompany()->willReturn([]);
        $this->logger->warning(Argument::any())->shouldBeCalled();

        $this
            ->eventQueue
            ->discardProcessed(3)
            ->shouldBeCalled();

        $this->eventQueue->requeue(Argument::any())->shouldBeCalled();

        $this->execute();
    }

    function it_leaves_the_queue_alone_when_every_entry_belongs_to_the_open_bucket()
    {
        $openBucketTs = time() + 600;

        $this
            ->eventQueue
            ->readPending(Argument::any())
            ->willReturn(['A:' . $openBucketTs . ':1:2:1']);

        $this->eventQueue->getActiveChannelsByCompany()->willReturn([]);

        $this->eventQueue->discardProcessed(Argument::any())->shouldNotBeCalled();
        $this->eventQueue->requeue(Argument::any())->shouldNotBeCalled();

        $this->execute();
    }

    function it_puts_open_bucket_events_back_on_the_queue()
    {
        $openBucketTs = time() + 600;
        $stillOpen = 'A:' . $openBucketTs . ':1:2:1';

        $this
            ->eventQueue
            ->readPending(Argument::any())
            ->willReturn([
                'A:100:1:2:1',
                'H:200:1:2',
                $stillOpen,
            ]);

        $this->eventQueue->getActiveChannelsByCompany()->willReturn([]);

        $this->eventQueue->discardProcessed(3)->shouldBeCalled();
        $this
            ->eventQueue
            ->requeue([$stillOpen])
            ->shouldBeCalled();

        $this->execute();
    }

    function it_keeps_the_queue_intact_when_persisting_fails()
    {
        // At-least-once: if the buckets did not land, the events must still be there.
        $this
            ->eventQueue
            ->readPending(Argument::any())
            ->willReturn([
                'A:100:1:2:1',
                'H:200:1:2',
            ]);

        $this->eventQueue->getActiveChannelsByCompany()->willReturn([]);

        $this
            ->entityTools
            ->dispatchQueuedOperations()
            ->willThrow(new \RuntimeException('db is down'));

        $this->eventQueue->discardProcessed(Argument::any())->shouldNotBeCalled();

        $this
            ->shouldThrow(\RuntimeException::class)
            ->duringExecute();
    }

    function it_persists_one_bucket_per_closed_interval()
    {
        $this
            ->eventQueue
            ->readPending(Argument::any())
            ->willReturn([
                'A:100:1:2:1',
                'H:200:1:2',
            ]);

        $this->eventQueue->getActiveChannelsByCompany()->willReturn([]);

        $this
            ->entityTools
            ->persistDto(Argument::any(), null, false)
            ->shouldBeCalledTimes(1);

        $this->execute();
    }

    function it_resolves_a_whole_batch_of_buckets_with_a_single_lookup()
    {
        // One query per chunk, not one per row.
        $this
            ->eventQueue
            ->readPending(Argument::any())
            ->willReturn([
                'A:100:1:2:1',
                'H:200:1:2',
                'A:400:1:3:1',
                'H:500:1:3',
            ]);

        $this->eventQueue->getActiveChannelsByCompany()->willReturn([]);

        $this
            ->channelUsageRepository
            ->findByCompaniesAndTimestampRange(Argument::cetera())
            ->shouldBeCalledTimes(1)
            ->willReturn([]);

        $this
            ->channelUsageRepository
            ->findOneByCompanyAndTimestamp(Argument::cetera())
            ->shouldNotBeCalled();

        $this->execute();
    }
}
